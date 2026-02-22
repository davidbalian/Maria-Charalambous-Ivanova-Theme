/**
 * Main theme JS.
 */
document.addEventListener('DOMContentLoaded', function () {
	// GLightbox
	if (typeof GLightbox !== 'undefined') {
		GLightbox({
			selector: '.glightbox',
			touchNavigation: true,
			loop: true,
		});
	}

	// Justified Gallery for The Clinic section (row-based left-to-right layout)
	if (typeof jQuery !== 'undefined' && jQuery.fn.justifiedGallery) {
		var $clinicGrid = jQuery('.home-clinic__grid--masonry');
		if ($clinicGrid.length) {
			$clinicGrid.justifiedGallery({
				rowHeight: 320,
				margins: 12,
				lastRow: 'nojustify',
			});
		}
	}

	// Scroll-triggered fade-in animations
	var observer = new IntersectionObserver(
		function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('visible');
					observer.unobserve(entry.target);
				}
			});
		},
		{ root: null, rootMargin: '0px', threshold: 0.1 }
	);
	document.querySelectorAll('.fade-in').forEach(function (el) {
		observer.observe(el);
	});

	// Header scroll toggle
	var header = document.querySelector('.site-header');
	if (header) {
		var scrollThreshold = 25;
		var hasAdminBar = document.body.classList.contains('admin-bar');

		function getAdminBarOffset() {
			return window.innerWidth <= 782 ? 46 : 32;
		}

		function onScroll() {
			if (window.scrollY > scrollThreshold) {
				header.classList.add('is-scrolled');
			} else {
				header.classList.remove('is-scrolled');
			}

			if (hasAdminBar) {
				var offset = getAdminBarOffset();
				header.style.top = Math.max(0, offset - window.scrollY) + 'px';
			}
		}

		function onResize() {
			if (hasAdminBar) {
				var offset = getAdminBarOffset();
				header.style.top = Math.max(0, offset - window.scrollY) + 'px';
			}
		}

		window.addEventListener('scroll', onScroll, { passive: true });
		window.addEventListener('resize', onResize, { passive: true });
		onScroll();
	}

	// Mobile navigation
	var mobileNavToggle = document.querySelector('.mobile-nav-toggle');
	var mobileNav = document.getElementById('mobile-nav');
	var isToggling = false;

	function openMobileNav() {
		if (!mobileNav || !mobileNavToggle) return;
		mobileNav.classList.add('is-open');
		mobileNav.setAttribute('aria-hidden', 'false');
		mobileNavToggle.classList.add('is-active');
		mobileNavToggle.setAttribute('aria-expanded', 'true');
		mobileNavToggle.setAttribute('aria-label', 'Close menu');
		document.body.style.overflow = 'hidden';
	}

	function closeMobileNav() {
		if (!mobileNav || !mobileNavToggle) return;
		mobileNav.classList.remove('is-open');
		mobileNav.setAttribute('aria-hidden', 'true');
		mobileNavToggle.classList.remove('is-active');
		mobileNavToggle.setAttribute('aria-expanded', 'false');
		mobileNavToggle.setAttribute('aria-label', 'Open menu');
		document.body.style.overflow = '';
	}

	if (mobileNavToggle && mobileNav) {
		mobileNavToggle.addEventListener('click', function () {
			if (isToggling) return;
			
			isToggling = true;
			
			if (mobileNav.classList.contains('is-open')) {
				closeMobileNav();
			} else {
				openMobileNav();
			}
			
			setTimeout(function () {
				isToggling = false;
			}, 280);
		});
	}

	// Close on escape
	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape' && mobileNav && mobileNav.classList.contains('is-open')) {
			closeMobileNav();
		}
	});
});
