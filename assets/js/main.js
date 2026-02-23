/**
 * Main theme JS.
 */

/** Justified layout: target row height and gap (px). */
var CLINIC_ROW_HEIGHT = 220;
var CLINIC_GAP = 2;

/**
 * Compute justified layout boxes for items with given aspect ratios.
 * @param {number} containerWidth - Container width in px.
 * @param {number[]} aspectRatios - Aspect ratio (width/height) per item.
 * @param {number} targetRowHeight - Target row height in px.
 * @param {number} gap - Gap between items in px.
 * @returns {{ boxes: Array<{left: number, top: number, width: number, height: number}>, containerHeight: number }}
 */
function computeJustifiedLayout(containerWidth, aspectRatios, targetRowHeight, gap) {
	var boxes = [];
	var containerHeight = 0;
	var rowStart = 0;
	var rowTop = 0;

	while (rowStart < aspectRatios.length) {
		var rowRatios = [];
		var rowSum = 0;
		var i = rowStart;
		while (i < aspectRatios.length) {
			var r = aspectRatios[i];
			var wouldBeWidth = (rowSum + r) * targetRowHeight + (rowRatios.length) * gap;
			if (rowRatios.length > 0 && wouldBeWidth > containerWidth) break;
			rowRatios.push(r);
			rowSum += r;
			i++;
		}
		var n = rowRatios.length;
		var rowHeight = (containerWidth - (n - 1) * gap) / rowSum;
		var left = 0;
		for (var j = 0; j < rowRatios.length; j++) {
			var w = rowRatios[j] * rowHeight;
			boxes.push({ left: left, top: rowTop, width: Math.round(w), height: Math.round(rowHeight) });
			left += Math.round(w) + gap;
		}
		rowTop += Math.round(rowHeight) + gap;
		containerHeight = rowTop - gap;
		rowStart += rowRatios.length;
	}

	return { boxes: boxes, containerHeight: containerHeight };
}

/**
 * Apply justified layout to #clinic-gallery and then init lightGallery on it.
 */
function initClinicJustifiedGallery() {
	var container = document.getElementById('clinic-gallery');
	if (!container) return;

	var links = [].slice.call(container.querySelectorAll('a.home-clinic__item'));
	if (links.length === 0) return;

	var imgs = links.map(function (a) { return a.querySelector('img'); }).filter(Boolean);
	if (imgs.length !== links.length) return;

	function runLayout() {
		var containerWidth = container.getBoundingClientRect().width;
		var aspectRatios = imgs.map(function (img) {
			var w = img.naturalWidth || 1;
			var h = img.naturalHeight || 1;
			return w / h;
		});
		var result = computeJustifiedLayout(containerWidth, aspectRatios, CLINIC_ROW_HEIGHT, CLINIC_GAP);
		container.classList.add('home-clinic__grid--justified');
		container.style.height = result.containerHeight + 'px';
		result.boxes.forEach(function (box, index) {
			if (links[index]) {
				links[index].style.position = 'absolute';
				links[index].style.left = box.left + 'px';
				links[index].style.top = box.top + 'px';
				links[index].style.width = box.width + 'px';
				links[index].style.height = box.height + 'px';
			}
		});
		if (typeof lightGallery !== 'undefined' && typeof lgThumbnail !== 'undefined' && typeof lgZoom !== 'undefined') {
			lightGallery(container, {
				plugins: [lgThumbnail, lgZoom],
				speed: 500,
				loop: true,
				selector: 'a',
			});
		}
	}

	var loaded = 0;
	function maybeRun() {
		loaded++;
		if (loaded === imgs.length) runLayout();
	}
	imgs.forEach(function (img) {
		if (img.complete && img.naturalWidth) maybeRun();
		else img.addEventListener('load', maybeRun);
	});
}

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

	// Clinic gallery: justified layout then lightGallery.
	initClinicJustifiedGallery();

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
});
