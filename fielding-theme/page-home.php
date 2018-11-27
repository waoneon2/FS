<?php
/**
 * Template Name: Home Page
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		get_template_part( 'layouts/home', 'feature' );

		get_template_part( 'layouts/home', 'intro' );

		get_template_part( 'layouts/home', 'model' );

		get_template_part( 'layouts/home', 'finder' );

		get_template_part( 'layouts/home', 'events' );

		get_template_part( 'layouts/home', 'explore' );

	endwhile;
endif;

get_footer();
