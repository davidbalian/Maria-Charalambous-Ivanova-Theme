/**
 * Swiper carousel for the clinic gallery section (variable-width slides).
 */
window.addEventListener('load', function () {
	var el = document.querySelector('.js-clinic-swiper');
	if (!el || typeof Swiper === 'undefined') {
		return;
	}

	var reduceMotion =
		typeof window.matchMedia === 'function' &&
		window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	new Swiper(el, {
		slidesPerView: 'auto',
		spaceBetween: 16,
		loop: true,
		speed: reduceMotion ? 0 : 600,
		navigation: {
			prevEl: '.js-clinic-prev',
			nextEl: '.js-clinic-next',
		},
	});
});
