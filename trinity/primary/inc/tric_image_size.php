<?php
if ( ! function_exists( 'tric_add_image_size' ) ) :
	function tric_add_image_size() {
		add_action( 'after_setup_theme', 'tric_setup' );
		// ---- Global ----
		add_image_size('tric_735x980', 735, 980, true);
		add_image_size('tric_980x1220', 980, 1220, true);
		add_image_size('tric_980x552', 980, 552, true);
		add_image_size('tric_500x282', 500, 282, true);
		add_image_size('tric_1220x686', 1220, 686, true);
		add_image_size('tric_980x654', 980, 654, true);
		add_image_size('tric_1220x523', 1220, 523, true);
		add_image_size('tric_740x740', 740, 740, true);

		// ---- Homepage ----
		add_image_size('tric_740x416', 740, 416, true);
		add_image_size('tric_980x980', 980, 980, true);

		// ---- Header Images ----
		add_image_size('tric_1440x617', 1440, 617, true);
		add_image_size('tric_740x555', 740, 555, true);

		// ---- News Listing ----
		add_image_size('tric_500x375', 500, 375, true);

		// ---- Components ----
		add_image_size('tric_500x334', 500, 334, true);
		add_image_size('tric_555x740', 555, 740, true);
		add_image_size('tric_980x420', 980, 420, true);
	}
endif;
add_action( 'after_setup_theme', 'tric_add_image_size' );

function tric_image($field, $size,  $echo = true, $type = 'acf') {
	if ($type == 'acf') {
		$image = is_array($field) ? $field['sizes']['tric_'.$size] : $field;
		if ($echo) {
			echo $image;
		} else {
			return $image;
		}
	}
}