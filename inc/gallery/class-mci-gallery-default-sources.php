<?php
/**
 * Default image URL lists used by the seeder on first install.
 *
 * Kept in its own class so the seeder stays small and single-responsibility.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MCI_Gallery_Default_Sources
 */
class MCI_Gallery_Default_Sources {

	/**
	 * Slot definitions: slug, title, and source items per slot.
	 *
	 * @return array<string, array{slug:string, title:string, source_items:array<int, array{url:string, alt:string}>}>
	 */
	public static function get_definitions() {
		return array(
			'home_before_after' => array(
				'slug'         => 'mci-default-home-before-after',
				'title'        => __( 'Home – Before & After (default)', 'maria-charalambous-ivanova' ),
				'source_items' => self::home_before_after_items(),
			),
			'home_clinic'       => array(
				'slug'         => 'mci-default-home-clinic',
				'title'        => __( 'Home – The Clinic (default)', 'maria-charalambous-ivanova' ),
				'source_items' => self::home_clinic_items(),
			),
			'page_before_after' => array(
				'slug'         => 'mci-default-page-before-after',
				'title'        => __( 'Gallery page – Before & After (default)', 'maria-charalambous-ivanova' ),
				'source_items' => self::page_before_after_items(),
			),
			'page_clinic'       => array(
				'slug'         => 'mci-default-page-clinic',
				'title'        => __( 'Gallery page – The Clinic (default)', 'maria-charalambous-ivanova' ),
				'source_items' => self::page_clinic_items(),
			),
		);
	}

	/**
	 * Build a full URL under the site's uploads/2026/02/ directory.
	 *
	 * @param string $filename File name.
	 * @return string
	 */
	private static function upload_url( $filename ) {
		return home_url( '/wp-content/uploads/2026/02/' . $filename );
	}

	/**
	 * Build a full URL under the theme's assets/images/ directory.
	 *
	 * @param string $filename File name.
	 * @return string
	 */
	private static function theme_url( $filename ) {
		return get_template_directory_uri() . '/assets/images/' . $filename;
	}

	/**
	 * Home before/after default items.
	 *
	 * @return array<int, array{url:string, alt:string}>
	 */
	private static function home_before_after_items() {
		return array(
			array(
				'url' => self::upload_url( 'before-and-after-at-dental-art-clinic-limassol-1.jpg.webp' ),
				'alt' => 'Before and after at Dental Art Clinic',
			),
			array(
				'url' => 'http://davidb1646.sg-host.com/wp-content/uploads/2026/04/dental-implants-bridge-before-after-missing-teeth-dental-art-clinic-dr-maria-charalambous-ivanova-scaled.webp',
				'alt' => 'Before and after at Dental Art Clinic',
			),
			array(
				'url' => self::upload_url( 'before-and-after-at-dental-art-clinic-limassol-e1771955250456.webp' ),
				'alt' => 'Before and after at Dental Art Clinic',
			),
		);
	}

	/**
	 * Gallery page before/after default items.
	 *
	 * @return array<int, array{url:string, alt:string}>
	 */
	private static function page_before_after_items() {
		return array(
			array(
				'url' => self::theme_url( 'before-and-after-at-dental-art-clinic-limassol.webp' ),
				'alt' => 'Before and after smile transformation',
			),
			array(
				'url' => self::theme_url( 'before-and-after-at-dental-art-clinic-limassol-1.jpg.webp' ),
				'alt' => 'Before and after smile transformation',
			),
			array(
				'url' => 'http://davidb1646.sg-host.com/wp-content/uploads/2026/04/dental-implants-bridge-before-after-missing-teeth-dental-art-clinic-dr-maria-charalambous-ivanova-scaled.webp',
				'alt' => 'Before and after smile transformation',
			),
		);
	}

	/**
	 * Home clinic carousel default items (~30 photos).
	 *
	 * @return array<int, array{url:string, alt:string}>
	 */
	private static function home_clinic_items() {
		$rows = array(
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-wide-angle-equipment.avif', 'Dental Art Clinic treatment room wide angle' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-lobby-clinic-name.avif', 'Dental Art Clinic reception lobby' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-clinic-name-wall-flowers.avif', 'Dental Art Clinic name and flowers' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-chair-screens.avif', 'Dental Art Clinic treatment room dental chair' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-desk-view.avif', 'Dental Art Clinic reception desk' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-logo-emblem-wall.avif', 'Dental Art Clinic logo emblem' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-chair.avif', 'Dental Art Clinic dental chair' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-area-marble-counter.avif', 'Dental Art Clinic reception marble counter' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-pink-flowers-clinic-logo.avif', 'Dental Art Clinic pink flowers and logo' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-curtains-desk.avif', 'Dental Art Clinic treatment room' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-marble-desk-flowers.avif', 'Dental Art Clinic reception marble desk' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-pink-flowers-big-smiles-quote.avif', 'Dental Art Clinic pink flowers and quote' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-desk-curtains.avif', 'Dental Art Clinic treatment room desk' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-desk-wooden-panels.avif', 'Dental Art Clinic reception desk wooden panels' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-white-orchids-big-smiles-quote.avif', 'Dental Art Clinic white orchids' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-equipment-alt.avif', 'Dental Art Clinic dental equipment' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-desk-wooden-panels-alt.avif', 'Dental Art Clinic reception wooden panels' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-ceiling-lighting-tv-screen.avif', 'Dental Art Clinic ceiling and TV' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-equipment.avif', 'Dental Art Clinic treatment equipment' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-waiting-area-curved-partitions.avif', 'Dental Art Clinic waiting area' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-circular-mirror-orchid-artwork-smile.avif', 'Dental Art Clinic mirror and orchid' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-smile-quote-wall.avif', 'Dental Art Clinic treatment room smile quote' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-waiting-room-marble-interior.avif', 'Dental Art Clinic waiting room' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-mirror-orchid-artwork-screens.avif', 'Dental Art Clinic mirror and screens' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-tv-screen-dental-work.avif', 'Dental Art Clinic treatment room TV' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-waiting-area-big-smiles-quote.avif', 'Dental Art Clinic waiting area quote' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-smile-3d-letters-closeup.avif', 'Dental Art Clinic smile quote' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-smile-quote-wall-text.avif', 'Dental Art Clinic smile quote wall' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-bathroom-toilet-marble-sink-curtain.avif', 'Dental Art Clinic bathroom' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-modern-bathroom-marble-sink.avif', 'Dental Art Clinic modern bathroom' ),
		);
		return self::rows_to_items( $rows );
	}

	/**
	 * Gallery page clinic grid default items (12 curated photos).
	 *
	 * @return array<int, array{url:string, alt:string}>
	 */
	private static function page_clinic_items() {
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
		return self::rows_to_items( $rows );
	}

	/**
	 * Convert an array of [filename, alt] tuples into {url, alt} items.
	 *
	 * @param array<int, array{0:string, 1:string}> $rows File + alt tuples.
	 * @return array<int, array{url:string, alt:string}>
	 */
	private static function rows_to_items( $rows ) {
		$out = array();
		foreach ( $rows as $row ) {
			$out[] = array(
				'url' => self::upload_url( $row[0] ),
				'alt' => $row[1],
			);
		}
		return $out;
	}
}
