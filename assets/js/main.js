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

	// Header scroll toggle
	var header = document.querySelector('.site-header');
	if (header) {
		var scrollThreshold = 50;

		function onScroll() {
			if (window.scrollY > scrollThreshold) {
				header.classList.add('is-scrolled');
			} else {
				header.classList.remove('is-scrolled');
			}
		}

		window.addEventListener('scroll', onScroll, { passive: true });
		onScroll();
	}
});
