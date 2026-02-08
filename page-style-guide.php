<?php
/**
 * Template Name: Style Guide
 *
 * A meticulous reference of every design token and UI component.
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

	<nav class="sg-nav" aria-label="<?php esc_attr_e( 'Style guide sections', 'maria-charalambous-ivanova' ); ?>">
		<div class="container">
			<ul class="sg-nav__list">
				<li><a href="#sg-colors">Colors</a></li>
				<li><a href="#sg-typography">Typography</a></li>
				<li><a href="#sg-buttons">Buttons</a></li>
				<li><a href="#sg-cards">Cards</a></li>
				<li><a href="#sg-forms">Forms</a></li>
				<li><a href="#sg-alerts">Alerts</a></li>
				<li><a href="#sg-badges">Badges</a></li>
				<li><a href="#sg-dividers">Dividers</a></li>
			</ul>
		</div>
	</nav>

	<!-- Hero -->
	<header class="sg-hero">
		<div class="container">
			<p class="sg-hero__label"><?php bloginfo( 'name' ); ?></p>
			<h1 class="sg-hero__title">Design<br>System</h1>
			<p class="sg-hero__subtitle">A meticulous collection of visual tokens, components, and patterns &mdash; designed with obsessive attention to detail.</p>
		</div>
	</header>

	<div class="container">

		<!-- ==========================================================
			 01 — Color Palette
			 ========================================================== -->
		<section id="sg-colors" class="sg-section">
			<div class="sg-section__header">
				<span class="sg-section__number">01</span>
				<h2 class="sg-section__title">Color Palette</h2>
				<p class="sg-section__desc">A restrained palette built on trust and clarity. Every color earns its place.</p>
			</div>

			<div class="sg-swatches">
				<?php foreach ( $colors as $key => $meta ) :
					$value = get_theme_mod( 'mci_color_' . $key, $meta[1] );
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

		<!-- ==========================================================
			 02 — Typography
			 ========================================================== -->
		<section id="sg-typography" class="sg-section">
			<div class="sg-section__header">
				<span class="sg-section__number">02</span>
				<h2 class="sg-section__title">Typography</h2>
				<p class="sg-section__desc">Two typefaces. One for expression, one for precision. Together they create a voice that is warm yet authoritative.</p>
			</div>

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
					<div class="sg-type-scale__sample">
						<h1 style="margin-bottom: 0;">The Art of Healing</h1>
					</div>
				</div>

				<div class="sg-type-scale__row">
					<span class="sg-type-scale__label">H2</span>
					<div class="sg-type-scale__sample">
						<h2 style="margin-bottom: 0;">Clinical Expertise</h2>
					</div>
				</div>

				<div class="sg-type-scale__row">
					<span class="sg-type-scale__label">H3</span>
					<div class="sg-type-scale__sample">
						<h3 style="margin-bottom: 0;">Patient-Centered Care</h3>
					</div>
				</div>

				<div class="sg-type-scale__row">
					<span class="sg-type-scale__label">H4</span>
					<div class="sg-type-scale__sample">
						<h4 style="margin-bottom: 0;">Professional Background</h4>
					</div>
				</div>

				<div class="sg-type-scale__row">
					<span class="sg-type-scale__label">Body</span>
					<div class="sg-type-scale__sample">
						<p style="margin-bottom: 0;">The intersection of medical science and human empathy defines the highest standard of patient care. Every interaction is an opportunity to listen, understand, and heal.</p>
					</div>
				</div>

				<div class="sg-type-scale__row">
					<span class="sg-type-scale__label">Quote</span>
					<div class="sg-type-scale__sample">
						<blockquote style="margin: 0;">
							<p>&ldquo;The good physician treats the disease; the great physician treats the patient who has the disease.&rdquo;</p>
						</blockquote>
					</div>
				</div>
			</div>
		</section>

		<!-- ==========================================================
			 03 — Buttons
			 ========================================================== -->
		<section id="sg-buttons" class="sg-section">
			<div class="sg-section__header">
				<span class="sg-section__number">03</span>
				<h2 class="sg-section__title">Buttons</h2>
				<p class="sg-section__desc">Three variants, each with a clear purpose. Primary for key actions. Secondary for supporting actions. Outline for tertiary options.</p>
			</div>

			<h3>Default</h3>
			<div class="sg-button-row">
				<a href="#" class="btn btn-primary" onclick="return false;">Primary</a>
				<a href="#" class="btn btn-secondary" onclick="return false;">Secondary</a>
				<a href="#" class="btn btn-outline" onclick="return false;">Outline</a>
			</div>

			<h3>Disabled</h3>
			<div class="sg-button-row">
				<button class="btn btn-primary" disabled>Primary</button>
				<button class="btn btn-secondary" disabled>Secondary</button>
				<button class="btn btn-outline" disabled>Outline</button>
			</div>
		</section>

		<!-- ==========================================================
			 04 — Cards
			 ========================================================== -->
		<section id="sg-cards" class="sg-section">
			<div class="sg-section__header">
				<span class="sg-section__number">04</span>
				<h2 class="sg-section__title">Cards</h2>
				<p class="sg-section__desc">Elevated surfaces that organize content into scannable, tactile units.</p>
			</div>

			<div class="card-grid">
				<div class="card">
					<div class="card-body">
						<h3>Basic Card</h3>
						<p>A clean container for related content. Uses surface background, subtle shadow, and generous padding.</p>
						<a href="#" class="btn btn-primary" onclick="return false;">Learn More</a>
					</div>
				</div>

				<div class="card">
					<div class="card-image">
						<div class="sg-placeholder-img" aria-label="<?php esc_attr_e( 'Placeholder image', 'maria-charalambous-ivanova' ); ?>">
							<span>16 : 10</span>
						</div>
					</div>
					<div class="card-body">
						<h3>Card with Image</h3>
						<p>Includes a media area above the content body for visual context.</p>
						<a href="#" class="btn btn-outline" onclick="return false;">Read More</a>
					</div>
				</div>

				<div class="card">
					<div class="card-body">
						<h3>Feature Card</h3>
						<p>Cards arranged in a responsive grid adapt gracefully across viewport widths.</p>
						<a href="#" class="btn btn-secondary" onclick="return false;">Details</a>
					</div>
				</div>
			</div>
		</section>

		<!-- ==========================================================
			 05 — Forms
			 ========================================================== -->
		<section id="sg-forms" class="sg-section">
			<div class="sg-section__header">
				<span class="sg-section__number">05</span>
				<h2 class="sg-section__title">Forms</h2>
				<p class="sg-section__desc">Clean, accessible inputs that guide the user with clarity. Focus states provide unmistakable feedback.</p>
			</div>

			<div class="sg-form-demo">
				<form onsubmit="return false;">
					<div class="form-group">
						<label for="sg-name">Full Name</label>
						<input type="text" id="sg-name" placeholder="Dr. Maria Charalambous-Ivanova">
					</div>

					<div class="form-group">
						<label for="sg-email">Email Address</label>
						<input type="email" id="sg-email" placeholder="maria@example.com">
					</div>

					<div class="form-group">
						<label for="sg-subject">Subject</label>
						<select id="sg-subject">
							<option value="">Select a subject&hellip;</option>
							<option value="appointment">Book an Appointment</option>
							<option value="consultation">Request Consultation</option>
							<option value="other">General Inquiry</option>
						</select>
					</div>

					<div class="form-group">
						<label for="sg-message">Message</label>
						<textarea id="sg-message" rows="4" placeholder="How can we help you?"></textarea>
					</div>

					<button type="submit" class="btn btn-primary">Send Message</button>
				</form>
			</div>
		</section>

		<!-- ==========================================================
			 06 — Alerts
			 ========================================================== -->
		<section id="sg-alerts" class="sg-section">
			<div class="sg-section__header">
				<span class="sg-section__number">06</span>
				<h2 class="sg-section__title">Alerts</h2>
				<p class="sg-section__desc">Contextual messages that communicate status clearly without demanding attention.</p>
			</div>

			<div class="sg-alert-stack">
				<div class="alert alert-info">
					<strong>Information</strong> &mdash; Your appointment has been scheduled. Check your email for confirmation.
				</div>

				<div class="alert alert-success">
					<strong>Success</strong> &mdash; Your message has been sent. We will respond within 24 hours.
				</div>

				<div class="alert alert-warning">
					<strong>Attention</strong> &mdash; Your session is about to expire. Please save any unsaved changes.
				</div>
			</div>
		</section>

		<!-- ==========================================================
			 07 — Badges
			 ========================================================== -->
		<section id="sg-badges" class="sg-section">
			<div class="sg-section__header">
				<span class="sg-section__number">07</span>
				<h2 class="sg-section__title">Badges</h2>
				<p class="sg-section__desc">Compact labels for categorization and status.</p>
			</div>

			<div class="sg-badge-row">
				<span class="badge badge-primary">Primary</span>
				<span class="badge badge-secondary">Secondary</span>
			</div>
		</section>

		<!-- ==========================================================
			 08 — Dividers
			 ========================================================== -->
		<section id="sg-dividers" class="sg-section">
			<div class="sg-section__header">
				<span class="sg-section__number">08</span>
				<h2 class="sg-section__title">Dividers</h2>
				<p class="sg-section__desc">Subtle separators that create visual rhythm without drawing attention to themselves.</p>
			</div>

			<p>Content above the divider.</p>
			<hr>
			<p>Content below the divider.</p>
		</section>

	</div>
</main>

<?php get_footer(); ?>
