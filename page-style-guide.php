<?php
/**
 * Template Name: Style Guide
 *
 * Displays all design-system components for reference.
 *
 * @package Maria_Charalambous_Ivanova
 */

get_header(); ?>

<main id="style-guide" class="style-guide">

	<!-- Sticky Sub-Nav -->
	<nav class="sg-nav" aria-label="Style guide sections">
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
					</div>
				<?php endforeach; ?>
			</div>
		</section>

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
						</div>
					</div>
					<div class="card-body">
						<h3>Card with Image</h3>
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
					</div>
				</div>
			</div>
		</section>

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
</main>

<?php get_footer(); ?>
