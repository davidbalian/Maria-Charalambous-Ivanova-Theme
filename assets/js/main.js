/**
 * Main theme JS.
 */

// Parallax background — desktop only, respects reduced-motion
(function () {
	if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
	if (window.matchMedia('(pointer: coarse)').matches) return;

	var parallaxEls = document.querySelectorAll(
		'.privacy-hero, .about-hero, .about-cta, ' +
		'.services-hero, .services-cta, ' +
		'.contact-hero, .contact-cta, ' +
		'.gallery-hero, .gallery-cta, ' +
		'.home-v2-consultation'
	);
	if (!parallaxEls.length) return;

	var ticking = false;
	var vh = window.innerHeight;

	function updateParallax() {
		for (var i = 0; i < parallaxEls.length; i++) {
			var el = parallaxEls[i];
			var rect = el.getBoundingClientRect();
			if (rect.bottom < 0 || rect.top > vh) continue;
			// Negative offset: as section scrolls up, bg shifts down (slower than scroll)
			var offset = -(rect.top * 0.25);
			el.style.backgroundPositionY = 'calc(50% + ' + offset + 'px)';
		}
		ticking = false;
	}

	window.addEventListener('scroll', function () {
		if (!ticking) {
			requestAnimationFrame(updateParallax);
			ticking = true;
		}
	}, { passive: true });

	window.addEventListener('resize', function () {
		vh = window.innerHeight;
	}, { passive: true });

	updateParallax();

	// Hero slider parallax — translate the slider-bleed container
	var heroSliderBleed = document.querySelector('.home-hero__slider-bleed');
	if (heroSliderBleed) {
		var heroHeight = heroSliderBleed.closest('.home-hero').offsetHeight;
		var heroTicking = false;

		function updateHeroParallax() {
			var scrollY = window.scrollY;
			if (scrollY > heroHeight) {
				heroTicking = false;
				return;
			}
			heroSliderBleed.style.transform = 'translateY(' + (scrollY * 0.25) + 'px)';
			heroTicking = false;
		}

		window.addEventListener('scroll', function () {
			if (!heroTicking) {
				requestAnimationFrame(updateHeroParallax);
				heroTicking = true;
			}
		}, { passive: true });

		window.addEventListener('resize', function () {
			heroHeight = heroSliderBleed.closest('.home-hero').offsetHeight;
		}, { passive: true });
	}
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
