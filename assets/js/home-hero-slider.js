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
	/*
	 * Ken Burns is a single-shot zoom per slide: scale 1 → 1.02 over the
	 * autoplay window so the zoom finishes right as the crossfade begins.
	 * fill: 'forwards' holds the image at the final scale during the fade
	 * out. The outgoing slide is intentionally NOT touched during the fade;
	 * it's only reset once the slide is fully invisible, so the next time
	 * it appears it starts from scale(1) again.
	 */
	var KEN_BURNS_DURATION_MS = AUTOPLAY_DELAY_MS;
	var KEN_BURNS_KEYFRAMES = [
		{ transform: 'scale(1)' },
		{ transform: 'scale(1.02)' },
	];
	var KEN_BURNS_EASING = 'ease-out';
	var KEN_BURNS_ANIM_KEY = '_mciKenBurnsAnim';

	function prefersReducedMotion() {
		return (
			typeof window.matchMedia === 'function' &&
			window.matchMedia('(prefers-reduced-motion: reduce)').matches
		);
	}

	function supportsWaapi(img) {
		return !!img && typeof img.animate === 'function';
	}

	/**
	 * Cancel any running Ken Burns animation on this image and clear any
	 * inline transform it committed. Leaves the element at its base
	 * (unzoomed) state. Idempotent.
	 */
	function clearKenBurns(img) {
		if (!img) {
			return;
		}
		var anim = img[KEN_BURNS_ANIM_KEY];
		if (anim) {
			anim.cancel();
			img[KEN_BURNS_ANIM_KEY] = null;
		}
		img.style.transform = '';
	}

	/**
	 * Start a fresh single-shot Ken Burns zoom on the incoming slide's
	 * image. Always clears any pre-existing animation/inline transform
	 * first so the slide always starts at scale(1), even if it still had a
	 * stale animation held at the final scale.
	 */
	function startKenBurns(img) {
		if (!supportsWaapi(img)) {
			return;
		}

		clearKenBurns(img);

		var anim = img.animate(KEN_BURNS_KEYFRAMES, {
			duration: KEN_BURNS_DURATION_MS,
			easing: KEN_BURNS_EASING,
			fill: 'forwards',
		});

		img[KEN_BURNS_ANIM_KEY] = anim;
	}

	function getSlideImg(slideEl) {
		return slideEl ? slideEl.querySelector('img') : null;
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

	function createKenBurnsHandlers(reduceMotion) {
		if (reduceMotion) {
			return {};
		}

		/*
		 * Crossfade begins: start a fresh zoom on the incoming slide. The
		 * outgoing slide is intentionally untouched — its animation is
		 * already at (or holding at) scale(1.02) via fill: 'forwards', and
		 * the user wants that zoom to remain during the fade.
		 */
		function onTransitionStart() {
			var swiper = this;
			if (swiper.previousIndex === swiper.activeIndex) {
				return;
			}
			startKenBurns(getSlideImg(swiper.slides[swiper.activeIndex]));
		}

		/*
		 * Crossfade ends and the outgoing slide is now fully invisible.
		 * Reset it so the next time it becomes active it starts from
		 * scale(1) again.
		 */
		function onTransitionEnd() {
			var swiper = this;
			if (swiper.previousIndex === swiper.activeIndex) {
				return;
			}
			clearKenBurns(getSlideImg(swiper.slides[swiper.previousIndex]));
		}

		function onAfterInit() {
			startKenBurns(getSlideImg(this.slides[this.activeIndex]));
		}

		return {
			afterInit: onAfterInit,
			slideChangeTransitionStart: onTransitionStart,
			slideChangeTransitionEnd: onTransitionEnd,
		};
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
			on: createKenBurnsHandlers(reduceMotion),
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
