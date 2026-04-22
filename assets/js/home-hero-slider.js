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
	var KEN_BURNS_DURATION_MS = 8000;
	var KEN_BURNS_KEYFRAMES = [
		{ transform: 'scale(1)' },
		{ transform: 'scale(1.02)' },
		{ transform: 'scale(1)' },
	];
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
	 * Start the Ken Burns loop on the incoming slide's image. Clears any
	 * leftover inline transform first so the animation always begins from
	 * scale(1). Safe to call on a slide that's already animating (no-op).
	 */
	function startKenBurns(img) {
		if (!supportsWaapi(img) || img[KEN_BURNS_ANIM_KEY]) {
			return;
		}

		img.style.transform = '';

		var anim = img.animate(KEN_BURNS_KEYFRAMES, {
			duration: KEN_BURNS_DURATION_MS,
			iterations: Infinity,
			easing: 'ease-in-out',
		});

		img[KEN_BURNS_ANIM_KEY] = anim;
	}

	/**
	 * Freeze the outgoing slide's image at its current animated scale by
	 * committing the current computed style to inline, then cancelling the
	 * animation. The slide keeps this transform for the duration of the
	 * crossfade so it does not "pop" back to scale(1) mid-fade.
	 */
	function freezeKenBurns(img) {
		if (!img) {
			return;
		}
		var anim = img[KEN_BURNS_ANIM_KEY];
		if (!anim) {
			return;
		}
		try {
			anim.commitStyles();
		} catch (e) {
			/* commitStyles can throw if the element isn't rendered; ignore */
		}
		anim.cancel();
		img[KEN_BURNS_ANIM_KEY] = null;
	}

	/**
	 * Reset a slide's image transform back to the base (scale(1)). Called
	 * after the crossfade ends, when the slide is fully invisible, so the
	 * next time it becomes active it starts fresh.
	 */
	function resetKenBurns(img) {
		if (!img) {
			return;
		}
		img.style.transform = '';
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

		function onTransitionStart() {
			var swiper = this;
			if (swiper.previousIndex === swiper.activeIndex) {
				return;
			}
			freezeKenBurns(getSlideImg(swiper.slides[swiper.previousIndex]));
			startKenBurns(getSlideImg(swiper.slides[swiper.activeIndex]));
		}

		function onTransitionEnd() {
			var swiper = this;
			if (swiper.previousIndex === swiper.activeIndex) {
				return;
			}
			resetKenBurns(getSlideImg(swiper.slides[swiper.previousIndex]));
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
