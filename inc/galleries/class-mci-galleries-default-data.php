<?php
/**
 * Default image data used to seed the four gallery posts on first run.
 *
 * Every entry is produced as a `{kind:'url', url, alt}` item so the admin
 * can edit them immediately without having to import anything into the
 * Media Library. Filenames match what the live site already serves under
 * /wp-content/uploads/2026/02/ and the theme's own assets/images/.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MCI_Galleries_Default_Data
 */
final class MCI_Galleries_Default_Data {

	const UPLOAD_PATH = '/wp-content/uploads/2026/02/';

	/**
	 * Map of location slug => { title, items }.
	 *
	 * @return array<string, array{title:string, items:array<int, array<string, string>>}>
	 */
	public static function definitions() {
		return array(
			MCI_Galleries_Locations::HOME_BEFORE_AFTER => array(
				'title' => __( 'Home — Before & After', 'maria-charalambous-ivanova' ),
				'items' => self::home_before_after(),
			),
			MCI_Galleries_Locations::HOME_CLINIC => array(
				'title' => __( 'Home — The Clinic', 'maria-charalambous-ivanova' ),
				'items' => self::home_clinic(),
			),
			MCI_Galleries_Locations::PAGE_BEFORE_AFTER => array(
				'title' => __( 'Gallery page — Before & After', 'maria-charalambous-ivanova' ),
				'items' => self::page_before_after(),
			),
			MCI_Galleries_Locations::PAGE_CLINIC => array(
				'title' => __( 'Gallery page — The Clinic', 'maria-charalambous-ivanova' ),
				'items' => self::page_clinic(),
			),
		);
	}

	/**
	 * Home before/after strip (3 images).
	 *
	 * @return array<int, array<string, string>>
	 */
	private static function home_before_after() {
		$alt = __( 'Before and after at Dental Art Clinic Limassol', 'maria-charalambous-ivanova' );
		return self::make_items(
			array(
				'before-and-after-at-dental-art-clinic-limassol-1.jpg.webp',
				'before-and-after-at-dental-art-clinic-limassol-2.webp',
				'before-and-after-at-dental-art-clinic-limassol.webp',
			),
			$alt,
			self::UPLOAD_PATH
		);
	}

	/**
	 * Gallery page before/after grid (3 images, served from theme assets).
	 *
	 * @return array<int, array<string, string>>
	 */
	private static function page_before_after() {
		$alt       = __( 'Before and after smile transformation', 'maria-charalambous-ivanova' );
		$theme_url = trailingslashit( get_template_directory_uri() ) . 'assets/images/';
		$items     = array();
		foreach ( array(
			'before-and-after-at-dental-art-clinic-limassol.webp',
			'before-and-after-at-dental-art-clinic-limassol-1.jpg.webp',
			'before-and-after-at-dental-art-clinic-limassol-2.webp',
		) as $filename ) {
			$items[] = array(
				'url' => $theme_url . $filename,
				'alt' => $alt,
			);
		}
		return $items;
	}

	/**
	 * Home clinic carousel (~30 interior shots).
	 *
	 * @return array<int, array<string, string>>
	 */
	private static function home_clinic() {
		$rows = array(
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-wide-angle-equipment.avif', 'Dental Art Clinic treatment room wide angle' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-lobby-clinic-name.avif', 'Dental Art Clinic reception lobby' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-clinic-name-wall-flowers.avif', 'Dental Art Clinic name wall with flowers' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-chair-screens.avif', 'Dental Art Clinic treatment room with chair and screens' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-desk-view.avif', 'Dental Art Clinic reception desk' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-logo-emblem-wall.avif', 'Dental Art Clinic logo emblem on wall' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-chair.avif', 'Dental Art Clinic dental chair' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-area-marble-counter.avif', 'Dental Art Clinic reception marble counter' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-pink-flowers-clinic-logo.avif', 'Dental Art Clinic pink flowers and logo' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-curtains-desk.avif', 'Dental Art Clinic treatment room with curtains' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-marble-desk-flowers.avif', 'Dental Art Clinic reception marble desk with flowers' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-pink-flowers-big-smiles-quote.avif', 'Dental Art Clinic pink flowers and smiles quote' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-desk-curtains.avif', 'Dental Art Clinic treatment room desk' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-desk-wooden-panels.avif', 'Dental Art Clinic reception desk with wooden panels' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-white-orchids-big-smiles-quote.avif', 'Dental Art Clinic white orchids' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-equipment-alt.avif', 'Dental Art Clinic dental equipment' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-desk-wooden-panels-alt.avif', 'Dental Art Clinic reception wooden panels alternative view' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-ceiling-lighting-tv-screen.avif', 'Dental Art Clinic ceiling lighting and TV screen' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-equipment.avif', 'Dental Art Clinic treatment equipment' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-waiting-area-curved-partitions.avif', 'Dental Art Clinic waiting area curved partitions' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-circular-mirror-orchid-artwork-smile.avif', 'Dental Art Clinic circular mirror and orchid artwork' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-smile-quote-wall.avif', 'Dental Art Clinic treatment room with smile quote wall' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-waiting-room-marble-interior.avif', 'Dental Art Clinic waiting room marble interior' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-mirror-orchid-artwork-screens.avif', 'Dental Art Clinic mirror and orchid artwork with screens' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-tv-screen-dental-work.avif', 'Dental Art Clinic treatment room TV screen' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-waiting-area-big-smiles-quote.avif', 'Dental Art Clinic waiting area smiles quote' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-smile-3d-letters-closeup.avif', 'Dental Art Clinic smile 3D letters closeup' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-smile-quote-wall-text.avif', 'Dental Art Clinic smile quote wall text' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-bathroom-toilet-marble-sink-curtain.avif', 'Dental Art Clinic bathroom marble sink' ),
			array( 'dental-art-clinic-by-dr-maria-charalambous-ivanova-modern-bathroom-marble-sink.avif', 'Dental Art Clinic modern bathroom marble sink' ),
		);
		return self::rows_to_items( $rows, self::UPLOAD_PATH );
	}

	/**
	 * Gallery page clinic grid (12 curated shots).
	 *
	 * @return array<int, array<string, string>>
	 */
	private static function page_clinic() {
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
		return self::rows_to_items( $rows, self::UPLOAD_PATH );
	}

	/**
	 * Build items from a list of filenames with a shared alt label.
	 *
	 * @param array<int, string> $filenames Image filenames.
	 * @param string             $alt       Shared alt text.
	 * @param string             $base_path URL base path.
	 * @return array<int, array<string, string>>
	 */
	private static function make_items( array $filenames, $alt, $base_path ) {
		$items = array();
		foreach ( $filenames as $filename ) {
			$items[] = array(
				'url' => home_url( $base_path . $filename ),
				'alt' => $alt,
			);
		}
		return $items;
	}

	/**
	 * Convert [filename, alt] tuples into items.
	 *
	 * @param array<int, array{0:string, 1:string}> $rows      Tuples.
	 * @param string                                $base_path URL base path.
	 * @return array<int, array<string, string>>
	 */
	private static function rows_to_items( array $rows, $base_path ) {
		$items = array();
		foreach ( $rows as $row ) {
			$items[] = array(
				'url' => home_url( $base_path . $row[0] ),
				'alt' => $row[1],
			);
		}
		return $items;
	}

	/**
	 * Prevent instantiation.
	 */
	private function __construct() {}
}
