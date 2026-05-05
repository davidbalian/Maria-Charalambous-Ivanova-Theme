<!-- Doctor Profile Section -->
<section class="home-v2-doctor">
	<div class="container">
		<div class="home-v2-doctor__inner">
			<div class="home-v2-doctor__image fade-in fade-in-delay-0">
				<img src="<?php echo esc_url( trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/02/dr-maria-charalambous-ivanova-portrait-12.webp' ); ?>" alt="Dr. Maria Charalambous-Ivanova" width="400" height="500" loading="lazy">
			</div>
			<div class="home-v2-doctor__content">
				<h2 class="fade-in fade-in-delay-1"><?php mci_te( 'Dr. Maria Charalambous-Ivanova' ); ?></h2>
				<p class="home-v2-doctor__subtitle fade-in fade-in-delay-2"><?php echo mci_t( 'DMD, MSD | Founder &amp; Clinical Director' ); ?></p>
				<p class="home-v2-doctor__text fade-in fade-in-delay-3"><?php mci_te( 'Graduate of the University of Sofia, with active clinical practice since 2008.' ); ?></p>
				<p class="home-v2-doctor__text fade-in fade-in-delay-4"><?php mci_te( 'She specialises in aesthetic dentistry and complex restorations, with emphasis on naturalness and functionality.' ); ?></p>
				<div class="home-v2-doctor__quote fade-in fade-in-delay-5">
					<p><?php mci_te( 'Our philosophy is simple:' ); ?></p>
					<p><?php mci_te( 'A beautiful smile should look natural, function correctly, and make you feel at ease.' ); ?></p>
				</div>
				<div class="fade-in fade-in-delay-6">
					<a href="<?php echo esc_url( mci_url( '/about/' ) ); ?>" class="btn btn-outline"><?php mci_te( 'More About Dr. Charalambous-Ivanova' ); ?></a>
				</div>
			</div>
		</div>
	</div>
</section>
