<?php
/**
 * Diff mci_t / mci_te / mci_t_accent string keys against el.php and ru.php.
 * Run: php scripts/mci-i18n-audit.php
 *
 * @package Maria_Charalambous_Ivanova
 */

declare( strict_types=1 );

$theme_root = dirname( __DIR__ );

/**
 * Parse a PHP single-quoted string starting at the opening quote.
 *
 * @return array{0: string, 1: int} Value and index after closing quote.
 */
function mci_audit_parse_single_quoted( string $text, int $start ): array {
	$n    = strlen( $text );
	$i    = $start + 1;
	$buf  = '';
	while ( $i < $n ) {
		$c = $text[ $i ];
		if ( $c === '\\' && $i + 1 < $n ) {
			$buf .= $text[ $i ] . $text[ $i + 1 ];
			$i   += 2;
			continue;
		}
		if ( $c === "'" ) {
			$key = $buf;
			// PHP single-quoted: only \\ and \' are special.
			$key = str_replace( array( '\\\\', "\\'" ), array( '\\', "'" ), $key );
			return array( $key, $i + 1 );
		}
		$buf .= $c;
		++$i;
	}
	return array( '', $start );
}

/**
 * @return string[]
 */
function mci_audit_extract_from_php( string $file_content ): array {
	$keys  = array();
	$funcs = array( 'mci_te', 'mci_t', 'mci_t_accent' );
	foreach ( $funcs as $fn ) {
		$pos = 0;
		while ( ( $p = strpos( $file_content, $fn . '(', $pos ) ) !== false ) {
			$open = $p + strlen( $fn );
			// Skip whitespace to first argument.
			$j = $open + 1;
			$n = strlen( $file_content );
			while ( $j < $n && strpos( " \t\n\r", $file_content[ $j ] ) !== false ) {
				++$j;
			}
			if ( $j < $n && $file_content[ $j ] === "'" ) {
				list( $key, $_end ) = mci_audit_parse_single_quoted( $file_content, $j );
				if ( $key !== '' || strpos( $file_content, "'", $j + 1 ) !== $j ) {
					$keys[] = $key;
				}
			}
			$pos = $p + 3;
		}
	}
	return $keys;
}

/**
 * Keys from return array lines 'key' => ...
 *
 * @return string[]
 */
function mci_audit_load_translation_keys( string $path ): array {
	if ( ! is_readable( $path ) ) {
		return array();
	}
	$lines = file( $path, FILE_IGNORE_NEW_LINES );
	$keys  = array();
	foreach ( $lines as $line ) {
		if ( preg_match( "/^[\\t ]*'(.*)'\\s*=>/s", $line, $m ) ) {
			$raw = $m[1];
			$raw = str_replace( array( '\\\\', "\\'" ), array( '\\', "'" ), $raw );
			$keys[ $raw ] = true;
		}
	}
	return array_keys( $keys );
}

$all_keys = array();
foreach ( new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $theme_root ) ) as $fi ) {
	/** @var SplFileInfo $fi */
	if ( strtolower( pathinfo( $fi->getPathname(), PATHINFO_EXTENSION ) ) !== 'php' ) {
		continue;
	}
	if ( strpos( $fi->getPathname(), $theme_root . '/vendor/' ) !== false ) {
		continue;
	}
	// Skip self.
	if ( $fi->getFilename() === basename( __FILE__ ) ) {
		continue;
	}
	foreach ( mci_audit_extract_from_php( file_get_contents( $fi->getPathname() ) ) as $k ) {
		$all_keys[ $k ] = true;
	}
}
$used = array_keys( $all_keys );
sort( $used );

$el_path = $theme_root . '/inc/translations/el.php';
$ru_path = $theme_root . '/inc/translations/ru.php';

$el_map = array_fill_keys( mci_audit_load_translation_keys( $el_path ), true );
$ru_map = array_fill_keys( mci_audit_load_translation_keys( $ru_path ), true );

$missing_el = array();
$missing_ru = array();
foreach ( $used as $k ) {
	if ( ! isset( $el_map[ $k ] ) ) {
		$missing_el[] = $k;
	}
	if ( ! isset( $ru_map[ $k ] ) ) {
		$missing_ru[] = $k;
	}
}

$out_dir = $theme_root . '/scripts/i18n-audit-output';
if ( ! is_dir( $out_dir ) ) {
	mkdir( $out_dir, 0755, true );
}
file_put_contents( $out_dir . '/missing_el.txt', implode( "\n", $missing_el ) . "\n" );
file_put_contents( $out_dir . '/missing_ru.txt', implode( "\n", $missing_ru ) . "\n" );
file_put_contents( $out_dir . '/all_keys_used.txt', implode( "\n", $used ) . "\n" );

echo 'Used keys: ', count( $used ), PHP_EOL;
echo 'Missing EL: ', count( $missing_el ), ' → scripts/i18n-audit-output/missing_el.txt', PHP_EOL;
echo 'Missing RU: ', count( $missing_ru ), ' → scripts/i18n-audit-output/missing_ru.txt', PHP_EOL;
