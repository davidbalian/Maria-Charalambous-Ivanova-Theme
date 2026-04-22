/**
 * Swiper carousels for full-bleed heroes (home + services): fade, autoplay.
 * Ken Burns is CSS (see home-v2-hero-slider.css, services-hero-slider.css).
 */
window.addEventListener('load', function () {
	if (typeof Swiper === 'undefined') {
		return;
	}

	var reduceMotion =
		typeof window.matchMedia === 'function' &&
		window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	document.querySelectorAll('.js-hero-swiper').forEach(function (root) {
		root.querySelectorAll('.swiper-slide img').forEach(function (img) {
			if (typeof img.decode === 'function') {
				img.decode().catch(function () {});
			}
		});

		var firstImg = root.querySelector('.swiper-slide img');
		if (firstImg && !reduceMotion) {
			firstImg.classList.add('is-initial-load');
			firstImg.addEventListener('animationend', function (e) {
				var n = e.animationName || '';
				if (n === 'home-hero-fade-in' || n === 'services-hero-fade-in') {
					firstImg.classList.remove('is-initial-load');
				}
			}, { once: true });
		}

		new Swiper(root, {
			effect: 'fade',
			fadeEffect: { crossFade: true },
			loop: true,
			slidesPerView: 1,
			speed: 1300,
			autoplay: reduceMotion
				? false
				: {
						delay: 3500,
						pauseOnMouseEnter: true,
						disableOnInteraction: false,
					},
		});
	});
});
