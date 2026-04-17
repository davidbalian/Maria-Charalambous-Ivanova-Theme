/**
 * Swiper carousel for the homepage hero (fade, autoplay, Ken Burns on active slide only).
 */
window.addEventListener('load', function () {
	var root = document.querySelector('.js-home-hero-swiper');
	if (!root || typeof Swiper === 'undefined') {
		return;
	}

	var reduceMotion =
		typeof window.matchMedia === 'function' &&
		window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	var kbClass = 'home-hero__kb--run';

	function refreshKenBurns() {
		if (reduceMotion) {
			return;
		}
		root.querySelectorAll('.home-hero__slide img').forEach(function (img) {
			img.classList.remove(kbClass);
		});
		var active = root.querySelector('.swiper-slide-active .home-hero__slide img');
		if (!active) {
			return;
		}
		void active.offsetWidth;
		active.classList.add(kbClass);
	}

	var swiper = new Swiper(root, {
		effect: 'fade',
		fadeEffect: { crossFade: true },
		loop: true,
		slidesPerView: 1,
		speed: 800,
		autoplay: reduceMotion
			? false
			: {
					delay: 3500,
					pauseOnMouseEnter: true,
					disableOnInteraction: false,
				},
		on: {
			init: function () {
				refreshKenBurns();
			},
			slideChangeTransitionEnd: function () {
				refreshKenBurns();
			},
		},
	});

	if (!reduceMotion) {
		refreshKenBurns();
	}
});
