<?php
/**
 * Template Name: Style Guide
 *
<<<<<<< HEAD
 * A meticulous reference of every design token and UI component.
=======
 * Displays all design-system components for reference.
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
 *
 * @package Maria_Charalambous_Ivanova
 */

<<<<<<< HEAD
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
=======
get_header(); ?>

<main id="style-guide" class="style-guide">

	<!-- Sticky Sub-Nav -->
	<nav class="sg-nav" aria-label="Style guide sections">
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
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

<<<<<<< HEAD
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
=======
	<div class="container">

		<header class="sg-header">
			<h1>Style Guide</h1>
			<p>A living reference of all design tokens and UI components used across this site.</p>
		</header>

		<!-- ============================================================
			 1. Color Palette
			 ============================================================ -->
		<section id="sg-colors" class="sg-section">
			<h2 class="sg-section__title">Color Palette</h2>
			<div class="sg-swatches">
				<?php
				$swatches = array(
					array( 'Primary',         '--mci-color-primary' ),
					array( 'Primary Hover',   '--mci-color-primary-hover' ),
					array( 'Secondary',       '--mci-color-secondary' ),
					array( 'Secondary Hover', '--mci-color-secondary-hover' ),
					array( 'Text',            '--mci-color-text' ),
					array( 'Text Light',      '--mci-color-text-light' ),
					array( 'Background',      '--mci-color-background' ),
					array( 'Surface',         '--mci-color-surface' ),
					array( 'Border',          '--mci-color-border' ),
					array( 'White',           '--mci-color-white' ),
				);
				foreach ( $swatches as $s ) : ?>
					<div class="sg-swatch">
						<div class="sg-swatch__color" style="background-color: var(<?php echo esc_attr( $s[1] ); ?>);"></div>
						<span class="sg-swatch__label"><?php echo esc_html( $s[0] ); ?></span>
						<code class="sg-swatch__var"><?php echo esc_html( $s[1] ); ?></code>
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
					</div>
				<?php endforeach; ?>
			</div>
		</section>

<<<<<<< HEAD
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
=======
		<!-- ============================================================
			 2. Typography
			 ============================================================ -->
		<section id="sg-typography" class="sg-section">
			<h2 class="sg-section__title">Typography</h2>

			<h1>Heading One — The Art of Healing</h1>
			<h2>Heading Two — Clinical Expertise</h2>
			<h3>Heading Three — Patient-Centered Care</h3>
			<h4>Heading Four — Professional Background</h4>

			<p>Body text — Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

			<p>A second paragraph to demonstrate spacing. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>

			<blockquote>
				<p>"The good physician treats the disease; the great physician treats the patient who has the disease."</p>
			</blockquote>
		</section>

		<!-- ============================================================
			 3. Buttons
			 ============================================================ -->
		<section id="sg-buttons" class="sg-section">
			<h2 class="sg-section__title">Buttons</h2>

			<div class="sg-button-row">
				<a href="#" class="btn btn-primary">Primary Button</a>
				<a href="#" class="btn btn-secondary">Secondary Button</a>
				<a href="#" class="btn btn-outline">Outline Button</a>
			</div>

			<h3>Disabled State</h3>
			<div class="sg-button-row">
				<button class="btn btn-primary" disabled>Primary Disabled</button>
				<button class="btn btn-secondary" disabled>Secondary Disabled</button>
				<button class="btn btn-outline" disabled>Outline Disabled</button>
			</div>
		</section>

		<!-- ============================================================
			 4. Cards
			 ============================================================ -->
		<section id="sg-cards" class="sg-section">
			<h2 class="sg-section__title">Cards</h2>

			<div class="card-grid">
				<!-- Basic Card -->
				<div class="card">
					<div class="card-body">
						<h3>Basic Card</h3>
						<p>This is a basic card component with a heading and body text. It uses surface background, border, and medium radius tokens.</p>
						<a href="#" class="btn btn-primary">Learn More</a>
					</div>
				</div>

				<!-- Card with Image -->
				<div class="card">
					<div class="card-image">
						<div class="sg-placeholder-img" aria-label="Placeholder image">
							<span>Image Placeholder</span>
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
						</div>
					</div>
					<div class="card-body">
						<h3>Card with Image</h3>
<<<<<<< HEAD
						<p>Includes a media area above the content body for visual context.</p>
						<a href="#" class="btn btn-outline" onclick="return false;">Read More</a>
					</div>
				</div>

				<div class="card">
					<div class="card-body">
						<h3>Feature Card</h3>
						<p>Cards arranged in a responsive grid adapt gracefully across viewport widths.</p>
						<a href="#" class="btn btn-secondary" onclick="return false;">Details</a>
=======
						<p>A card variant that includes an image area above the content body.</p>
						<a href="#" class="btn btn-outline">Read More</a>
					</div>
				</div>

				<!-- Additional Card -->
				<div class="card">
					<div class="card-body">
						<h3>Another Card</h3>
						<p>Cards can be arranged in a responsive grid. This third card demonstrates the layout at various widths.</p>
						<a href="#" class="btn btn-secondary">Details</a>
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
					</div>
				</div>
			</div>
		</section>

<<<<<<< HEAD
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
=======
		<!-- ============================================================
			 5. Forms
			 ============================================================ -->
		<section id="sg-forms" class="sg-section">
			<h2 class="sg-section__title">Forms</h2>

			<h3>Individual Controls</h3>
			<div class="sg-form-controls">
				<div class="form-group">
					<label for="sg-input">Text Input</label>
					<input type="text" id="sg-input" placeholder="Enter text...">
				</div>

				<div class="form-group">
					<label for="sg-email">Email Input</label>
					<input type="email" id="sg-email" placeholder="name@example.com">
				</div>

				<div class="form-group">
					<label for="sg-select">Select Menu</label>
					<select id="sg-select">
						<option value="">Choose an option...</option>
						<option value="1">Option One</option>
						<option value="2">Option Two</option>
						<option value="3">Option Three</option>
					</select>
				</div>

				<div class="form-group">
					<label for="sg-textarea">Textarea</label>
					<textarea id="sg-textarea" rows="4" placeholder="Write a message..."></textarea>
				</div>
			</div>

			<h3>Mini Contact Form</h3>
			<form class="sg-mini-form" onsubmit="return false;">
				<div class="form-group">
					<label for="sg-form-name">Full Name</label>
					<input type="text" id="sg-form-name" placeholder="Dr. Maria Charalambous-Ivanova">
				</div>
				<div class="form-group">
					<label for="sg-form-email">Email Address</label>
					<input type="email" id="sg-form-email" placeholder="maria@example.com">
				</div>
				<div class="form-group">
					<label for="sg-form-subject">Subject</label>
					<select id="sg-form-subject">
						<option value="">Select a subject...</option>
						<option value="appointment">Book an Appointment</option>
						<option value="consultation">Request Consultation</option>
						<option value="other">General Inquiry</option>
					</select>
				</div>
				<div class="form-group">
					<label for="sg-form-message">Message</label>
					<textarea id="sg-form-message" rows="4" placeholder="How can we help you?"></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Send Message</button>
			</form>
		</section>

		<!-- ============================================================
			 6. Alerts
			 ============================================================ -->
		<section id="sg-alerts" class="sg-section">
			<h2 class="sg-section__title">Alerts</h2>

			<div class="alert alert-info">
				<strong>Information:</strong> Your appointment has been scheduled. Please check your email for confirmation details.
			</div>

			<div class="alert alert-success">
				<strong>Success:</strong> Your message has been sent successfully. We will respond within 24 hours.
			</div>

			<div class="alert alert-warning">
				<strong>Warning:</strong> Your session is about to expire. Please save any unsaved changes.
			</div>
		</section>

		<!-- ============================================================
			 7. Badges
			 ============================================================ -->
		<section id="sg-badges" class="sg-section">
			<h2 class="sg-section__title">Badges</h2>

			<div class="sg-badge-row">
				<span class="badge badge-primary">Primary Badge</span>
				<span class="badge badge-secondary">Secondary Badge</span>
			</div>
		</section>

		<!-- ============================================================
			 8. Dividers
			 ============================================================ -->
		<section id="sg-dividers" class="sg-section">
			<h2 class="sg-section__title">Dividers</h2>

			<p>A standard horizontal rule:</p>
			<hr>
			<p>Content continues after the divider.</p>
		</section>

	</div><!-- .container -->
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
</main>

<?php get_footer(); ?>
