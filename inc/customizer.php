<?php
/**
 * Theme Customizer — Design Tokens.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Customizer settings, sections, and controls.
 */
function mci_customize_register( $wp_customize ) {

<<<<<<< HEAD
=======
	/* -------------------------------------------------------------------------
	 * Panel: Design Tokens
	 * ---------------------------------------------------------------------- */
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
	$wp_customize->add_panel( 'mci_design_tokens', array(
		'title'    => __( 'Design Tokens', 'maria-charalambous-ivanova' ),
		'priority' => 30,
	) );

<<<<<<< HEAD
	/* -----------------------------------------------------------------
	 * Colors
	 * -------------------------------------------------------------- */
=======
	/* -------------------------------------------------------------------------
	 * Section: Colors
	 * ---------------------------------------------------------------------- */
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
	$wp_customize->add_section( 'mci_colors', array(
		'title' => __( 'Colors', 'maria-charalambous-ivanova' ),
		'panel' => 'mci_design_tokens',
	) );

	$colors = array(
<<<<<<< HEAD
		'primary'         => array( 'Primary',         '#0071E3' ),
		'primary_hover'   => array( 'Primary Hover',   '#005BBB' ),
		'secondary'       => array( 'Secondary',       '#1D1D1F' ),
		'secondary_hover' => array( 'Secondary Hover', '#424245' ),
		'text'            => array( 'Text',            '#1D1D1F' ),
		'text_light'      => array( 'Text Light',      '#6E6E73' ),
		'background'      => array( 'Background',      '#F5F5F7' ),
		'surface'         => array( 'Surface',         '#FFFFFF' ),
		'border'          => array( 'Border',          '#D2D2D7' ),
		'white'           => array( 'White',           '#FFFFFF' ),
	);

	foreach ( $colors as $key => $meta ) {
		$id = 'mci_color_' . $key;

		$wp_customize->add_setting( $id, array(
=======
		'primary'         => array( 'Primary',         '#1a5c6b' ),
		'primary_hover'   => array( 'Primary Hover',   '#134a56' ),
		'secondary'       => array( 'Secondary',       '#c9a84c' ),
		'secondary_hover' => array( 'Secondary Hover', '#b8963e' ),
		'text'            => array( 'Text',            '#2c2c2c' ),
		'text_light'      => array( 'Text Light',      '#6b6b6b' ),
		'background'      => array( 'Background',      '#ffffff' ),
		'surface'         => array( 'Surface',         '#f7f7f5' ),
		'border'          => array( 'Border',          '#e0ddd5' ),
		'white'           => array( 'White',           '#ffffff' ),
	);

	foreach ( $colors as $key => $meta ) {
		$setting_id = 'mci_color_' . $key;

		$wp_customize->add_setting( $setting_id, array(
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
			'default'           => $meta[1],
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		) );

<<<<<<< HEAD
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, array(
=======
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, array(
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
			'label'   => $meta[0],
			'section' => 'mci_colors',
		) ) );
	}

<<<<<<< HEAD
	/* -----------------------------------------------------------------
	 * Typography
	 * -------------------------------------------------------------- */
=======
	/* -------------------------------------------------------------------------
	 * Section: Typography
	 * ---------------------------------------------------------------------- */
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
	$wp_customize->add_section( 'mci_typography', array(
		'title' => __( 'Typography', 'maria-charalambous-ivanova' ),
		'panel' => 'mci_design_tokens',
	) );

<<<<<<< HEAD
	$wp_customize->add_setting( 'mci_font_heading', array(
		'default'           => "'Playfair Display', Georgia, serif",
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'mci_font_heading', array(
		'label'   => __( 'Heading Font Family', 'maria-charalambous-ivanova' ),
=======
	// Heading Font
	$wp_customize->add_setting( 'mci_font_heading', array(
		'default'           => "'Playfair Display', serif",
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'mci_font_heading', array(
		'label'   => __( 'Heading Font', 'maria-charalambous-ivanova' ),
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
		'section' => 'mci_typography',
		'type'    => 'text',
	) );

<<<<<<< HEAD
	$wp_customize->add_setting( 'mci_font_body', array(
		'default'           => "'Inter', -apple-system, BlinkMacSystemFont, sans-serif",
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'mci_font_body', array(
		'label'   => __( 'Body Font Family', 'maria-charalambous-ivanova' ),
=======
	// Body Font
	$wp_customize->add_setting( 'mci_font_body', array(
		'default'           => "'Inter', sans-serif",
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'mci_font_body', array(
		'label'   => __( 'Body Font', 'maria-charalambous-ivanova' ),
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
		'section' => 'mci_typography',
		'type'    => 'text',
	) );

<<<<<<< HEAD
	$wp_customize->add_setting( 'mci_font_size_base', array(
		'default'           => 17,
		'sanitize_callback' => 'absint',
		'transport'         => 'refresh',
=======
	// Base Font Size
	$wp_customize->add_setting( 'mci_font_size_base', array(
		'default'           => 16,
		'sanitize_callback' => 'absint',
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
	) );
	$wp_customize->add_control( 'mci_font_size_base', array(
		'label'       => __( 'Base Font Size (px)', 'maria-charalambous-ivanova' ),
		'section'     => 'mci_typography',
		'type'        => 'number',
		'input_attrs' => array( 'min' => 14, 'max' => 20, 'step' => 1 ),
	) );

<<<<<<< HEAD
	$wp_customize->add_setting( 'mci_font_weight_normal', array(
		'default'           => '400',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
=======
	// Normal Weight
	$wp_customize->add_setting( 'mci_font_weight_normal', array(
		'default'           => '400',
		'sanitize_callback' => 'sanitize_text_field',
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
	) );
	$wp_customize->add_control( 'mci_font_weight_normal', array(
		'label'   => __( 'Normal Weight', 'maria-charalambous-ivanova' ),
		'section' => 'mci_typography',
		'type'    => 'select',
<<<<<<< HEAD
		'choices' => array( '300' => '300', '400' => '400', '500' => '500' ),
	) );

	$wp_customize->add_setting( 'mci_font_weight_bold', array(
		'default'           => '600',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
=======
		'choices' => array(
			'300' => '300',
			'400' => '400',
			'500' => '500',
		),
	) );

	// Bold Weight
	$wp_customize->add_setting( 'mci_font_weight_bold', array(
		'default'           => '700',
		'sanitize_callback' => 'sanitize_text_field',
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
	) );
	$wp_customize->add_control( 'mci_font_weight_bold', array(
		'label'   => __( 'Bold Weight', 'maria-charalambous-ivanova' ),
		'section' => 'mci_typography',
		'type'    => 'select',
<<<<<<< HEAD
		'choices' => array( '600' => '600', '700' => '700', '800' => '800', '900' => '900' ),
	) );

	$wp_customize->add_setting( 'mci_line_height', array(
		'default'           => '1.65',
		'sanitize_callback' => 'mci_sanitize_float',
		'transport'         => 'refresh',
=======
		'choices' => array(
			'600' => '600',
			'700' => '700',
			'800' => '800',
			'900' => '900',
		),
	) );

	// Line Height
	$wp_customize->add_setting( 'mci_line_height', array(
		'default'           => '1.6',
		'sanitize_callback' => 'mci_sanitize_float',
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
	) );
	$wp_customize->add_control( 'mci_line_height', array(
		'label'       => __( 'Line Height', 'maria-charalambous-ivanova' ),
		'section'     => 'mci_typography',
		'type'        => 'number',
<<<<<<< HEAD
		'input_attrs' => array( 'min' => '1.2', 'max' => '2.0', 'step' => '0.05' ),
	) );

	/* -----------------------------------------------------------------
	 * Borders
	 * -------------------------------------------------------------- */
=======
		'input_attrs' => array( 'min' => '1.2', 'max' => '2.0', 'step' => '0.1' ),
	) );

	/* -------------------------------------------------------------------------
	 * Section: Borders
	 * ---------------------------------------------------------------------- */
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
	$wp_customize->add_section( 'mci_borders', array(
		'title' => __( 'Borders', 'maria-charalambous-ivanova' ),
		'panel' => 'mci_design_tokens',
	) );

<<<<<<< HEAD
	$borders = array(
		'radius_sm'    => array( 'Small Radius (px)',  8,  0, 16 ),
		'radius_md'    => array( 'Medium Radius (px)', 12, 0, 24 ),
		'radius_lg'    => array( 'Large Radius (px)',  20, 0, 40 ),
		'border_width' => array( 'Border Width (px)',  1,  1, 4 ),
	);

	foreach ( $borders as $key => $meta ) {
		$id = 'mci_' . $key;

		$wp_customize->add_setting( $id, array(
			'default'           => $meta[1],
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		) );

		$wp_customize->add_control( $id, array(
=======
	$border_settings = array(
		'radius_sm'    => array( 'Small Radius (px)',  4, 0, 16 ),
		'radius_md'    => array( 'Medium Radius (px)', 8, 0, 24 ),
		'radius_lg'    => array( 'Large Radius (px)',  16, 0, 40 ),
		'border_width' => array( 'Border Width (px)',  1, 1, 4 ),
	);

	foreach ( $border_settings as $key => $meta ) {
		$setting_id = 'mci_' . $key;

		$wp_customize->add_setting( $setting_id, array(
			'default'           => $meta[1],
			'sanitize_callback' => 'absint',
		) );

		$wp_customize->add_control( $setting_id, array(
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
			'label'       => $meta[0],
			'section'     => 'mci_borders',
			'type'        => 'number',
			'input_attrs' => array( 'min' => $meta[2], 'max' => $meta[3], 'step' => 1 ),
		) );
	}

<<<<<<< HEAD
	/* -----------------------------------------------------------------
	 * Spacing
	 * -------------------------------------------------------------- */
=======
	/* -------------------------------------------------------------------------
	 * Section: Spacing
	 * ---------------------------------------------------------------------- */
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
	$wp_customize->add_section( 'mci_spacing', array(
		'title' => __( 'Spacing', 'maria-charalambous-ivanova' ),
		'panel' => 'mci_design_tokens',
	) );

	$wp_customize->add_setting( 'mci_spacing_unit', array(
		'default'           => 8,
		'sanitize_callback' => 'absint',
<<<<<<< HEAD
		'transport'         => 'refresh',
=======
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
	) );
	$wp_customize->add_control( 'mci_spacing_unit', array(
		'label'       => __( 'Spacing Unit (px)', 'maria-charalambous-ivanova' ),
		'section'     => 'mci_spacing',
		'type'        => 'number',
		'input_attrs' => array( 'min' => 4, 'max' => 12, 'step' => 1 ),
	) );

	$wp_customize->add_setting( 'mci_container_width', array(
<<<<<<< HEAD
		'default'           => 1080,
		'sanitize_callback' => 'absint',
		'transport'         => 'refresh',
=======
		'default'           => 1120,
		'sanitize_callback' => 'absint',
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
	) );
	$wp_customize->add_control( 'mci_container_width', array(
		'label'       => __( 'Container Width (px)', 'maria-charalambous-ivanova' ),
		'section'     => 'mci_spacing',
		'type'        => 'number',
		'input_attrs' => array( 'min' => 800, 'max' => 1400, 'step' => 10 ),
	) );
}
add_action( 'customize_register', 'mci_customize_register' );

/**
<<<<<<< HEAD
 * Sanitize a float value.
=======
 * Sanitize float values.
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
 */
function mci_sanitize_float( $val ) {
	return floatval( $val );
}

/**
<<<<<<< HEAD
 * Output design tokens as CSS custom properties.
 */
function mci_customizer_css() {
	$colors = array(
		'primary'         => '#0071E3',
		'primary_hover'   => '#005BBB',
		'secondary'       => '#1D1D1F',
		'secondary_hover' => '#424245',
		'text'            => '#1D1D1F',
		'text_light'      => '#6E6E73',
		'background'      => '#F5F5F7',
		'surface'         => '#FFFFFF',
		'border'          => '#D2D2D7',
		'white'           => '#FFFFFF',
	);

	$unit = absint( get_theme_mod( 'mci_spacing_unit', 8 ) );

	echo '<style id="mci-design-tokens">' . "\n";
	echo ':root {' . "\n";

	foreach ( $colors as $key => $default ) {
		$value = get_theme_mod( 'mci_color_' . $key, $default );
		$prop  = str_replace( '_', '-', $key );
		echo "\t" . '--mci-color-' . esc_attr( $prop ) . ': ' . esc_attr( $value ) . ';' . "\n";
	}

	echo "\n";
	echo "\t" . '--mci-font-heading: ' . esc_attr( get_theme_mod( 'mci_font_heading', "'Playfair Display', Georgia, serif" ) ) . ';' . "\n";
	echo "\t" . '--mci-font-body: ' . esc_attr( get_theme_mod( 'mci_font_body', "'Inter', -apple-system, BlinkMacSystemFont, sans-serif" ) ) . ';' . "\n";
	echo "\t" . '--mci-font-size-base: ' . absint( get_theme_mod( 'mci_font_size_base', 17 ) ) . 'px;' . "\n";
	echo "\t" . '--mci-font-weight-normal: ' . esc_attr( get_theme_mod( 'mci_font_weight_normal', '400' ) ) . ';' . "\n";
	echo "\t" . '--mci-font-weight-bold: ' . esc_attr( get_theme_mod( 'mci_font_weight_bold', '600' ) ) . ';' . "\n";
	echo "\t" . '--mci-line-height: ' . floatval( get_theme_mod( 'mci_line_height', '1.65' ) ) . ';' . "\n";

	echo "\n";
	echo "\t" . '--mci-radius-sm: ' . absint( get_theme_mod( 'mci_radius_sm', 8 ) ) . 'px;' . "\n";
	echo "\t" . '--mci-radius-md: ' . absint( get_theme_mod( 'mci_radius_md', 12 ) ) . 'px;' . "\n";
	echo "\t" . '--mci-radius-lg: ' . absint( get_theme_mod( 'mci_radius_lg', 20 ) ) . 'px;' . "\n";
	echo "\t" . '--mci-border-width: ' . absint( get_theme_mod( 'mci_border_width', 1 ) ) . 'px;' . "\n";

	echo "\n";
	echo "\t" . '--mci-spacing-unit: ' . $unit . 'px;' . "\n";
	echo "\t" . '--mci-container-width: ' . absint( get_theme_mod( 'mci_container_width', 1080 ) ) . 'px;' . "\n";

	echo "\n";
	echo "\t" . '--mci-spacing-xs: '  . ( $unit * 1 )  . 'px;' . "\n";
	echo "\t" . '--mci-spacing-sm: '  . ( $unit * 2 )  . 'px;' . "\n";
	echo "\t" . '--mci-spacing-md: '  . ( $unit * 3 )  . 'px;' . "\n";
	echo "\t" . '--mci-spacing-lg: '  . ( $unit * 4 )  . 'px;' . "\n";
	echo "\t" . '--mci-spacing-xl: '  . ( $unit * 6 )  . 'px;' . "\n";
	echo "\t" . '--mci-spacing-2xl: ' . ( $unit * 8 )  . 'px;' . "\n";
	echo "\t" . '--mci-spacing-3xl: ' . ( $unit * 12 ) . 'px;' . "\n";

	echo '}' . "\n";
	echo '</style>' . "\n";
=======
 * Output CSS custom properties in <head>.
 */
function mci_customizer_css() {
	$unit = absint( get_theme_mod( 'mci_spacing_unit', 8 ) );

	$colors = array(
		'primary'         => '#1a5c6b',
		'primary_hover'   => '#134a56',
		'secondary'       => '#c9a84c',
		'secondary_hover' => '#b8963e',
		'text'            => '#2c2c2c',
		'text_light'      => '#6b6b6b',
		'background'      => '#ffffff',
		'surface'         => '#f7f7f5',
		'border'          => '#e0ddd5',
		'white'           => '#ffffff',
	);
	?>
<style id="mci-design-tokens">
:root {
	<?php foreach ( $colors as $key => $default ) :
		$value = get_theme_mod( 'mci_color_' . $key, $default );
		$prop  = str_replace( '_', '-', $key );
	?>
	--mci-color-<?php echo esc_attr( $prop ); ?>: <?php echo esc_attr( $value ); ?>;
	<?php endforeach; ?>

	/* Typography */
	--mci-font-heading: <?php echo esc_attr( get_theme_mod( 'mci_font_heading', "'Playfair Display', serif" ) ); ?>;
	--mci-font-body: <?php echo esc_attr( get_theme_mod( 'mci_font_body', "'Inter', sans-serif" ) ); ?>;
	--mci-font-size-base: <?php echo absint( get_theme_mod( 'mci_font_size_base', 16 ) ); ?>px;
	--mci-font-weight-normal: <?php echo esc_attr( get_theme_mod( 'mci_font_weight_normal', '400' ) ); ?>;
	--mci-font-weight-bold: <?php echo esc_attr( get_theme_mod( 'mci_font_weight_bold', '700' ) ); ?>;
	--mci-line-height: <?php echo floatval( get_theme_mod( 'mci_line_height', '1.6' ) ); ?>;

	/* Borders */
	--mci-radius-sm: <?php echo absint( get_theme_mod( 'mci_radius_sm', 4 ) ); ?>px;
	--mci-radius-md: <?php echo absint( get_theme_mod( 'mci_radius_md', 8 ) ); ?>px;
	--mci-radius-lg: <?php echo absint( get_theme_mod( 'mci_radius_lg', 16 ) ); ?>px;
	--mci-border-width: <?php echo absint( get_theme_mod( 'mci_border_width', 1 ) ); ?>px;

	/* Spacing */
	--mci-spacing-unit: <?php echo $unit; ?>px;
	--mci-container-width: <?php echo absint( get_theme_mod( 'mci_container_width', 1120 ) ); ?>px;

	/* Derived spacing scale */
	--mci-spacing-xs: <?php echo $unit * 1; ?>px;
	--mci-spacing-sm: <?php echo $unit * 2; ?>px;
	--mci-spacing-md: <?php echo $unit * 3; ?>px;
	--mci-spacing-lg: <?php echo $unit * 4; ?>px;
	--mci-spacing-xl: <?php echo $unit * 6; ?>px;
	--mci-spacing-2xl: <?php echo $unit * 8; ?>px;
	--mci-spacing-3xl: <?php echo $unit * 12; ?>px;
}
</style>
	<?php
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
}
add_action( 'wp_head', 'mci_customizer_css', 25 );
