<?php
/**
 * Repository for resolving which gallery powers each location.
 *
 * Templates call `get_items_for_location( $slug )` to receive ready-to-render
 * image rows. The repository resolves published gallery posts tagged with
 * that location (newest first), uses the first post whose resolved image
 * rows are non-empty — so an empty duplicate does not hide an older filled
 * gallery — flattens items via the image VO, and caches the result per slug.
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
	 * Max published galleries to consider per location when picking the first
	 * with resolvable image rows (guards against unbounded duplicate slots).
	 */
	private const CANDIDATE_POST_LIMIT = 25;

	/**
	 * Per-request cache keyed by location slug.
	 *
	 * @var array<string, array<int, array<string, mixed>>>
	 */
	private static $cache = array();

	/**
	 * Resolve image rows for a location (newest published post with content wins).
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

		$post_ids = self::candidate_post_ids_for_location( $location_slug );
		foreach ( $post_ids as $post_id ) {
			$rows = self::rows_from_post( $post_id );
			if ( ! empty( $rows ) ) {
				self::$cache[ $location_slug ] = $rows;
				return $rows;
			}
		}

		self::$cache[ $location_slug ] = array();
		return array();
	}

	/**
	 * Published gallery post IDs for a location, newest first (bounded).
	 *
	 * @param string $location_slug Location slug.
	 * @return array<int, int>
	 */
	private static function candidate_post_ids_for_location( $location_slug ) {
		$query = new WP_Query(
			array(
				'post_type'              => MCI_Galleries_Constants::POST_TYPE,
				'post_status'            => 'publish',
				'posts_per_page'         => self::CANDIDATE_POST_LIMIT,
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
			return array();
		}

		return array_map( 'intval', $query->posts );
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
