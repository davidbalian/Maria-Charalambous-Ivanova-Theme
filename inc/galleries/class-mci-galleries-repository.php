<?php
/**
 * Repository for resolving which gallery powers each location.
 *
 * Templates call `get_items_for_location( $slug )` to receive ready-to-render
 * image rows. The repository resolves the newest published gallery post
 * tagged with that location, flattens its stored items via the image VO, and
 * caches the result in a per-request memo.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MCI_Galleries_Repository
 */
final class MCI_Galleries_Repository {

	/**
	 * Per-request cache keyed by location slug.
	 *
	 * @var array<string, array<int, array<string, mixed>>>
	 */
	private static $cache = array();

	/**
	 * Resolve the newest gallery post for a location and return its image rows.
	 *
	 * @param string $location_slug One of MCI_Galleries_Locations::all() keys.
	 * @return array<int, array{url:string,thumb_url:string,alt:string,width:int,height:int}>
	 */
	public static function get_items_for_location( $location_slug ) {
		if ( ! MCI_Galleries_Locations::is_valid( $location_slug ) ) {
			return array();
		}

		if ( isset( self::$cache[ $location_slug ] ) ) {
			return self::$cache[ $location_slug ];
		}

		$post_id = self::find_post_id_for_location( $location_slug );
		if ( $post_id <= 0 ) {
			self::$cache[ $location_slug ] = array();
			return array();
		}

		$rows                              = self::rows_from_post( $post_id );
		self::$cache[ $location_slug ]     = $rows;
		return $rows;
	}

	/**
	 * Look up the newest published gallery post assigned to this location.
	 *
	 * @param string $location_slug Location slug.
	 * @return int Post ID, or 0 if none.
	 */
	private static function find_post_id_for_location( $location_slug ) {
		$query = new WP_Query(
			array(
				'post_type'              => MCI_Galleries_Constants::POST_TYPE,
				'post_status'            => 'publish',
				'posts_per_page'         => 1,
				'orderby'                => 'date',
				'order'                  => 'DESC',
				'no_found_rows'          => true,
				'update_post_meta_cache' => false,
				'update_post_term_cache' => false,
				'fields'                 => 'ids',
				'meta_query'             => array(
					array(
						'key'   => MCI_Galleries_Constants::META_LOCATION,
						'value' => $location_slug,
					),
				),
			)
		);

		if ( empty( $query->posts ) ) {
			return 0;
		}

		return (int) $query->posts[0];
	}

	/**
	 * Read the images meta for a post and turn each stored item into a row.
	 *
	 * @param int $post_id Gallery post ID.
	 * @return array<int, array<string, mixed>>
	 */
	private static function rows_from_post( $post_id ) {
		$items = get_post_meta( $post_id, MCI_Galleries_Constants::META_IMAGES, true );
		if ( ! is_array( $items ) ) {
			return array();
		}

		$rows = array();
		foreach ( $items as $item ) {
			$row = MCI_Galleries_Image::row_from_item( $item );
			if ( null !== $row ) {
				$rows[] = $row;
			}
		}

		return $rows;
	}

	/**
	 * Count the image items on a gallery post (used by the admin columns).
	 *
	 * @param int $post_id Gallery post ID.
	 * @return int
	 */
	public static function count_items( $post_id ) {
		$items = get_post_meta( $post_id, MCI_Galleries_Constants::META_IMAGES, true );
		return is_array( $items ) ? count( $items ) : 0;
	}

	/**
	 * Prevent instantiation — static API.
	 */
	private function __construct() {}
}
