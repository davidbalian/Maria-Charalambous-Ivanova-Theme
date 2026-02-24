/**
 * Slick carousel for the clinic gallery section.
 *
 * Uses window.load so every image is measured before Slick
 * calculates variable-width slide dimensions.
 */
jQuery(window).on('load', function () {
	var $slider = jQuery('.js-clinic-slick');
	if (!$slider.length) {
		return;
	}

	$slider.slick({
		variableWidth: true,
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		prevArrow: jQuery('.js-clinic-prev'),
		nextArrow: jQuery('.js-clinic-next'),
		dots: false,
		speed: 600,
		cssEase: 'cubic-bezier(0.22, 1, 0.36, 1)',
		accessibility: true,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 2,
				},
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2,
				},
			},
		],
	});
});
