<?php

/* ==========================================================================
	Config
============================================================================= */

$fielding_page_protocol = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] ) ? 'https://' : 'http://';
$fielding_page_url      = $fielding_page_protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if ( strpos( $fielding_page_url, '?') > -1 ) {
	$fielding_page_url = substr( $fielding_page_url, 0, strpos( $fielding_page_url, '?') );
}

/* ==========================================================================
	Page Links
============================================================================= */

$fielding_home_url = get_home_url();

$fielding_page_links = array(
	'home'                => $fielding_home_url,
	'search'              => get_search_link(),
	'news_archives'       => get_permalink( get_option('page_for_posts' ) ),
	'news_media'          => $fielding_home_url . '/news-media/',
	'calendar'            => $fielding_home_url . '/calendar/',
	'calendar_archives'   => $fielding_home_url . '/events/',
	'directory'           => $fielding_home_url . '/directory/',
);

/* ==========================================================================
	Variables
============================================================================= */

$fielding_package = json_decode( file_get_contents( __DIR__ . '/../package.json' ), true );
$fielding_media_queries = array(
	// Min
	'min_xs'  => $fielding_package['vars']['mq_min_xs']  . 'px',
	'min_sm'  => $fielding_package['vars']['mq_min_sm']  . 'px',
	'min_md'  => $fielding_package['vars']['mq_min_md']  . 'px',
	'min_lg'  => $fielding_package['vars']['mq_min_lg']  . 'px',
	'min_xl'  => $fielding_package['vars']['mq_min_xl']  . 'px',
	// Max
	'max_xs'  => ($fielding_package['vars']['mq_min_xs'] - 1) . 'px',
	'max_sm'  => ($fielding_package['vars']['mq_min_sm'] - 1) . 'px',
	'max_md'  => ($fielding_package['vars']['mq_min_md'] - 1) . 'px',
	'max_lg'  => ($fielding_package['vars']['mq_min_lg'] - 1) . 'px',
	'max_xl'  => ($fielding_package['vars']['mq_min_xl'] - 1) . 'px',
);

/* ==========================================================================
	Theme Flags
============================================================================= */

/*
if ( ! isset( $fielding_header_feature ) ) {
	$fielding_header_feature = false;
}

if ( ! isset( $fielding_header_reverse ) ) {
	$fielding_header_reverse = false;
}

if ( ! isset( $fielding_lockdown ) ) {
	$fielding_lockdown = false;
}
*/