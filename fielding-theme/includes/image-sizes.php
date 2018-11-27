<?php

// Images Size Settings

$fielding_image_sizes = array();

// Wide (16x9)
$fielding_image_sizes[ 'wide-xxsml' ] = array( 'width' => 300,  'height' => 169 );
$fielding_image_sizes[ 'wide-xsml'  ] = array( 'width' => 500,  'height' => 282 );
$fielding_image_sizes[ 'wide-sml'   ] = array( 'width' => 740,  'height' => 416 );
$fielding_image_sizes[ 'wide-med'   ] = array( 'width' => 980,  'height' => 552 );
$fielding_image_sizes[ 'wide-lrg'   ] = array( 'width' => 1220, 'height' => 686 );
$fielding_image_sizes[ 'wide-xlrg'  ] = array( 'width' => 1440, 'height' => 810 );

// Full (3x2)
$fielding_image_sizes[ 'full-xxsml' ] = array( 'width' => 300,  'height' => 200 );
$fielding_image_sizes[ 'full-xsml'  ] = array( 'width' => 500,  'height' => 375 );
$fielding_image_sizes[ 'full-sml'   ] = array( 'width' => 740,  'height' => 555 );
$fielding_image_sizes[ 'full-med'   ] = array( 'width' => 980,  'height' => 735 );
$fielding_image_sizes[ 'full-lrg'   ] = array( 'width' => 1220, 'height' => 915 );
$fielding_image_sizes[ 'full-xlrg'  ] = array( 'width' => 1440, 'height' => 1080 );

// Square
$fielding_image_sizes[ 'square-thumb' ] = array( 'width' => 100, 'height' => 100 );
$fielding_image_sizes[ 'square-xxsml' ] = array( 'width' => 300, 'height' => 300 );
$fielding_image_sizes[ 'square-xsml'  ] = array( 'width' => 500, 'height' => 500 );
$fielding_image_sizes[ 'square-sml'   ] = array( 'width' => 740, 'height' => 740 );
$fielding_image_sizes[ 'square-med'   ] = array( 'width' => 980, 'height' => 980 );

// Tall

$fielding_image_sizes[ 'tall-sml' ] = array( 'width' => 310, 'height' => 585 );


// Image Requests w/ Placeholder Fallback

function fielding_image( $image, $name, $echo = false ) {
	global $fielding_image_sizes;

	if (is_array($image) && isset($image['sizes']) && isset($image['sizes'][ $name ])) {
		$img = array( $image['sizes'][ $name ] );
	} else {
		$img = wp_get_attachment_image_src( $image, $name );
	}

	$url = $img ? $img[0] : fielding_placeholder_image( $fielding_image_sizes[ $name ]['width'], $fielding_image_sizes[ $name ]['height'] );

	if ($echo) {
		echo $url;
	} else {
		return $url;
	}
}

function fielding_empty_placeholder() {
	$theme_dir = get_template_directory_uri();

	return $theme_dir . "/images/placeholder.png";
}

// Responsive Backgrounds

function fielding_background_header( $image ) {
	return array(
		'source' => array(
			'0px'    => fielding_image( $image, 'full-xsml' ),
			'500px'  => fielding_image( $image, 'full-sml' ),
			'740px'  => fielding_image( $image, 'full-med' ),
			'980px'  => fielding_image( $image, 'full-lrg' ),
			'1220px' => fielding_image( $image, 'wide-xlrg' ),
		),
	);
}

function fielding_background_home_model( $image ) {
	return array(
		'source' => array(
			'0px'    => fielding_image( $image, 'square-xsml' ),
			'500px'  => fielding_image( $image, 'full-sml' ),
			'740px'  => fielding_image( $image, 'full-med' ),
			'980px'  => fielding_image( $image, 'full-lrg' ),
			'1220px' => fielding_image( $image, 'wide-xlrg' ),
		),
	);
}

function fielding_background_home_events( $image ) {
	return array(
		'source' => array(
			'0px'    => fielding_image( $image, 'square-xsml' ),
			'500px'  => fielding_image( $image, 'full-sml' ),
			'740px'  => fielding_image( $image, 'full-med' ),
			'980px'  => fielding_image( $image, 'full-lrg' ),
			'1220px' => fielding_image( $image, 'wide-xlrg' ),
		),
	);
}

function fielding_background_testimonial( $image ) {
	return array(
		'source' => array(
			'0px'    => fielding_image( $image, 'full-xsml' ),
			'500px'  => fielding_image( $image, 'full-sml' ),
			'1220px' => fielding_image( $image, 'square-sml' ),
		),
	);
}

function fielding_background_spotlight_large( $image ) {
	return array(
		'source' => array(
			'0px'    => fielding_empty_placeholder(),
			'980px'  => fielding_image( $image, 'wide-lrg' ),
			'1220px' => fielding_image( $image, 'wide-xlrg' ),
		),
	);
}

function fielding_background_spotlight_small( $image ) {
	return array(
		'source' => array(
			'0px'    => fielding_image( $image, 'wide-xsml' ),
			'500px'  => fielding_image( $image, 'wide-sml' ),
			'740px'  => fielding_image( $image, 'wide-med' ),
			'980px'  => fielding_empty_placeholder(),
		),
	);
}

// Responsive Images

function fielding_image_gallery( $image ) {
	return array(
		'fallback'            => fielding_image( $image, 'wide-xsml' ),
		'(min-width: 500px)'  => fielding_image( $image, 'wide-sml' ),
		'(min-width: 740px)'  => fielding_image( $image, 'wide-med' ),
		'(min-width: 980px)'  => fielding_image( $image, 'wide-lrg' ),
		'(min-width: 1220px)' => fielding_image( $image, 'wide-xlrg' ),
	);
}

function fielding_image_topic_block( $image ) {
	return array(
		'fallback'            => fielding_image( $image, 'full-xsml' ),
		'(min-width: 740px)'  => fielding_image( $image, 'full-xxsml' ),
	);
}

function fielding_image_callout_pair( $image ) {
	return array(
		'fallback'            => fielding_image( $image, 'wide-xsml' ),
		'(min-width: 1220px)' => fielding_image( $image, 'wide-sml' ),
	);
}

function fielding_image_sidebar_flexible( $image ) {
	return array(
		'fallback'            => fielding_image( $image, 'wide-xsml' ),
		'(min-width: 740px)'  => fielding_image( $image, 'wide-sml' ),
		'(min-width: 980px)'  => fielding_image( $image, 'wide-xxsml' ),
		'(min-width: 1220px)' => fielding_image( $image, 'wide-xsml' ),
	);
}

function fielding_image_home_feature_small($image) {
	return array(
		'fallback'            => fielding_image( $image, 'square-xsml' ),
		'(min-width: 500px)'  => fielding_image( $image, 'wide-sml' ),
	);
}

function fielding_image_home_feature_large($image) {
	return array(
		'fallback'            => fielding_empty_placeholder(),
		'(min-width: 740px)'  => fielding_image( $image, 'square-xsml' ),
		'(min-width: 980px)'  => fielding_image( $image, 'square-sml' ),
	);
}

function fielding_image_home_feature_video($image) {
	return array(
		'fallback'            => fielding_image( $image, 'wide-xsml' ),
		'(min-width: 500px)'  => fielding_image( $image, 'wide-sml' ),
		'(min-width: 740px)'  => fielding_image( $image, 'wide-xsml' ),
		'(min-width: 980px)'  => fielding_image( $image, 'wide-sml' ),
	);
}

function fielding_image_home_model($image) {
	return array(
		'fallback'            => fielding_image( $image, 'square-thumb' ),
		'(min-width: 740px)'  => fielding_image( $image, 'square-xxsml' ),
	);
}

function fielding_image_home_explore($image) {
	return array(
		'fallback'            => fielding_image( $image, 'full-xsml' ),
		'(min-width: 500px)'  => fielding_image( $image, 'wide-sml' ),
		'(min-width: 740px)'  => fielding_image( $image, 'wide-med' ),
		'(min-width: 980px)'  => fielding_image( $image, 'wide-sml' ),
		'(min-width: 1220px)' => fielding_image( $image, 'wide-med' ),
	);
}

function fielding_image_testimonial($image) {
	return array(
		'fallback'            => fielding_image( $image, 'wide-xsml' ),
		'(min-width: 500px)'  => fielding_image( $image, 'tall-sml' ),
	);
}

function fielding_image_full_flexible( $image ) {
	return array(
		'fallback'            => fielding_image( $image, 'wide-xsml' ),
		'(min-width: 500px)'  => fielding_image( $image, 'square-xxsml' ),
		'(min-width: 980px)'  => fielding_image( $image, 'full-xsml' ),
	);
}

function fielding_image_news_list( $image ) {
	return array(
		'fallback'            => fielding_image( $image, 'full-xxsml' ),
		'(min-width: 980px)'  => fielding_image( $image, 'square-xxsml' ),
	);
}

function fielding_image_news_featured( $image ) {
	return array(
		'fallback'            => fielding_empty_placeholder(),
		'(min-width: 500px)'  => fielding_image( $image, 'full-xxsml' ),
		'(min-width: 740px)'  => fielding_image( $image, 'full-xsml' ),
		'(min-width: 1220px)' => fielding_image( $image, 'full-sml' ),
	);
}