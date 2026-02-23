/**
 * Main theme JS.
 */

document.addEventListener('DOMContentLoaded', function () {
	// lightGallery for cases and page (immediate).
	if (typeof lightGallery !== 'undefined' && typeof lgThumbnail !== 'undefined' && typeof lgZoom !== 'undefined') {
		['cases-gallery', 'page-gallery'].forEach(function (id) {
			var el = document.getElementById(id);
			if (el) {
				lightGallery(el, {
					plugins: [lgThumbnail, lgZoom],
					speed: 500,
					loop: true,
					selector: 'a',
				});
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
		{ root: null, rootMargin: '0px', threshold: 0.1 }
	);
	document.querySelectorAll('.fade-in').forEach(function (el) {
		observer.observe(el);
	});

	// Header scroll toggle
	var header = document.querySelector('.site-header');
	if (header) {
		var scrollThreshold = 25;
		var hasAdminBar = document.body.classList.contains('admin-bar');

		function getAdminBarOffset() {
			return window.innerWidth <= 782 ? 46 : 32;
		}

		function onScroll() {
			if (window.scrollY > scrollThreshold) {
				header.classList.add('is-scrolled');
			} else {
				header.classList.remove('is-scrolled');
			}

			if (hasAdminBar) {
				var offset = getAdminBarOffset();
				header.style.top = Math.max(0, offset - window.scrollY) + 'px';
			}
		}

		function onResize() {
			if (hasAdminBar) {
				var offset = getAdminBarOffset();
				header.style.top = Math.max(0, offset - window.scrollY) + 'px';
			}
		}

		window.addEventListener('scroll', onScroll, { passive: true });
		window.addEventListener('resize', onResize, { passive: true });
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

	// Homepage clinic slider
	var clinicViewport = document.querySelector('[data-clinic-slider-viewport]');
	if (clinicViewport) {
		var clinicTrack = clinicViewport.querySelector('[data-clinic-slider-track]');
		var clinicPrev = document.querySelector('[data-clinic-slider-prev]');
		var clinicNext = document.querySelector('[data-clinic-slider-next]');
		var clinicSlides = clinicTrack ? Array.prototype.slice.call(clinicTrack.children) : [];
		var clinicCurrentIndex = 0;
		var clinicSlidesPerView = 3;
		var clinicMaxIndex = 0;

		function getClinicSlidesPerView() {
			if (window.innerWidth <= 768) return 1;
			if (window.innerWidth <= 1024) return 2;
			return 3;
		}

		function getClinicGap() {
			if (!clinicTrack) return 0;
			var computedTrackStyle = window.getComputedStyle(clinicTrack);
			return parseFloat(computedTrackStyle.columnGap || computedTrackStyle.gap || '0') || 0;
		}

		function updateClinicNavigationState() {
			if (!clinicPrev || !clinicNext) return;
			clinicPrev.disabled = clinicCurrentIndex <= 0;
			clinicNext.disabled = clinicCurrentIndex >= clinicMaxIndex;
		}

		function updateClinicSliderPosition() {
			if (!clinicTrack || !clinicSlides.length) return;
			var firstSlide = clinicSlides[0];
			var slideWidth = firstSlide.getBoundingClientRect().width;
			var offset = clinicCurrentIndex * (slideWidth + getClinicGap());
			clinicTrack.style.transform = 'translate3d(' + -offset + 'px, 0, 0)';
			updateClinicNavigationState();
		}

		function recalculateClinicSliderLayout() {
			clinicSlidesPerView = getClinicSlidesPerView();
			clinicMaxIndex = Math.max(0, clinicSlides.length - clinicSlidesPerView);
			clinicCurrentIndex = Math.min(clinicCurrentIndex, clinicMaxIndex);
			if (clinicCurrentIndex % clinicSlidesPerView !== 0 && clinicCurrentIndex !== clinicMaxIndex) {
				clinicCurrentIndex = Math.floor(clinicCurrentIndex / clinicSlidesPerView) * clinicSlidesPerView;
			}
			updateClinicSliderPosition();
		}

		if (clinicPrev && clinicNext && clinicSlides.length > 0) {
			clinicPrev.addEventListener('click', function () {
				clinicCurrentIndex = Math.max(0, clinicCurrentIndex - clinicSlidesPerView);
				updateClinicSliderPosition();
			});

			clinicNext.addEventListener('click', function () {
				clinicCurrentIndex = Math.min(clinicMaxIndex, clinicCurrentIndex + clinicSlidesPerView);
				updateClinicSliderPosition();
			});
		}

		window.addEventListener('resize', recalculateClinicSliderLayout, { passive: true });
		recalculateClinicSliderLayout();
	}
});
