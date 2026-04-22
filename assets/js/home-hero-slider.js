/**
 * Homepage hero slider (Swiper fade + Ken Burns).
 *
 * Orchestration goals:
 *   - single opacity system (root-level CSS fade) to avoid first-paint flash
 *   - Swiper is initialized while the root is visually hidden
 *   - reveal only after the first image is ready (decoded / loaded), with timeout fallback
 */
(function () {
	var HERO_ROOT_SELECTOR = '.js-hero-swiper';
	var FIRST_IMAGE_SELECTOR = '.swiper-slide img';
	var READY_CLASS = 'is-ready';
	var DECODE_TIMEOUT_MS = 1500;
	var SLIDER_SPEED_MS = 1500;
	var AUTOPLAY_DELAY_MS = 5000;

	function prefersReducedMotion() {
		return (
			typeof window.matchMedia === 'function' &&
			window.matchMedia('(prefers-reduced-motion: reduce)').matches
		);
	}

	function whenImageReady(img, timeoutMs) {
		return new Promise(function (resolve) {
			var settled = false;
			function done() {
				if (settled) {
					return;
				}
				settled = true;
				resolve();
			}

			setTimeout(done, timeoutMs);

			if (!img) {
				done();
				return;
			}

			if (img.complete && img.naturalWidth > 0) {
				if (typeof img.decode === 'function') {
					img.decode().then(done, done);
				} else {
					done();
				}
				return;
			}

			img.addEventListener('load', done, { once: true });
			img.addEventListener('error', done, { once: true });
		});
	}

	function warmDecodeAll(root) {
		root.querySelectorAll(FIRST_IMAGE_SELECTOR).forEach(function (img) {
			if (typeof img.decode === 'function') {
				img.decode().catch(function () {});
			}
		});
	}

	function createSwiperConfig(reduceMotion) {
		return {
			effect: 'fade',
			fadeEffect: { crossFade: true },
			loop: true,
			slidesPerView: 1,
			speed: SLIDER_SPEED_MS,
			autoplay: reduceMotion
				? false
				: {
						delay: AUTOPLAY_DELAY_MS,
						pauseOnMouseEnter: true,
						disableOnInteraction: false,
					},
		};
	}

	function revealRoot(root) {
		requestAnimationFrame(function () {
			requestAnimationFrame(function () {
				root.classList.add(READY_CLASS);
			});
		});
	}

	function initHeroRoot(root) {
		if (typeof Swiper === 'undefined') {
			revealRoot(root);
			return;
		}

		var reduceMotion = prefersReducedMotion();
		var firstImg = root.querySelector(FIRST_IMAGE_SELECTOR);

		warmDecodeAll(root);

		whenImageReady(firstImg, DECODE_TIMEOUT_MS).then(function () {
			new Swiper(root, createSwiperConfig(reduceMotion));
			revealRoot(root);
		});
	}

	function initAllHeroes() {
		document.querySelectorAll(HERO_ROOT_SELECTOR).forEach(initHeroRoot);
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initAllHeroes);
	} else {
		initAllHeroes();
	}
})();
