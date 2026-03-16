<?php
/**
 * Template Name: Privacy Policy
 *
 * @package Maria_Charalambous_Ivanova
 */

get_header();

$clinic_image_base = 'https://davidb1646.sg-host.com/wp-content/uploads/2026/02/';
?>

<main id="main" class="site-main">

	<!-- Hero -->
	<section class="privacy-hero" style="background-image: url('<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-lobby-clinic-name.avif' ); ?>');">
		<div class="privacy-hero__overlay"></div>
		<div class="container privacy-hero__content">
			<h1 class="privacy-hero__title fade-in fade-in-delay-0"><?php mci_te( 'Privacy Policy' ); ?></h1>
			<p class="privacy-hero__subtitle fade-in fade-in-delay-1"><?php mci_te( 'How we collect, use, and protect your personal information.' ); ?></p>
		</div>
	</section>

	<!-- Privacy Content -->
	<section class="page-section page-section--surface">
		<div class="container">
			<div class="privacy-content">

				<p><?php echo mci_t( 'Dental Art Clinic by Dr. Maria Charalambous-Ivanova ("we", "us", or "our") operates the website dentalartcliniclimassol.com. This Privacy Policy explains how we collect, use, and safeguard your personal data when you visit our website or use our services, in accordance with the General Data Protection Regulation (GDPR) and the Cyprus Processing of Personal Data (Protection of the Individual) Law.' ); ?></p>

				<h2><?php mci_te( 'Data Controller' ); ?></h2>
				<p><?php mci_te( 'The data controller responsible for your personal data is:' ); ?></p>
				<p>
					Dr. Maria Charalambous-Ivanova<br>
					Dental Art Clinic<br>
					PRIMO AMARI, Walter Gropius 49-49, Floor 1, Apt. 101<br>
					Limassol 3076, Cyprus<br>
					Email: <a href="mailto:info@dentalartcliniclimassol.com">info@dentalartcliniclimassol.com</a><br>
					Phone: <a href="tel:+35725377757">+357 25 377757</a>
				</p>

				<h2><?php mci_te( 'Information We Collect' ); ?></h2>

				<h3><?php mci_te( 'Information You Provide' ); ?></h3>
				<p><?php mci_te( 'When you book an appointment or submit a contact form on our website, we collect:' ); ?></p>
				<ul>
					<li><?php mci_te( 'Full name' ); ?></li>
					<li><?php mci_te( 'Phone number' ); ?></li>
					<li><?php mci_te( 'Selected service of interest' ); ?></li>
					<li><?php mci_te( 'Any additional information you include in your message' ); ?></li>
				</ul>

				<h3><?php mci_te( 'Information Collected Automatically' ); ?></h3>
				<p><?php mci_te( 'When you visit our website, we automatically collect certain information through Google Analytics, including:' ); ?></p>
				<ul>
					<li><?php mci_te( 'IP address (anonymised)' ); ?></li>
					<li><?php mci_te( 'Browser type and version' ); ?></li>
					<li><?php mci_te( 'Operating system' ); ?></li>
					<li><?php mci_te( 'Pages visited, time spent on pages, and navigation paths' ); ?></li>
					<li><?php mci_te( 'Referring website or source' ); ?></li>
					<li><?php mci_te( 'Device type (desktop, mobile, or tablet)' ); ?></li>
					<li><?php mci_te( 'Approximate geographic location (city/country level)' ); ?></li>
				</ul>

				<h2><?php mci_te( 'How We Use Your Information' ); ?></h2>
				<p><?php mci_te( 'We use the information we collect for the following purposes:' ); ?></p>
				<ul>
					<li><?php mci_te( 'To respond to your enquiries and schedule appointments' ); ?></li>
					<li><?php mci_te( 'To provide dental care and maintain treatment records as required by law' ); ?></li>
					<li><?php mci_te( 'To communicate with you about your treatment or upcoming appointments' ); ?></li>
					<li><?php mci_te( 'To analyse website traffic and improve our website experience through Google Analytics' ); ?></li>
					<li><?php mci_te( 'To comply with our legal and regulatory obligations' ); ?></li>
				</ul>

				<h2><?php mci_te( 'Legal Basis for Processing' ); ?></h2>
				<p><?php mci_te( 'We process your personal data on the following legal grounds:' ); ?></p>
				<ul>
					<li><strong><?php mci_te( 'Consent:' ); ?></strong> <?php mci_te( 'When you submit a contact or appointment form, you consent to us processing your data for the purpose of responding to your enquiry.' ); ?></li>
					<li><strong><?php mci_te( 'Contractual necessity:' ); ?></strong> <?php mci_te( 'Processing is necessary to provide dental services you have requested.' ); ?></li>
					<li><strong><?php mci_te( 'Legal obligation:' ); ?></strong> <?php mci_te( 'We are required to maintain patient records in compliance with Cyprus healthcare regulations.' ); ?></li>
					<li><strong><?php mci_te( 'Legitimate interest:' ); ?></strong> <?php mci_te( 'We use Google Analytics to understand how visitors use our website so we can improve it. This processing is based on our legitimate interest in maintaining and enhancing our online presence.' ); ?></li>
				</ul>

				<h2><?php mci_te( 'Google Analytics' ); ?></h2>
				<p><?php mci_te( 'This website uses Google Analytics, a web analytics service provided by Google LLC. Google Analytics uses cookies to help us analyse how visitors use our website. The information generated by the cookie about your use of the website is transmitted to and stored by Google on servers in the United States.' ); ?></p>
				<p><?php mci_te( 'We have enabled IP anonymisation, which means your IP address is truncated before being transmitted to Google. Google will use this information to evaluate your use of the website, compile reports on website activity, and provide other services related to website usage.' ); ?></p>
				<p><?php echo mci_t( 'You can prevent Google Analytics from collecting your data by installing the <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener noreferrer">Google Analytics Opt-out Browser Add-on</a>.' ); ?></p>
				<p><?php echo mci_t( 'For more information on how Google handles your data, please refer to <a href="https://policies.google.com/privacy" target="_blank" rel="noopener noreferrer">Google\'s Privacy Policy</a>.' ); ?></p>

				<h2><?php mci_te( 'Cookies' ); ?></h2>
				<p><?php mci_te( 'Our website uses cookies to ensure proper functionality and to collect analytics data. The cookies we use include:' ); ?></p>
				<ul>
					<li><strong><?php mci_te( 'Essential cookies:' ); ?></strong> <?php mci_te( 'Required for the website to function correctly, such as form submission and session handling.' ); ?></li>
					<li><strong><?php mci_te( 'Analytics cookies:' ); ?></strong> <?php echo mci_t( 'Set by Google Analytics to distinguish users and track website usage patterns. These cookies include <code>_ga</code>, <code>_ga_*</code>, and expire after 2 years and 24 hours respectively.' ); ?></li>
				</ul>
				<p><?php mci_te( 'You can control or delete cookies through your browser settings. Disabling cookies may affect the functionality of some parts of the website.' ); ?></p>

				<h2><?php mci_te( 'Data Sharing' ); ?></h2>
				<p><?php mci_te( 'We do not sell, trade, or rent your personal information. We may share your data with:' ); ?></p>
				<ul>
					<li><strong>Google LLC:</strong> <?php mci_te( 'Through Google Analytics, for the purpose of website analytics (subject to Google\'s privacy policy).' ); ?></li>
					<li><strong><?php mci_te( 'Hosting provider:' ); ?></strong> <?php mci_te( 'Our website is hosted by SiteGround, which processes data on our behalf under appropriate data processing agreements.' ); ?></li>
					<li><strong><?php mci_te( 'Regulatory authorities:' ); ?></strong> <?php mci_te( 'When required by law, such as for compliance with healthcare regulations in Cyprus.' ); ?></li>
				</ul>

				<h2><?php mci_te( 'Data Retention' ); ?></h2>
				<p><?php mci_te( 'We retain your personal data only for as long as necessary to fulfil the purposes for which it was collected:' ); ?></p>
				<ul>
					<li><strong><?php mci_te( 'Contact form submissions:' ); ?></strong> <?php mci_te( 'Retained for up to 12 months, unless the enquiry leads to a patient relationship.' ); ?></li>
					<li><strong><?php mci_te( 'Patient records:' ); ?></strong> <?php mci_te( 'Retained in accordance with Cyprus healthcare record-keeping requirements (minimum 10 years after the last treatment).' ); ?></li>
					<li><strong><?php mci_te( 'Analytics data:' ); ?></strong> <?php mci_te( 'Google Analytics data is retained for 14 months, after which it is automatically deleted.' ); ?></li>
				</ul>

				<h2><?php mci_te( 'Your Rights' ); ?></h2>
				<p><?php mci_te( 'Under the GDPR, you have the following rights regarding your personal data:' ); ?></p>
				<ul>
					<li><strong><?php mci_te( 'Right of access:' ); ?></strong> <?php mci_te( 'You can request a copy of the personal data we hold about you.' ); ?></li>
					<li><strong><?php mci_te( 'Right to rectification:' ); ?></strong> <?php mci_te( 'You can ask us to correct inaccurate or incomplete data.' ); ?></li>
					<li><strong><?php mci_te( 'Right to erasure:' ); ?></strong> <?php mci_te( 'You can request deletion of your personal data, subject to legal retention requirements.' ); ?></li>
					<li><strong><?php mci_te( 'Right to restrict processing:' ); ?></strong> <?php mci_te( 'You can ask us to limit how we use your data.' ); ?></li>
					<li><strong><?php mci_te( 'Right to data portability:' ); ?></strong> <?php mci_te( 'You can request your data in a structured, machine-readable format.' ); ?></li>
					<li><strong><?php mci_te( 'Right to object:' ); ?></strong> <?php mci_te( 'You can object to processing based on legitimate interest, including analytics.' ); ?></li>
					<li><strong><?php mci_te( 'Right to withdraw consent:' ); ?></strong> <?php mci_te( 'Where processing is based on consent, you can withdraw it at any time.' ); ?></li>
				</ul>
				<p><?php echo mci_t( 'To exercise any of these rights, please contact us at <a href="mailto:info@dentalartcliniclimassol.com">info@dentalartcliniclimassol.com</a> or call <a href="tel:+35725377757">+357 25 377757</a>.' ); ?></p>
				<p><?php echo mci_t( 'You also have the right to lodge a complaint with the Office of the Commissioner for Personal Data Protection in Cyprus at <a href="https://www.dataprotection.gov.cy" target="_blank" rel="noopener noreferrer">www.dataprotection.gov.cy</a>.' ); ?></p>

				<h2><?php mci_te( 'Data Security' ); ?></h2>
				<p><?php mci_te( 'We implement appropriate technical and organisational measures to protect your personal data against unauthorised access, alteration, disclosure, or destruction. Our website uses SSL/TLS encryption to secure data transmitted between your browser and our server.' ); ?></p>

				<h2><?php mci_te( 'Third-Party Links' ); ?></h2>
				<p><?php mci_te( 'Our website may contain links to external websites, including Google Maps and social media platforms. We are not responsible for the privacy practices of these third-party websites and encourage you to read their privacy policies.' ); ?></p>

				<h2><?php mci_te( 'Changes to This Policy' ); ?></h2>
				<p><?php mci_te( 'We may update this Privacy Policy from time to time to reflect changes in our practices or legal requirements. Any changes will be posted on this page with an updated revision date. We encourage you to review this page periodically.' ); ?></p>

				<p><strong><?php mci_te( 'Last updated:' ); ?></strong> March 2026</p>

			</div>
		</div>
	</section>

	<!-- CTA Banner -->
	<section class="about-cta" style="background-image: url('<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-wide-angle-equipment.avif' ); ?>');">
		<div class="about-cta__overlay"></div>
		<div class="container about-cta__content">
			<h2 class="fade-in fade-in-delay-0"><?php echo mci_t( 'Have Questions About' ); ?> <span class="accent-font"><?php echo mci_t( 'Your Data?' ); ?></span></h2>
			<p class="fade-in fade-in-delay-1"><?php mci_te( 'We are happy to answer any questions about how we handle your personal information.' ); ?></p>
			<div class="about-cta__buttons fade-in fade-in-delay-2">
				<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-primary"><?php mci_te( 'Contact Us' ); ?></a>
				<a href="tel:+35725377757" class="btn btn-outline-light"><?php mci_te( 'Call +357 25 377757' ); ?></a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
