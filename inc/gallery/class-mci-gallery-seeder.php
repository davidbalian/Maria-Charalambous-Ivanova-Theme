<?php
/**
 * One-time default galleries and placements.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MCI_Gallery_Seeder
 */
class MCI_Gallery_Seeder {

	/**
	 * Init hooks.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'maybe_seed' ), 3 );
		add_action( 'after_switch_theme', array( $this, 'maybe_seed' ) );
		add_action( 'admin_init', array( $this, 'maybe_seed' ), 5 );
	}

	/**
	 * Run once when option version is below current.
	 */
	public function maybe_seed() {
		$v = (int) get_option( MCI_Gallery_Constants::SEED_VERSION, 0 );
		if ( $v >= MCI_Gallery_Constants::SEED_VERSION_NUMBER ) {
			return;
		}
		$this->run();
		update_option( MCI_Gallery_Constants::SEED_VERSION, MCI_Gallery_Constants::SEED_VERSION_NUMBER );
	}

	/**
	 * Create default posts, items, and placements.
	 */
	public function run() {
		$map = $this->get_default_definitions();
		$ids = array();
		foreach ( $map as $slot => $def ) {
			$post_id = $this->get_or_create_post( $def['slug'], $def['title'] );
			if ( ! $post_id ) {
				continue;
			}
			$ids[ $slot ] = $post_id;
			$existing     = get_post_meta( $post_id, MCI_Gallery_Constants::ITEMS_META, true );
			$decoded      = is_string( $existing ) ? json_decode( $existing, true ) : array();
			if ( is_array( $decoded ) && ! empty( $decoded ) ) {
				continue;
			}
			$items = $this->build_items( $def['source_items'] );
			update_post_meta( $post_id, MCI_Gallery_Constants::ITEMS_META, wp_json_encode( $items ) );
		}
		$placements = get_option( MCI_Gallery_Constants::PLACEMENTS, array() );
		foreach ( MCI_Gallery_Repository::get_slot_keys() as $slot ) {
			if ( isset( $ids[ $slot ] ) ) {
				$placements[ $slot ] = $ids[ $slot ];
			}
		}
		update_option( MCI_Gallery_Constants::PLACEMENTS, $placements );
	}

	/**
	 * Slug, title, and raw (url, alt) rows per slot.
	 *
	 * @return array<string, array{slug: string, title: string, source_items: array<int, array{url: string, alt: string}>}>
	 */
	private function get_default_definitions() {
		$u = 'wp-content/uploads/2026/02/';
		$t = 'assets/images/';
		$base_upload = function ( $f ) {
			return home_url( $u . $f );
		};
		$base_theme  = function ( $f ) {
			return get_template_directory_uri() . '/' . $t . $f;
		};

		return array(
			'home_before_after' => array(
				'slug'  => 'mci-default-home-before-after',
				'title' => __( 'Home – Before & After (default)', 'maria-charalambous-ivanova' ),
				'source_items' => array(
					array( 'url' => $base_upload( 'before-and-after-at-dental-art-clinic-limassol-1.jpg.webp' ), 'alt' => 'Before and after at Dental Art Clinic' ),
					array( 'url' => 'http://davidb1646.sg-host.com/wp-content/uploads/2026/04/dental-implants-bridge-before-after-missing-teeth-dental-art-clinic-dr-maria-charalambous-ivanova-scaled.webp', 'alt' => 'Before and after at Dental Art Clinic' ),
					array( 'url' => $base_upload( 'before-and-after-at-dental-art-clinic-limassol-e1771955250456.webp' ), 'alt' => 'Before and after at Dental Art Clinic' ),
				),
			),
			'home_clinic'       => array(
				'slug'  => 'mci-default-home-clinic',
				'title' => __( 'Home – The Clinic (default)', 'maria-charalambous-ivanova' ),
				'source_items'   => $this->get_home_clinic_sources( $base_upload ),
			),
			'page_before_after' => array(
				'slug'  => 'mci-default-page-before-after',
				'title' => __( 'Gallery page – Before & After (default)', 'maria-charalambous-ivanova' ),
				'source_items'   => array(
					array( 'url' => $base_theme( 'before-and-after-at-dental-art-clinic-limassol.webp' ), 'alt' => 'Before and after smile transformation' ),
					array( 'url' => $base_theme( 'before-and-after-at-dental-art-clinic-limassol-1.jpg.webp' ), 'alt' => 'Before and after smile transformation' ),
					array( 'url' => 'http://davidb1646.sg-host.com/wp-content/uploads/2026/04/dental-implants-bridge-before-after-missing-teeth-dental-art-clinic-dr-maria-charalambous-ivanova-scaled.webp', 'alt' => 'Before and after smile transformation' ),
				),
			),
			'page_clinic'       => array(
				'slug'  => 'mci-default-page-clinic',
				'title' => __( 'Gallery page – The Clinic (default)', 'maria-charalambous-ivanova' ),
				'source_items'   => $this->get_page_clinic_sources( $base_upload ),
			),
		);
	}

	/**
	 * Home clinic carousel filenames (from legacy front-page.php).
	 *
	 * @param callable $base_upload Get URL for filename.
	 * @return array
	 */
	private function get_home_clinic_sources( $base_upload ) {
		$map = array(
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-wide-angle-equipment.avif'  => 'Dental Art Clinic treatment room wide angle',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-lobby-clinic-name.avif'          => 'Dental Art Clinic reception lobby',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-clinic-name-wall-flowers.avif'           => 'Dental Art Clinic name and flowers',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-chair-screens.avif' => 'Dental Art Clinic treatment room dental chair',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-desk-view.avif'                => 'Dental Art Clinic reception desk',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-logo-emblem-wall.avif'                   => 'Dental Art Clinic logo emblem',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-chair.avif'        => 'Dental Art Clinic dental chair',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-area-marble-counter.avif'       => 'Dental Art Clinic reception marble counter',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-pink-flowers-clinic-logo.avif'           => 'Dental Art Clinic pink flowers and logo',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-curtains-desk.avif'        => 'Dental Art Clinic treatment room',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-marble-desk-flowers.avif'      => 'Dental Art Clinic reception marble desk',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-pink-flowers-big-smiles-quote.avif'       => 'Dental Art Clinic pink flowers and quote',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-desk-curtains.avif'       => 'Dental Art Clinic treatment room desk',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-desk-wooden-panels.avif'        => 'Dental Art Clinic reception desk wooden panels',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-white-orchids-big-smiles-quote.avif'     => 'Dental Art Clinic white orchids',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-equipment-alt.avif' => 'Dental Art Clinic dental equipment',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-desk-wooden-panels-alt.avif'   => 'Dental Art Clinic reception wooden panels',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-ceiling-lighting-tv-screen.avif'         => 'Dental Art Clinic ceiling and TV',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-equipment.avif'    => 'Dental Art Clinic treatment equipment',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-waiting-area-curved-partitions.avif' => 'Dental Art Clinic waiting area',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-circular-mirror-orchid-artwork-smile.avif' => 'Dental Art Clinic mirror and orchid',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-smile-quote-wall.avif'   => 'Dental Art Clinic treatment room smile quote',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-waiting-room-marble-interior.avif'        => 'Dental Art Clinic waiting room',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-mirror-orchid-artwork-screens.avif'     => 'Dental Art Clinic mirror and screens',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-tv-screen-dental-work.avif' => 'Dental Art Clinic treatment room TV',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-waiting-area-big-smiles-quote.avif'     => 'Dental Art Clinic waiting area quote',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-smile-3d-letters-closeup.avif'          => 'Dental Art Clinic smile quote',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-smile-quote-wall-text.avif'            => 'Dental Art Clinic smile quote wall',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-bathroom-toilet-marble-sink-curtain.avif' => 'Dental Art Clinic bathroom',
			'dental-art-clinic-by-dr-maria-charalambous-ivanova-modern-bathroom-marble-sink.avif'      => 'Dental Art Clinic modern bathroom',
		);
		$out = array();
		foreach ( $map as $file => $alt ) {
			$out[] = array( 'url' => $base_upload( $file ), 'alt' => $alt );
		}
		return $out;
	}

	/**
	 * Gallery page clinic section (12 images from legacy page-gallery.php).
	 *
	 * @param callable $base_upload Get URL.
	 * @return array
	 */
	private function get_page_clinic_sources( $base_upload ) {
		$rows = array(
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-lobby-clinic-name.avif', 'Reception lobby' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-area-marble-counter.avif', 'Reception area marble counter' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-waiting-room-marble-interior.avif', 'Waiting room marble interior' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-chair-screens.avif', 'Treatment room with dental chair and screens' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-wide-angle-equipment.avif', 'Treatment room wide angle' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-clinic-name-wall-flowers.avif', 'Clinic name wall with flowers' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-desk-view.avif', 'Reception desk' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-logo-emblem-wall.avif', 'Logo emblem on wall' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-pink-flowers-clinic-logo.avif', 'Pink flowers and clinic logo' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-curtains-desk.avif', 'Treatment room with curtains' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-circular-mirror-orchid-artwork-smile.avif', 'Circular mirror and orchid artwork' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-waiting-area-curved-partitions.avif', 'Waiting area with curved partitions' ),
		);
		$out = array();
		foreach ( $rows as $row ) {
			$out[] = array( 'url' => $base_upload( $row[0] ), 'alt' => $row[1] );
		}
		return $out;
	}

	/**
	 * Find or create a published post by slug.
	 *
	 * @param string $slug  Post name.
	 * @param string $title Post title.
	 * @return int
	 */
	private function get_or_create_post( $slug, $title ) {
		$found = get_posts(
			array(
				'post_type'      => MCI_Gallery_Constants::POST_TYPE,
				'name'           => $slug,
				'post_status'    => 'any',
				'posts_per_page' => 1,
			)
		);
		if ( ! empty( $found ) ) {
			$p = $found[0];
			if ( 'publish' !== $p->post_status ) {
				wp_update_post(
					array(
						'ID'          => $p->ID,
						'post_status' => 'publish',
					)
				);
			}
			return (int) $p->ID;
		}
		$pid = wp_insert_post(
			array(
				'post_type'   => MCI_Gallery_Constants::POST_TYPE,
				'post_status' => 'publish',
				'post_title'  => $title,
				'post_name'   => $slug,
			),
			true
		);
		if ( is_wp_error( $pid ) ) {
			return 0;
		}
		return (int) $pid;
	}

	/**
	 * Turn URL list into stored items (attachment id when resolvable).
	 *
	 * @param array $sources List of {url, alt}.
	 * @return array
	 */
	private function build_items( $sources ) {
		$out = array();
		foreach ( $sources as $row ) {
			if ( empty( $row['url'] ) ) {
				continue;
			}
			$url  = (string) $row['url'];
			$alt  = isset( $row['alt'] ) ? (string) $row['alt'] : '';
			$norm = MCI_Gallery_Repository::normalize_url( $url );
			$try  = $norm ? $norm : esc_url_raw( $url );
			$id   = $try ? (int) attachment_url_to_postid( $try ) : 0;
			if ( ! $id && $url !== $try ) {
				$id = (int) attachment_url_to_postid( esc_url_raw( $url ) );
			}
			$out[] = array(
				'id'  => $id,
				'url' => $id ? '' : ( $try ? $try : esc_url_raw( $url ) ),
				'alt' => $alt,
			);
		}
		return MCI_Gallery_Meta::sanitize_items_array( $out );
	}
}
