<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Trinity_College
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function tric_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	if ( is_front_page() ) {
		$classes[] = 'page_layout_home';
	}

	// Page & Singular Class
	if ((is_page() || is_singular()) && !is_front_page()) {
		$classes[] = 'page_layout_default';
		if (get_field('header_image')) {
			$classes[] = 'page_theme_image';
		} else {
			$classes[] = 'page_theme_default';
		}
	}

	// Page & Singular Class Secondary Site
	if ((is_page() || is_singular()) && (get_current_blog_id() > 1)) {
		$classes[] = 'page_layout_default';
		if (get_field('header_image')) {
			$classes[] = 'page_theme_image';
		} else {
			$classes[] = 'page_theme_default';
		}
	}

	// 404
	if (is_404()) {
		global $blog_id;
		$classes[] = 'page_layout_default';
		if($blog_id > 1){
			switch_to_blog(1);
			$args = [
			    'post_type' => 'page',
			    'meta_key' => '_wp_page_template',
			    'meta_value' => '404.php'
			];
			$pages 	= get_posts( $args );
			$post 	= $pages[0];
			restore_current_blog();
		} else {
			$args = [
			    'post_type' => 'page',
			    'meta_key' => '_wp_page_template',
			    'meta_value' => '404.php'
			];
			$pages 	= get_posts( $args );
			$post 	= $pages[0];
		}


		if ($post):
			setup_postdata( $post );
			if($blog_id > 1){
				switch_to_blog(1);
				$header_image = get_post_meta($post->ID, 'header_image', true);
				if ($header_image) {
					$classes[] = 'page_theme_image';
					$classes[] = 'page_layout_cover';
				} else {
					$classes[] = 'page_theme_default';
				}
				restore_current_blog();
			} else {
				$header_image = get_post_meta($post->ID, 'header_image', true);
				if ($header_image) {
					$classes[] = 'page_theme_image';
					$classes[] = 'page_layout_cover';
				} else {
					$classes[] = 'page_theme_default';
				}
			}

		endif;

		wp_reset_postdata();
	}
	if (is_search()) {
		$classes[] = 'page_layout_default';
		$classes[] = 'page_theme_default';
		$classes[] = 'page_theme_sky';
	}

	if (is_archive()) {
		$classes[] = 'page_layout_default';
		$classes[] = 'page_theme_sky';
		$classes[] = 'page_theme_default';
	}

	$classes[] = 'fs-grid';
	$classes[] = 'js';

	return $classes;
}
add_filter( 'body_class', 'tric_body_classes' );

/**
 * Get nav object
 *
 * @param string nav id.
 * @return object.
 */
function tric_navigation($nav_id) {
	$id = get_nav_menu_locations()[$nav_id];
	$objects = wp_get_nav_menu_items($id);

	return $objects;
}

/**
 * Social media permitted
 *
 * @param string social media slug
 * @return boolean.
 */
function tric_social_filter($soc_slug) {
	$permitted = ['facebook', 'twitter', 'youtube', 'linkedin', 'instagram', 'flickr'];
	$return = in_array($soc_slug, $permitted);

	return $return;
}

/**
 * Print Icon
 *
 * @param icon id
 */
function tric_icon($icon_id, $echoed = TRUE) {
	if ($echoed) {
		echo get_template_directory_uri()."/images/icons.svg#".$icon_id;
	} else {
		return get_template_directory_uri()."/images/icons.svg#".$icon_id;
	}

}

/**
 * Get Template from acf fc
 *
 * @param acf fc
 * important_now, news_events
 */
function tric_get_template_part($acf_fc_layout, $type, $acf_fc) {
	global $post;

	switch ($acf_fc_layout) {

		// Full Width Component
		case 'important_now':
			include get_template_directory() . '/inc/'.$type.'/template-now.php';
			break;

		case 'news_events':
			include get_template_directory() . '/inc/'.$type.'/template-mix.php';
			break;

		case 'related_news':
			include get_template_directory() . '/inc/'.$type.'/template-related-news.php';
			break;

		case 'related_events':
			include get_template_directory() . '/inc/'.$type.'/template-related-events.php';
			break;

		case 'media_gallery':
			include get_template_directory() . '/inc/'.$type.'/template-gallery.php';
			break;

		case 'contact_information':
			include get_template_directory() . '/inc/'.$type.'/template-contact-card.php';
			break;

		case 'story':
			include get_template_directory() . '/inc/'.$type.'/template-story.php';
			break;

		// In Content Component
		case 'wysiwyg':
			include get_template_directory() . '/inc/'.$type.'/template-wysiwyg.php';
			break;

		case 'topic_rows':
			include get_template_directory() . '/inc/'.$type.'/template-topic-row.php';
			break;

		case 'link_list':
			include get_template_directory() . '/inc/'.$type.'/template-linked-list.php';
			break;

		case 'facts_and_stats':
			include get_template_directory() . '/inc/'.$type.'/template-stat.php';
			break;

		case 'testimonial':
			include get_template_directory() . '/inc/'.$type.'/template-quote.php';
			break;

		default:
			# code...
			break;
	}
}

/**
 * Print Full-Width Components
 *
 * @param acf full-width_components
 */
function tric_the_full_width_components($acf_fwc) {

	if ($acf_fwc) {
		foreach ($acf_fwc as $acf_fc) {
			tric_get_template_part($acf_fc['acf_fc_layout'], 'full-width-components', $acf_fc);
		}
	}

}

/**
 * Print In-Content Components
 *
 * @param acf in-content_components
 */
function tric_the_in_content_components($acf_fwc) {

	if ($acf_fwc) {
		foreach ($acf_fwc as $acf_fc) {
			tric_get_template_part($acf_fc['acf_fc_layout'], 'in-content-components', $acf_fc);
		}
	}

}