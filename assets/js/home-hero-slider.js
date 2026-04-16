/**
 * Slick carousel for the homepage hero (full-bleed, autoplay, no arrows).
 */
jQuery(window).on('load', function () {
	var $slider = jQuery('.js-home-hero-slick');
	if (!$slider.length) {
		return;
	}

	var reduceMotion =
		typeof window.matchMedia === 'function' &&
		window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	$slider.slick({
		variableWidth: false,
		infinite: true,
		waitForAnimate: false,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		dots: false,
		speed: 600,
		cssEase: 'cubic-bezier(0.22, 1, 0.36, 1)',
		autoplay: !reduceMotion,
		autoplaySpeed: 5000,
		pauseOnHover: true,
		accessibility: true,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					variableWidth: false,
					slidesToScroll: 1,
					autoplay: !reduceMotion,
				},
			},
		],
	});
});
