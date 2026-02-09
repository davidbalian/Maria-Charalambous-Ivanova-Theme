/**
 * Main theme JS — GLightbox initialization.
 */
document.addEventListener('DOMContentLoaded', function () {
	if (typeof GLightbox !== 'undefined') {
		GLightbox({
			selector: '.glightbox',
			touchNavigation: true,
			loop: true,
		});
	}
});
