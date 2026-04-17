/**
 * Slick carousel for the homepage hero (fade, autoplay, Ken Burns on active slide only).
 */
jQuery(window).on('load', function () {
	var $slider = jQuery('.js-home-hero-slick');
	if (!$slider.length) {
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
		var $imgs = $slider.find('.home-hero__slide img');
		$imgs.removeClass(kbClass);
		var active = $slider.find('.slick-active .home-hero__slide img').get(0);
		if (!active) {
			return;
		}
		void active.offsetWidth;
		jQuery(active).addClass(kbClass);
	}

	if (!reduceMotion) {
		$slider.on('init afterChange', refreshKenBurns);
	}

	$slider.slick({
		variableWidth: false,
		infinite: true,
		waitForAnimate: false,
		fade: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		dots: false,
		speed: 800,
		cssEase: 'cubic-bezier(0.22, 1, 0.36, 1)',
		autoplay: !reduceMotion,
		autoplaySpeed: 5600,
		pauseOnHover: true,
		accessibility: true,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					fade: true,
					slidesToScroll: 1,
					autoplay: !reduceMotion,
				},
			},
		],
	});

	if (!reduceMotion) {
		refreshKenBurns();
	}
});
