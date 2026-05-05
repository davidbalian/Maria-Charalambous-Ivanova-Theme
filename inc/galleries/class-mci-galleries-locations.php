<?php
/**
 * Location registry.
 *
 * Defines the registered slots where galleries can be rendered in the theme.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MCI_Galleries_Locations
 */
final class MCI_Galleries_Locations {

	const HOME_BEFORE_AFTER = 'home_before_after';
	const HOME_CLINIC       = 'home_clinic';
	const PAGE_BEFORE_AFTER = 'page_before_after';
	const PAGE_CLINIC       = 'page_clinic';
	const SMILERS_DUAL      = 'smilers_dual';

	/**
	 * Location slug => human label map.
	 *
	 * @return array<string, string>
	 */
	public static function all() {
		return array(
			self::HOME_BEFORE_AFTER => __( 'Home: Before & After', 'maria-charalambous-ivanova' ),
			self::HOME_CLINIC       => __( 'Home: The Clinic', 'maria-charalambous-ivanova' ),
			self::PAGE_BEFORE_AFTER => __( 'Gallery page: Before & After', 'maria-charalambous-ivanova' ),
			self::PAGE_CLINIC       => __( 'Gallery page: The Clinic', 'maria-charalambous-ivanova' ),
			self::SMILERS_DUAL      => __( 'Home & Services: Smilers — companion images', 'maria-charalambous-ivanova' ),
		);
	}

	/**
	 * Whether the given slug is a recognised location.
	 *
	 * @param string $slug Candidate slug.
	 * @return bool
	 */
	public static function is_valid( $slug ) {
		return is_string( $slug ) && array_key_exists( $slug, self::all() );
	}

	/**
	 * Human label for a location slug, or empty string if unknown.
	 *
	 * @param string $slug Location slug.
	 * @return string
	 */
	public static function label( $slug ) {
		$map = self::all();
		return isset( $map[ $slug ] ) ? $map[ $slug ] : '';
	}

	/**
	 * Prevent instantiation.
	 */
	private function __construct() {}
}
