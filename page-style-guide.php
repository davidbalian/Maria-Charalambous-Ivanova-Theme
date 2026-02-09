<?php
/**
 * Template Name: Style Guide
 *
 * A minimal reference of design tokens and core UI components.
 *
 * @package Maria_Charalambous_Ivanova
 */

get_header();

$colors = array(
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
?>

<main id="style-guide" class="style-guide">

	<header class="sg-hero">
		<div class="container">
			<h1 class="sg-hero__title">Style Guide</h1>
			<p class="sg-hero__subtitle">Design tokens and core components at a glance.</p>
		</div>
	</header>

	<div class="container">

		<!-- Colors -->
		<section id="sg-colors" class="sg-section">
			<h2 class="sg-section__title">Colors</h2>

			<div class="sg-swatches">
				<?php foreach ( $colors as $key => $meta ) :
					$value = $meta[1];
					$prop  = str_replace( '_', '-', $key );
				?>
					<div class="sg-swatch">
						<div class="sg-swatch__color" style="background-color: var(--mci-color-<?php echo esc_attr( $prop ); ?>);"></div>
						<span class="sg-swatch__label"><?php echo esc_html( $meta[0] ); ?></span>
						<span class="sg-swatch__hex"><?php echo esc_html( strtoupper( $value ) ); ?></span>
						<code class="sg-swatch__var">--mci-color-<?php echo esc_html( $prop ); ?></code>
					</div>
				<?php endforeach; ?>
			</div>
		</section>

		<!-- Typography -->
		<section id="sg-typography" class="sg-section">
			<h2 class="sg-section__title">Typography</h2>

			<div class="sg-type-specimen">
				<h3 class="sg-type-specimen__name" style="font-family: var(--mci-font-heading);">Playfair Display</h3>
				<p class="sg-type-specimen__meta">Headings &middot; Display &middot; Editorial</p>
			</div>

			<div class="sg-type-specimen">
				<h3 class="sg-type-specimen__name" style="font-family: var(--mci-font-body); letter-spacing: -0.02em;">Inter</h3>
				<p class="sg-type-specimen__meta">Body &middot; Interface &middot; System</p>
			</div>

			<div class="sg-type-scale">
				<div class="sg-type-scale__row">
					<span class="sg-type-scale__label">H1</span>
					<div class="sg-type-scale__sample"><h1 style="margin-bottom: 0;">The Art of Healing</h1></div>
				</div>
				<div class="sg-type-scale__row">
					<span class="sg-type-scale__label">H2</span>
					<div class="sg-type-scale__sample"><h2 style="margin-bottom: 0;">Clinical Expertise</h2></div>
				</div>
				<div class="sg-type-scale__row">
					<span class="sg-type-scale__label">H3</span>
					<div class="sg-type-scale__sample"><h3 style="margin-bottom: 0;">Patient-Centered Care</h3></div>
				</div>
				<div class="sg-type-scale__row">
					<span class="sg-type-scale__label">H4</span>
					<div class="sg-type-scale__sample"><h4 style="margin-bottom: 0;">Professional Background</h4></div>
				</div>
				<div class="sg-type-scale__row">
					<span class="sg-type-scale__label">Body</span>
					<div class="sg-type-scale__sample"><p style="margin-bottom: 0;">The intersection of medical science and human empathy defines the highest standard of patient care.</p></div>
				</div>
				<div class="sg-type-scale__row">
					<span class="sg-type-scale__label">Quote</span>
					<div class="sg-type-scale__sample"><blockquote style="margin: 0;"><p>&ldquo;The good physician treats the disease; the great physician treats the patient who has the disease.&rdquo;</p></blockquote></div>
				</div>
			</div>
		</section>

		<!-- Buttons -->
		<section id="sg-buttons" class="sg-section">
			<h2 class="sg-section__title">Buttons</h2>

			<div class="sg-button-row">
				<a href="#" class="btn btn-primary" onclick="return false;">Primary</a>
				<a href="#" class="btn btn-secondary" onclick="return false;">Secondary</a>
				<a href="#" class="btn btn-outline" onclick="return false;">Outline</a>
			</div>
		</section>

	</div>
</main>

<?php get_footer(); ?>
