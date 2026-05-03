<?php
/**
 * Detects which attachment IDs are currently in use across the site.
 *
 * Results are cached in two transients:
 *   - TRANSIENT_IDS   (12h) — union of backend uses + theme-file uses.
 *   - TRANSIENT_THEME (1d)  — theme PHP file scan only (rarely changes).
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class MCI_Media_In_Use_Detector {

	/** @var array<int>|null */
	private $ids = null;

	public function get_in_use_ids(): array {
		if ( null !== $this->ids ) {
			return $this->ids;
		}

		$cached = get_transient( MCI_Media_In_Use_Constants::TRANSIENT_IDS );

		if ( is_array( $cached ) ) {
			$this->ids = $cached;
			return $this->ids;
		}

		$this->ids = $this->compute();

		set_transient(
			MCI_Media_In_Use_Constants::TRANSIENT_IDS,
			$this->ids,
			MCI_Media_In_Use_Constants::TTL_IDS
		);

		return $this->ids;
	}

	public function is_in_use( int $id ): bool {
		return in_array( $id, $this->get_in_use_ids(), true );
	}

	public function flush(): void {
		$this->ids = null;
		delete_transient( MCI_Media_In_Use_Constants::TRANSIENT_IDS );
	}

	public function flush_theme(): void {
		delete_transient( MCI_Media_In_Use_Constants::TRANSIENT_THEME );
	}

	// -------------------------------------------------------------------------

	private function compute(): array {
		global $wpdb;

		$ids = array();

		// 1. Attachments with a post parent (WP-backend attached).
		$rows = $wpdb->get_col(
			"SELECT ID FROM {$wpdb->posts}
			 WHERE post_type = 'attachment'
			   AND post_parent <> 0"
		);
		$ids = array_merge( $ids, $rows );

		// 2. Featured images (_thumbnail_id post meta).
		$rows = $wpdb->get_col(
			"SELECT DISTINCT CAST(meta_value AS UNSIGNED)
			 FROM {$wpdb->postmeta}
			 WHERE meta_key = '_thumbnail_id'"
		);
		$ids = array_merge( $ids, $rows );

		// 3. Gallery CPT images stored in _mci_gallery_images (JSON).
		$gallery_meta_key = MCI_Galleries_Constants::META_IMAGES;
		$rows             = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT meta_value FROM {$wpdb->postmeta} WHERE meta_key = %s",
				$gallery_meta_key
			)
		);
		foreach ( $rows as $json ) {
			$items = json_decode( $json, true );
			if ( ! is_array( $items ) ) {
				continue;
			}
			foreach ( $items as $item ) {
				if ( isset( $item['attachment_id'] ) && $item['attachment_id'] ) {
					$ids[] = $item['attachment_id'];
				}
			}
		}

		// 4. Post content references (Gutenberg / classic editor insertions).
		$content_rows = $wpdb->get_results(
			"SELECT post_content
			 FROM {$wpdb->posts}
			 WHERE post_status IN ('publish','private','draft','future','pending')
			   AND post_type NOT IN ('revision','attachment','nav_menu_item')
			   AND ( post_content LIKE '%wp-image-%' OR post_content LIKE '%/wp-content/uploads/%' )",
			ARRAY_A
		);

		$url_memo = array(); // dedupe URL→ID lookups within this compute run.

		foreach ( $content_rows as $row ) {
			$content = $row['post_content'];

			// IDs embedded as CSS class wp-image-{ID}.
			preg_match_all( '#wp-image-(\d+)#', $content, $m );
			if ( ! empty( $m[1] ) ) {
				$ids = array_merge( $ids, $m[1] );
			}

			// URLs in post content → resolve to attachment ID.
			preg_match_all(
				'#https?://[^\s"\'<>]+/wp-content/uploads/[^\s"\'<>]+\.(?:jpe?g|png|gif|webp|svg|avif)#i',
				$content,
				$mu
			);
			foreach ( array_unique( $mu[0] ) as $url ) {
				if ( ! isset( $url_memo[ $url ] ) ) {
					$url_memo[ $url ] = attachment_url_to_postid( $url );
				}
				if ( $url_memo[ $url ] ) {
					$ids[] = $url_memo[ $url ];
				}
			}
		}

		// 5. Theme PHP file hard-coded /uploads/ URLs.
		$ids = array_merge( $ids, $this->scan_theme_files() );

		return array_values(
			array_unique(
				array_filter(
					array_map( 'intval', $ids )
				)
			)
		);
	}

	public function scan_theme_files(): array {
		$cached = get_transient( MCI_Media_In_Use_Constants::TRANSIENT_THEME );

		if ( is_array( $cached ) ) {
			return $cached;
		}

		$ids      = array();
		$url_memo = array();
		$files    = $this->collect_theme_php_files();

		foreach ( $files as $file ) {
			$source = file_get_contents( $file ); // phpcs:ignore WordPress.WP.AlternativeFunctions
			if ( false === $source ) {
				continue;
			}

			preg_match_all(
				'#https?://[^\s"\'\)]+/wp-content/uploads/[^\s"\'\)]+#i',
				$source,
				$m
			);

			foreach ( array_unique( $m[0] ) as $url ) {
				// Strip trailing punctuation that the regex may have captured.
				$url = rtrim( $url, '.,' );
				if ( ! isset( $url_memo[ $url ] ) ) {
					$url_memo[ $url ] = attachment_url_to_postid( $url );
				}
				if ( $url_memo[ $url ] ) {
					$ids[] = $url_memo[ $url ];
				}
			}
		}

		$ids = array_values(
			array_unique(
				array_filter(
					array_map( 'intval', $ids )
				)
			)
		);

		set_transient(
			MCI_Media_In_Use_Constants::TRANSIENT_THEME,
			$ids,
			MCI_Media_In_Use_Constants::TTL_THEME
		);

		return $ids;
	}

	private function collect_theme_php_files(): array {
		$dir   = get_template_directory();
		$files = array();

		// Root .php files (non-recursive).
		foreach ( glob( $dir . '/*.php' ) as $f ) {
			$files[] = $f;
		}

		// All PHP files under template-parts/ (recursive).
		$parts_dir = $dir . '/template-parts';
		if ( is_dir( $parts_dir ) ) {
			$iterator = new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator( $parts_dir, RecursiveDirectoryIterator::SKIP_DOTS )
			);
			foreach ( $iterator as $file ) {
				if ( $file->isFile() && 'php' === $file->getExtension() ) {
					$files[] = $file->getPathname();
				}
			}
		}

		return $files;
	}
}
