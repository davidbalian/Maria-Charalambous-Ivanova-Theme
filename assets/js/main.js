/**
 * Main theme JS.
 */

document.addEventListener('DOMContentLoaded', function () {
	// Smooth scroll for anchor links
	var scrollDown = document.querySelector('.home-hero__scroll-down');
	if (scrollDown) {
		scrollDown.addEventListener('click', function (e) {
			e.preventDefault();
			var target = document.querySelector(scrollDown.getAttribute('href'));
			if (target) {
				target.scrollIntoView({ behavior: 'smooth' });
			}
		});
	}

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

	// Language Switcher
	document.querySelectorAll('.lang-switcher__toggle').forEach(function (toggle) {
		var dropdown = toggle.nextElementSibling;

		toggle.addEventListener('click', function (e) {
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

		dropdown.querySelectorAll('.lang-switcher__option').forEach(function (option) {
			option.addEventListener('click', function (e) {
				e.preventDefault();
				var lang = option.getAttribute('data-lang');
				var label = option.textContent.trim();

				// Update all switcher instances (desktop + mobile)
				document.querySelectorAll('.lang-switcher__current').forEach(function (el) {
					el.textContent = label;
				});
				document.querySelectorAll('.lang-switcher__option').forEach(function (o) {
					o.classList.toggle('is-active', o.getAttribute('data-lang') === lang);
				});

				// Close dropdown
				dropdown.classList.remove('is-open');
				toggle.setAttribute('aria-expanded', 'false');
			});
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

			// Schedule:
			// Mon-Thu: 8:00 (480) - 17:30 (1050)
			// Fri: 8:00 (480) - 13:00 (780)
			// Sat-Sun: Closed

			if (['Monday', 'Tuesday', 'Wednesday', 'Thursday'].includes(weekday)) {
				if (currentMinutes >= 480 && currentMinutes < 1050) {
					isOpen = true;
				}
			} else if (weekday === 'Friday') {
				if (currentMinutes >= 480 && currentMinutes < 780) {
					isOpen = true;
				}
			}

			clinicStatusEls.forEach(function(el) {
				if (isOpen) {
					el.textContent = 'OPEN NOW';
					el.className = 'js-clinic-status clinic-status--open';
				} else {
					el.textContent = 'CLOSED NOW';
					el.className = 'js-clinic-status clinic-status--closed';
				}
			});
		}

		updateClinicStatus();
		// Update every minute
		setInterval(updateClinicStatus, 60000);
	}
});
