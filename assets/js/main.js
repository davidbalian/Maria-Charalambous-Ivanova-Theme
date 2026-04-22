/**
 * Main theme JS.
 */

/*
 * Parallax — GPU-composited via CSS variables driving translate3d().
 *
 * Section parallax writes --mci-parallax-y; .mci-parallax::before consumes it
 * as a translate3d on a promoted layer (see style.css), so there are no paints
 * during scroll.
 *
 * A single scroll handler drives both section parallax and the hero slider
 * bleed to avoid scheduling two rAF callbacks per scroll tick. Disabled when
 * prefers-reduced-motion is on, and the whole handler short-circuits on
 * mobile — neither section nor hero parallax run there, matching the CSS
 * that treats the mobile hero as a static image with fade-ins only.
 */
(function () {
	if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

	var SECTION_FACTOR = 0.25;
	var HERO_FACTOR = 0.25;
	var MOBILE_MAX_WIDTH = 768;

	var sectionEls = document.querySelectorAll('.mci-parallax');
	var heroBleedEl = document.querySelector('.home-hero__slider-bleed');
	var heroSectionEl = heroBleedEl ? heroBleedEl.closest('.home-hero') : null;

	if (!sectionEls.length && !heroBleedEl) return;

	var viewportHeight = window.innerHeight;
	var heroHeight = heroSectionEl ? heroSectionEl.offsetHeight : 0;
	var isMobile = window.innerWidth <= MOBILE_MAX_WIDTH;
	var ticking = false;

	// On mobile the CSS disables the ::before transform; clear any stale values
	// so the compositor doesn't hold on to a value that's no longer honored.
	function clearSectionVars() {
		for (var i = 0; i < sectionEls.length; i++) {
			sectionEls[i].style.removeProperty('--mci-parallax-y');
		}
	}

	// Mobile disables hero parallax entirely; drop any inline transform so the
	// slider bleed sits flush with the viewport instead of holding a stale offset.
	function clearHeroTransform() {
		if (heroBleedEl) {
			heroBleedEl.style.transform = '';
		}
	}

	function updateSections() {
		for (var i = 0; i < sectionEls.length; i++) {
			var el = sectionEls[i];
			var rect = el.getBoundingClientRect();
			if (rect.bottom < 0 || rect.top > viewportHeight) continue;
			// Negative offset: as the section scrolls up the bg drifts down
			// (slower than scroll) for a parallax feel.
			var offset = -(rect.top * SECTION_FACTOR);
			el.style.setProperty('--mci-parallax-y', offset + 'px');
		}
	}

	function updateHero() {
		if (!heroBleedEl) return;
		var scrollY = window.scrollY;
		if (scrollY > heroHeight) return;
		// translate3d forces GPU layer promotion on Safari so the bleed
		// composites without repainting the Swiper + gradient overlay.
		heroBleedEl.style.transform =
			'translate3d(0, ' + (scrollY * HERO_FACTOR) + 'px, 0)';
	}

	function onFrame() {
		if (isMobile) {
			ticking = false;
			return;
		}
		updateSections();
		updateHero();
		ticking = false;
	}

	function onScroll() {
		if (ticking) return;
		requestAnimationFrame(onFrame);
		ticking = true;
	}

	function onResize() {
		viewportHeight = window.innerHeight;
		var wasMobile = isMobile;
		isMobile = window.innerWidth <= MOBILE_MAX_WIDTH;
		if (heroSectionEl) heroHeight = heroSectionEl.offsetHeight;
		if (!wasMobile && isMobile) {
			clearSectionVars();
			clearHeroTransform();
		}
	}

	if (isMobile) {
		clearSectionVars();
		clearHeroTransform();
	}

	window.addEventListener('scroll', onScroll, { passive: true });
	window.addEventListener('resize', onResize, { passive: true });

	onFrame();
})();

document.addEventListener('DOMContentLoaded', function () {
	// Smooth scroll: hero chevron + in-page CTAs (same target as #comprehensive-dental-care)
	document.querySelectorAll('.js-home-hero-scroll-next').forEach(function (link) {
		link.addEventListener('click', function (e) {
			e.preventDefault();
			var href = link.getAttribute('href');
			if (!href || href.indexOf('#') !== 0) {
				return;
			}
			var target = document.querySelector(href);
			if (target) {
				target.scrollIntoView({ behavior: 'smooth' });
			}
		});
	});

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
		{ root: null, rootMargin: '0px', threshold: 0.25 }
	);
	document.querySelectorAll('.fade-in').forEach(function (el) {
		if (el.closest('[data-fade-stagger]')) return;
		observer.observe(el);
	});

	// Staggered cascade for children inside [data-fade-stagger] (e.g. benefits cards)
	document.querySelectorAll('[data-fade-stagger]').forEach(function (container) {
		var staggerObserver = new IntersectionObserver(
			function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						var children = container.querySelectorAll('.fade-in');
						children.forEach(function (child) {
							var delayClass = Array.from(child.classList).find(function (c) {
								return c.indexOf('fade-in-delay-') === 0;
							});
							var delayMs = 100;
							if (delayClass) {
								var n = parseInt(delayClass.replace('fade-in-delay-', ''), 10);
								delayMs = n * 100;
							}
							setTimeout(function () {
								child.classList.add('visible');
							}, delayMs);
						});
						staggerObserver.unobserve(container);
					}
				});
			},
			{ root: null, rootMargin: '0px', threshold: 0.25 }
		);
		staggerObserver.observe(container);
	});

	// Header scroll toggle — top bar scrolls away naturally, nav is sticky
	var header = document.querySelector('.site-header');
	if (header) {
		var scrollThreshold = 5;

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

	// Language Switcher — dropdown toggle only; links navigate naturally via href
	document.querySelectorAll('.lang-switcher__toggle').forEach(function (toggle) {
		var dropdown = toggle.nextElementSibling;

		toggle.addEventListener('click', function (e) {
			e.preventDefault();
			e.stopPropagation();
			var isOpen = dropdown.classList.contains('is-open');

			// Close all dropdowns first
			document.querySelectorAll('.lang-switcher__dropdown').forEach(function (d) {
				d.classList.remove('is-open');
			});
			document.querySelectorAll('.lang-switcher__toggle').forEach(function (t) {
				t.setAttribute('aria-expanded', 'false');
			});

			if (!isOpen) {
				dropdown.classList.add('is-open');
				toggle.setAttribute('aria-expanded', 'true');
			}
		});
	});

	// Close lang dropdown on outside click
	document.addEventListener('click', function () {
		document.querySelectorAll('.lang-switcher__dropdown').forEach(function (d) {
			d.classList.remove('is-open');
		});
		document.querySelectorAll('.lang-switcher__toggle').forEach(function (t) {
			t.setAttribute('aria-expanded', 'false');
		});
	});

	// Prevent mobile overlay clicks from closing lang dropdown
	var mobileNavOverlay = document.getElementById('mobile-nav');
	if (mobileNavOverlay) {
		mobileNavOverlay.addEventListener('click', function (e) {
			if (e.target.closest('.mobile-nav__lang')) {
				e.stopPropagation();
			}
		});
	}

	// Cookie Banner
	var cookieBanner = document.getElementById('mci-cookie-banner');
	if (cookieBanner && !localStorage.getItem('mci_cookies_accepted')) {
		cookieBanner.removeAttribute('hidden');
		// Trigger reflow then animate in
		cookieBanner.offsetHeight;
		cookieBanner.classList.add('is-visible');

		function dismissBanner() {
			cookieBanner.classList.remove('is-visible');
			cookieBanner.addEventListener('transitionend', function () {
				cookieBanner.setAttribute('hidden', '');
			}, { once: true });
			localStorage.setItem('mci_cookies_accepted', '1');
		}

		cookieBanner.querySelector('.cookie-banner__accept').addEventListener('click', dismissBanner);
		cookieBanner.querySelector('.cookie-banner__close').addEventListener('click', dismissBanner);
		var rejectBtn = cookieBanner.querySelector('.cookie-banner__reject');
		if (rejectBtn) rejectBtn.addEventListener('click', dismissBanner);
	}

	// AJAX Contact Form Submission
	document.querySelectorAll('form[action*="admin-post.php"]').forEach(function (form) {
		var actionInput = form.querySelector('input[name="action"]');
		if (!actionInput || actionInput.value !== 'mci_contact_form') return;

		form.addEventListener('submit', function (e) {
			e.preventDefault();

			var btn = form.querySelector('button[type="submit"]');
			if (!btn || btn.disabled) return;

			var originalText = btn.textContent;
			btn.disabled = true;
			btn.classList.add('is-loading');
			btn.innerHTML = '<span class="btn-spinner"></span>';

			var formData = new FormData(form);
			// Override nonce with fresh AJAX nonce and point to admin-ajax.php
			formData.set('mci_contact_nonce', mciAjax.nonce);

			fetch(mciAjax.url, {
				method: 'POST',
				body: formData,
			})
				.then(function (res) { return res.json(); })
				.then(function (data) {
					btn.classList.remove('is-loading');
					if (data.success) {
						btn.classList.add('is-success');
						btn.textContent = (typeof mciAjax !== 'undefined' && mciAjax.strings) ? mciAjax.strings.sent : 'Sent!';
						form.reset();
					} else {
						btn.classList.add('is-error');
						btn.textContent = (typeof mciAjax !== 'undefined' && mciAjax.strings) ? mciAjax.strings.failed : 'Failed!';
					}
					setTimeout(function () {
						btn.classList.remove('is-success', 'is-error');
						btn.textContent = originalText;
						btn.disabled = false;
					}, 5000);
				})
				.catch(function () {
					btn.classList.remove('is-loading');
					btn.classList.add('is-error');
					btn.textContent = (typeof mciAjax !== 'undefined' && mciAjax.strings) ? mciAjax.strings.failed : 'Failed!';
					setTimeout(function () {
						btn.classList.remove('is-error');
						btn.textContent = originalText;
						btn.disabled = false;
					}, 5000);
				});
		});
	});

	// Clinic Open/Closed Logic (Cyprus Timezone)
	var clinicStatusEls = document.querySelectorAll('.js-clinic-status');
	if (clinicStatusEls.length) {
		function updateClinicStatus() {
			var now = new Date();

			// Get Cyprus time components
			var cyprusTime = new Intl.DateTimeFormat('en-US', {
				timeZone: 'Europe/Nicosia',
				hour: 'numeric',
				minute: 'numeric',
				hour12: false,
				weekday: 'long'
			});

			var parts = cyprusTime.formatToParts(now);
			var hour = 0;
			var minute = 0;
			var weekday = '';

			parts.forEach(function(part) {
				if (part.type === 'hour') hour = parseInt(part.value, 10);
				if (part.type === 'minute') minute = parseInt(part.value, 10);
				if (part.type === 'weekday') weekday = part.value;
			});

			var isOpen = false;
			var currentMinutes = hour * 60 + minute;

			// Schedule (Cyprus): closes 17:30 (1050) Mon–Thu, 13:00 (780) Fri.
			// Mon & Wed open 8:00 (480); Tue & Thu & Fri open 8:30 (510).

			var openStart = null;
			var closeMinutes = null;
			if (weekday === 'Monday' || weekday === 'Wednesday') {
				openStart = 480;
				closeMinutes = 1050;
			} else if (weekday === 'Tuesday' || weekday === 'Thursday') {
				openStart = 510;
				closeMinutes = 1050;
			} else if (weekday === 'Friday') {
				openStart = 510;
				closeMinutes = 780;
			}
			if (openStart !== null && currentMinutes >= openStart && currentMinutes < closeMinutes) {
				isOpen = true;
			}

			clinicStatusEls.forEach(function(el) {
				if (isOpen) {
					el.textContent = (typeof mciAjax !== 'undefined' && mciAjax.strings) ? mciAjax.strings.open_now : 'OPEN NOW';
					el.className = 'js-clinic-status clinic-status--open';
				} else {
					el.textContent = (typeof mciAjax !== 'undefined' && mciAjax.strings) ? mciAjax.strings.closed_now : 'CLOSED NOW';
					el.className = 'js-clinic-status clinic-status--closed';
				}
			});
		}

		updateClinicStatus();
		// Update every minute
		setInterval(updateClinicStatus, 60000);
	}
});
