/**
 * Swiper carousel for the homepage hero (fade, autoplay). Ken Burns is pure CSS (infinite pulse).
 */
window.addEventListener('load', function () {
	var root = document.querySelector('.js-home-hero-swiper');
	if (!root || typeof Swiper === 'undefined') {
		return;
	}

	var reduceMotion =
		typeof window.matchMedia === 'function' &&
		window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	root.querySelectorAll('.home-hero__slide img').forEach(function (img) {
		if (typeof img.decode === 'function') {
			img.decode().catch(function () {});
		}
	});

	var firstImg = root.querySelector('.home-hero__slide img');
	if (firstImg && !reduceMotion) {
		firstImg.classList.add('is-initial-load');
		firstImg.addEventListener('animationend', function (e) {
			if (e.animationName === 'home-hero-fade-in') {
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
