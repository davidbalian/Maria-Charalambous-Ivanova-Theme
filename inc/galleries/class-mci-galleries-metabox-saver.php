<?php
/**
 * Persists the Galleries metabox submissions.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MCI_Galleries_Metabox_Saver
 */
final class MCI_Galleries_Metabox_Saver {

	/**
	 * Handle a save_post callback.
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post    Post object.
	 */
	public function save( $post_id, $post ) {
		unset( $post );
		if ( ! $this->should_save( $post_id ) ) {
			return;
		}

		$this->save_location( $post_id );
		$this->save_images( $post_id );
	}

	/**
	 * Guard clauses for metabox saves.
	 *
	 * @param int $post_id Post ID.
	 * @return bool
	 */
	private function should_save( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return false;
		}
		if ( ! isset( $_POST[ MCI_Galleries_Constants::NONCE_FIELD ] ) ) {
			return false;
		}
		$nonce = sanitize_text_field( wp_unslash( $_POST[ MCI_Galleries_Constants::NONCE_FIELD ] ) );
		if ( ! wp_verify_nonce( $nonce, MCI_Galleries_Constants::NONCE_ACTION ) ) {
			return false;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return false;
		}
		return true;
	}

	/**
	 * Save the location meta.
	 *
	 * @param int $post_id Post ID.
	 */
	private function save_location( $post_id ) {
		$raw = isset( $_POST['mci_gallery_location'] )
			? sanitize_text_field( wp_unslash( $_POST['mci_gallery_location'] ) )
			: '';

		if ( '' === $raw ) {
			delete_post_meta( $post_id, MCI_Galleries_Constants::META_LOCATION );
			return;
		}
		if ( ! MCI_Galleries_Locations::is_valid( $raw ) ) {
			return;
		}
		update_post_meta( $post_id, MCI_Galleries_Constants::META_LOCATION, $raw );
	}

	/**
	 * Save the images meta from the hidden JSON input.
	 *
	 * @param int $post_id Post ID.
	 */
	private function save_images( $post_id ) {
		if ( ! isset( $_POST['mci_gallery_images'] ) ) {
			return;
		}
		$raw     = wp_unslash( $_POST['mci_gallery_images'] );
		$decoded = json_decode( $raw, true );
		if ( ! is_array( $decoded ) ) {
			$decoded = array();
		}

		$clean = array();
		foreach ( $decoded as $entry ) {
			$sanitised = $this->sanitise_item( $entry );
			if ( null !== $sanitised ) {
				$clean[] = $sanitised;
			}
		}

		update_post_meta( $post_id, MCI_Galleries_Constants::META_IMAGES, $clean );
	}

	/**
	 * Sanitise a single submitted item.
	 *
	 * @param mixed $entry Raw entry from the form.
	 * @return array<string, mixed>|null
	 */
	private function sanitise_item( $entry ) {
		if ( ! is_array( $entry ) || empty( $entry['kind'] ) ) {
			return null;
		}

		if ( MCI_Galleries_Image::KIND_ATTACHMENT === $entry['kind'] ) {
			$id = isset( $entry['id'] ) ? (int) $entry['id'] : 0;
			if ( $id <= 0 ) {
				return null;
			}
			return array(
				'kind' => MCI_Galleries_Image::KIND_ATTACHMENT,
				'id'   => $id,
			);
		}

		if ( MCI_Galleries_Image::KIND_URL === $entry['kind'] ) {
			$url = isset( $entry['url'] ) ? esc_url_raw( (string) $entry['url'] ) : '';
			if ( '' === $url ) {
				return null;
			}
			return array(
				'kind' => MCI_Galleries_Image::KIND_URL,
				'url'  => $url,
				'alt'  => isset( $entry['alt'] ) ? sanitize_text_field( (string) $entry['alt'] ) : '',
			);
		}

		return null;
	}
}
