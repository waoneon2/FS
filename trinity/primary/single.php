<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Trinity_College
 */

get_header();

	while ( have_posts() ) :
		the_post();
		get_template_part( 'inc/template-parts/content', get_post_type() );

	endwhile; // End of the loop.

get_footer();
