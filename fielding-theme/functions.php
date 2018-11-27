<?php

date_default_timezone_set( 'America/Los_Angeles' ); // Just in case...

define( 'FIELDING_VERSION', '1.0.0' );
define( 'FIELDING_DEBUG', true );

define( 'FIELDING_DATE_FORMAT', 'F j, Y' );
define( 'FIELDING_DATE_FORMAT_SHORT', 'M j, Y' );
define( 'FIELDING_TIME_FORMAT', 'g:i a' );
define( 'FIELDING_DATETIME_FORMAT', FIELDING_DATE_FORMAT . ' ' . FIELDING_TIME_FORMAT );
define( 'FIELDING_MICRO_FORMAT', 'c' );

define( 'FIELDING_TITLE', 'Fielding Graduate University' );


/* ==========================================================================
	Init
============================================================================= */

include_once 'includes/utils.php';
include_once 'includes/config.php';
include_once 'includes/cron.php';
include_once 'includes/image-sizes.php';
include_once 'includes/post-types.php';
include_once 'includes/breadcrumb-walker.php';
include_once 'includes/navigation-walker.php';
include_once 'includes/utility-nav-walker.php';


$fielding_is_dev = ( false !== strpos( $fielding_page_url, '.dev') );

if ( $fielding_is_dev ) {
	// error_reporting(E_ALL);
	// ini_set('display_errors', 1);
}

function fielding_init_base() {
	global $fielding_is_dev;
	global $fielding_image_sizes;

	$dir = get_template_directory();

	if ( ! $fielding_is_dev ) {
		fielding_include_all( $dir . '/fields' );
	}

	// Menus
	register_nav_menu( 'main_nav', __( 'Main Navigation - Sidebar & Breadcrumb' ) );
	register_nav_menu( 'top_nav', __( 'Top Level Navigation - Header & Mobile' ) );
	register_nav_menu( 'utility_nav', __( 'Utility Navigation - Header & Mobile' ) );
	register_nav_menu( 'social_nav', __( 'Social Navigation - Footer' ) );
	register_nav_menu( 'consistent_nav', __( 'Consistent Navigation - Footer & Mobile' ) );

	// Remove tags from posts
	register_taxonomy( 'post_tag', array() );

	// Event Organizer
	add_theme_support('event-organiser');

	// Images
	// add_theme_support( 'post-thumbnails' );

	foreach ($fielding_image_sizes as $name => $size) {
		add_image_size( $name, $size["width"],  $size["height"], true );
	}
}

add_action( 'init', 'fielding_init_base', 0 );

/* ==========================================================================
	RSS Support
============================================================================= */

add_theme_support( 'automatic-feed-links' );

/* ==========================================================================
	Scripts / Styles
============================================================================= */

function fielding_remove_wpadminbar_margin() {
	remove_action( 'wp_head', '_admin_bar_bump_cb' );
}

add_action( 'get_header', 'fielding_remove_wpadminbar_margin' );

function fielding_enqueue_resources() {
	global $wp_styles, $wp_scripts;

	$theme_dir = get_template_directory_uri();

	// Styles
	wp_enqueue_style( 'fielding-fonts', '//fast.fonts.net/cssapi/596182cd-25b8-4d66-80e0-b5e49568befb.css', FIELDING_VERSION, 'all' );

	// Scripts - Head
	wp_enqueue_script( 'fielding-modernizr', $theme_dir . '/js/modernizr.js', array(), FIELDING_VERSION, false );

	// Scripts - Foot
	wp_enqueue_script( 'fielding-site', $theme_dir . '/js/site.js', array( 'jquery' ), FIELDING_VERSION, false );

	// IE8
	wp_enqueue_style( 'fielding-site-ie8', $theme_dir . '/css/site-ie8.css', FIELDING_VERSION, 'all' );
	wp_enqueue_script( 'fielding-site-ie8', $theme_dir . '/js/site-ie8.js', array(), FIELDING_VERSION );

	$wp_styles->add_data( 'fielding-site-ie8', 'conditional', 'IE 8' );
	$wp_scripts->add_data( 'fielding-site-ie8', 'conditional', 'IE 8' );

	// IE9
	wp_enqueue_style( 'fielding-site-ie9', $theme_dir . '/css/site-ie9.css', FIELDING_VERSION, 'all' );
	wp_enqueue_script( 'fielding-site-ie9', $theme_dir . '/js/site-ie9.js', array(), FIELDING_VERSION );

	$wp_styles->add_data( 'fielding-site-ie9', 'conditional', 'IE 9' );
	$wp_scripts->add_data( 'fielding-site-ie9', 'conditional', 'IE 9' );

	// IE
	wp_enqueue_style( 'fielding-site-ie', $theme_dir . '/css/site-ie.css', FIELDING_VERSION, 'all' );

	$wp_styles->add_data( 'fielding-site-ie', 'conditional', 'lte IE 9' );
}

add_action( 'wp_enqueue_scripts', 'fielding_enqueue_resources' );

/* ==========================================================================
	Front End Head
============================================================================= */

function fielding_head_top() {
	$theme_dir = get_template_directory_uri();

	?>
	<!--[if gt IE 8]><!--><link rel='stylesheet' id='fielding-site-css' href='<?php echo $theme_dir; ?>/css/site.css' type='text/css' media='all'><!--<![endif]-->
	<script type="text/javascript">
		var ajaxurl     = '<?php echo admin_url( 'admin-ajax.php' ); ?>',
			templateurl = '<?php echo get_bloginfo( 'template_url' ); ?>';
	</script>
	<?php
}

add_action( 'wp_head', 'fielding_head_top', 7 ); // run before scripts are printed

/* ==========================================================================
	Admin Head
============================================================================= */

function fielding_enqueue_admin_resources($hook) {
	// Styles
	wp_enqueue_style( 'fielding-admin', get_template_directory_uri() . '/css/admin.css', FIELDING_VERSION, 'all' );

	// Scripts - Head
	wp_enqueue_script( 'fielding-admin', get_template_directory_uri() . '/js/admin.js', array( 'jquery' ), FIELDING_VERSION, false );
}

add_action( 'admin_enqueue_scripts', 'fielding_enqueue_admin_resources' );

/* ==========================================================================
	Content Gallery
============================================================================= */

function fielding_post_gallery($output, $attr) {
	global $post;

	$gallery_id = 'gallery_' . uniqid();

	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( ! $attr['orderby'] ) {
			unset( $attr['orderby'] );
		}
	}

	extract( shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
	), $attr ) );

	$id = intval( $id );

	if ( 'RAND' == $order ) {
		$orderby = 'none';
	}

	if ( ! empty( $include ) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts(	array(
			'include'        => $include,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => $order,
			'orderby'        => $orderby,
		) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[ $val->ID ] = $_attachments[ $key ];
		}
	}

	if ( empty( $attachments ) ) {
		return '';
	}

	$count = count( $attachments );
	$image = array_shift( $attachments );
	$meta  = fielding_lightbox_meta( array(
		"id" => $image->ID,
		"title" => $image->post_title,
		"caption" => $image->post_excerpt
	) );

	$output  = '</div>';

	$output .= '<div class="gallery_large margined_md">';
	$output .= '<a class="js-lightbox gallery_large_link" href="' . $image->guid . '" title="' . $image->post_excerpt . '" data-lightbox-gallery="' . $gallery_id . '" data-lightbox-meta="' . fielding_json_attribute( $meta, false ) . '">';
	$output .= '<figure class="gallery_large_figure">';
	$output .= fielding_responsive_image( fielding_image_gallery_large( $image->ID ), 'gallery_large_image', '', false );
	$output .= '<figcaption class="gallery_large_caption">' . $image->post_excerpt . '</figcaption>';
	$output .= '</figure>';
	$output .= '<div class="gallery_large_meta image_count">';
	$output .= '<span class="icon icon_expand"></span>';
	$output .= '<span class="image_count_data">';
	$output .= '<span class="image_count_text">View Photos</span>';
	$output .= '<span class="image_count_number">' . $count . ' Photos</span>';
	$output .= '</span>';
	$output .= '</div>';
	$output .= '</a>';
	$output .= '<div class="visually_hidden">';

	foreach ( $attachments as $id => $image ) {
		$meta = fielding_lightbox_meta( array(
			"id" => $image->ID,
			"title" => $image->post_title,
			"caption" => $image->post_excerpt
		) );
		$output .= '<a href="' . $image->guid . '" title="' . $image->post_excerpt . '" data-lightbox-gallery="' . $gallery_id . '" data-lightbox-meta="' . fielding_json_attribute( $meta, false ) . '">' . $image->post_excerpt . '</a>';
	}

	$output .= '</div>';
	$output .= '</div>';

	$output .= '<div class="typography padded_content margined_md_bottom">';

	return $output;
}

add_filter( 'post_gallery', 'fielding_post_gallery', 10, 2 );

/* ==========================================================================
	Get attatchment meta
============================================================================= */

function fielding_get_attachment_meta( $attachment_id ) {
	$attachment = get_post( $attachment_id );

	return array(
		'alt'         => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption'     => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href'        => get_permalink( $attachment->ID ),
		'src'         => $attachment->guid,
		'title'       => $attachment->post_title,
	);
}


/* ==========================================================================
        Lock down Access by IP address
============================================================================= */

add_action('init', 'fielding_admin_ip');

function fielding_admin_ip() {
        $allowed_ips = array('108.17.87.154', '192.190.37.253', '104.175.79.253', '73.229.80.68', '74.106.232.6', '127.0.0.1', '36.66.211.39');

        if (preg_match('/wp-admin/', $_SERVER['REQUEST_URI'])) {
                if (!in_array($_SERVER['REMOTE_ADDR'], $allowed_ips)) {
                        print "Admin access from this IP (" . $_SERVER['REMOTE_ADDR']  . ") is forbidden. <br /><br />";
                        print "<a href='" . get_home_url() . "'>Click Here</a> to be redricted to our home page.";
                        exit;
                }
        }
}


/* ==========================================================================
	Populate Margin Class
============================================================================= */

/*
function lima_acf_populate_margin_class( $field ) {
	$field['choices'] = array(
		'md'   => 'Medium',
		'lg'   => 'Large',
		'none' => 'None',
	);

	return $field;
}

add_filter( 'acf/load_field/name=margin_class', 'lima_acf_populate_margin_class' );
*/

/* ==========================================================================
	Populate Formidable Forms
============================================================================= */

/*
function lima_get_forms() {
	ob_start();
	FrmFormsHelper::forms_dropdown( 'frm_add_form_id' );
	$forms = ob_get_contents();
	ob_end_clean();

	preg_match_all('/<option\svalue="([^"]*)" >([^>]*)<\/option>/', $forms, $matches);

	$result = array_combine($matches[1], $matches[2]);

	return $result;
}

function lima_acf_populate_forms( $field ){
	$result = lima_get_forms();

	if( is_array($result) ){
		$field['choices'] = array();

		foreach( $result as $key => $val ){
			$field['choices'][ $key ] = $val;
		}
	}

    return $field;
}

add_filter('acf/load_field/name=form_id', 'lima_acf_populate_forms');
*/

/* ==========================================================================
	Populate Color Options
============================================================================= */

function fielding_acf_populate_color_option( $field ) {
	$field['choices'] = array(
		'teal'   => 'Teal',
		'gray'   => 'Gray',
		'purple' => 'Purple',
		'red'    => 'Red',
		'orange' => 'Orange',
	);

	return $field;
}

add_filter( 'acf/load_field/name=color_option', 'fielding_acf_populate_color_option' );


/* ==========================================================================
	Populate Facts Color Options
============================================================================= */

function fielding_acf_populate_facts_color_option( $field ) {
	$field['choices'] = array(
		'purple' => 'Purple',
		'orange' => 'Orange',
		'red'    => 'Red',
		'teal'   => 'Teal',
	);

	return $field;
}

add_filter( 'acf/load_field/name=facts_color_option', 'fielding_acf_populate_facts_color_option' );


/* ==========================================================================
	Populate Contact Icons
============================================================================= */

/*
function lima_acf_populate_contact_icon( $field ) {
	$field['choices'] = array(
		'phone' => 'Phone',
		'email' => 'Email',
	);

	return $field;
}

add_filter( 'acf/load_field/name=contact_icon', 'lima_acf_populate_contact_icon' );
*/

/* ==========================================================================
	Acf Option
============================================================================= */
/**
 *	Acf Option
 */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

/* ==========================================================================
	Populate Social Icons
============================================================================= */

function fielding_acf_populate_social_icon( $field ) {
	$field['choices'] = array(
		'facebook'   => 'Facebook',
		'twitter'    => 'Twitter',
		'youtube'    => 'YouTube',
		'googleplus' => 'Google+',
		'pinterest'  => 'Pinterest',
		'flickr'     => 'Flickr',
		'linkedin'   => 'LinkedIn',
		'blog'       => 'Blogs',
	);

	return $field;
}

add_filter( 'acf/load_field/name=social_icon', 'fielding_acf_populate_social_icon' );

/* ==========================================================================
	Get Nav Item's Ancestors
============================================================================= */

function fielding_get_nav_ancestors( $nav, $id ) {
	$ancestors = array();

	foreach ( $nav as $key => $item ) {
		if ( $item->ID == $id ) {
			// Add current item
			$ancestors[] = $item->menu_item_parent;
			// Recursively add parents
			$ancestors = array_merge( $ancestors, fielding_get_nav_ancestors( $nav, $item->menu_item_parent ) );
		}
	}

	return $ancestors;
}

/* ==========================================================================
	Filter Nav Items
============================================================================= */

function fielding_filter_nav_menu( $sorted_menu_items, $args ) {
	global $fielding_page_host, $fielding_page_path;

	$current_theme = wp_get_theme();
	$front_page    = get_option( 'page_on_front' );
	$posts_page    = get_option( 'page_for_posts' );
	$locations     = get_nav_menu_locations();
	$menu_id       = $locations[ $args->theme_location ];

	if ( 'main_nav' == $args->theme_location ) {
		// Subnav
		$current_count  = 0;
		$current_id     = 0;
		$parent_id      = 0;
		$grandparent_id = 0;
		$has_children   = false;
		$current_object_id = 0;

		// Count current instances
		foreach ( $sorted_menu_items as $key => $item ) {
			if ( $item->current ) {
				$current_count++;
				$current_object_id = $item->object_id;
				$current_id   = $item->ID;
				$parent_id    = $item->menu_item_parent;
				$has_children = in_array( 'menu-item-has-children', $item->classes );
			}
		}

		$ancestor_ids     = get_post_ancestors( $current_object_id );
		$parent_object_id = isset( $ancestor_ids[0] ) ? $ancestor_ids[0] : 0;

		// Set current
		if ( $current_count > 1 ) {
			// Get tree parent
			foreach ( $sorted_menu_items as $key => $item ) {
				if ( $item->object_id == $parent_object_id ) {
					$parent_id = $item->ID;
				}
			}

			// Get tree current
			foreach ( $sorted_menu_items as $key => $item ) {
				if ( $item->current && $item->menu_item_parent == $parent_id ) {
					$current_id   = $item->ID;
					$has_children = in_array( 'menu-item-has-children', $item->classes );
					break;
				}
			}
		} else {
			// single
		}

		// Set parent
		foreach ( $sorted_menu_items as $key => $item ) {
			if ( $item->ID == $parent_id ) {
				$grandparent_id = $item->menu_item_parent;
				break;
			}
		}

		// Catch single posts
		if ( is_single() || is_category() ) {
			foreach ( $sorted_menu_items as $key => $item ) {
				if ( $item->object_id === $posts_page) {
					$current_count++;
					$current_object_id = $item->object_id;
					$current_id   = $item->ID;
					$parent_id    = $item->menu_item_parent;
					$has_children = in_array( 'menu-item-has-children', $item->classes );
				}
			}
		}

		// Catch outliers
		if ( 0 == $current_id ) {
			foreach ( $sorted_menu_items as $key => $item ) {
				if ( $item->menu_item_parent == 0 ) {
					$parent_id = $item->ID;
					break;
				}
			}
		}

		if ( isset( $args->display ) ) {
			if ( 'subnavigation' == $args->display ) {

				// Filter sidebar
				foreach ( $sorted_menu_items as $key => $item ) {
					if ( $item->menu_item_parent == 0 ) {
						unset( $sorted_menu_items[ $key ] );
					} else {
						if ( $item->current && $item->ID == $current_id ) {
							// show
						} else {
							if ( $has_children && $item->menu_item_parent == $current_id ) {
								// show current pages children
							// } else if ( ( $has_children && $item->ID == $parent_id) || ( ! $has_children && $item->ID == $grandparent_id) ) {
								// show
							} else if ( $item->menu_item_parent == $parent_id || ( ! $has_children && $item->menu_item_parent == $grandparent_id ) ) {
								// show
							} else {
								// remove
								unset( $sorted_menu_items[ $key ] );
							}
						}

					}
				}
			} else if ( 'breadcrumb' == $args->display ) {
				// Filter breadcrumb
				$nav_ancestor_ids = fielding_get_nav_ancestors( $sorted_menu_items, $current_id );
				foreach ( $sorted_menu_items as $key => $item ) {
					// Should be tree current, or a tree ancestor
					if ( ( $item->current && $item->ID == $current_id)  || ( $item->current_item_ancestor && in_array( $item->ID , $nav_ancestor_ids ) ) ) {
						// show
					} else {
						// remove
						unset( $sorted_menu_items[ $key ] );
					}
				}

				// Add items

				// Check for top level
				$has_front = false;
				$front_id  = 0;

				foreach ( $sorted_menu_items as $item ) {
					if ( $item->object == 'page' && $item->object_id == $front_page ) {
						$has_front = true;
					}
				}

				// News / Calendar hacks...
				global $fielding_news_active;
				global $fielding_news_page;
				global $fielding_calendar_active;
				global $fielding_calendar_page;

				if ( $fielding_calendar_active ) {
					$sorted_menu_items = array();

					if ( $fielding_calendar_page ) {
						array_unshift( $sorted_menu_items , (object) array(
							'title'            => $fielding_calendar_page,
							'menu_item_parent' => '',
							'ID'               => '',
							'db_id'            => '',
							'url'              => '#',
						) );
					}

					array_unshift( $sorted_menu_items , (object) array(
						'title'            => 'Event Archives',
						'menu_item_parent' => '',
						'ID'               => '',
						'db_id'            => '',
						'url'              => fielding_page_link( 'calendar_archives', false ),
					) );

					array_unshift( $sorted_menu_items , (object) array(
						'title'            => 'Calendar',
						'menu_item_parent' => '',
						'ID'               => '',
						'db_id'            => '',
						'url'              => fielding_page_link( 'calendar', false ),
					) );

				} else if ( $fielding_news_active ) {
					$sorted_menu_items = array();

					if ( $fielding_news_page ) {
						array_unshift( $sorted_menu_items , (object) array(
							'title'            => $fielding_news_page,
							'menu_item_parent' => '',
							'ID'               => '',
							'db_id'            => '',
							'url'              => '#',
						) );
					}

					array_unshift( $sorted_menu_items , (object) array(
						'title'            => 'News Archives',
						'menu_item_parent' => '',
						'ID'               => '',
						'db_id'            => '',
						'url'              => fielding_page_link( 'news_archives', false ),
					) );

					array_unshift( $sorted_menu_items , (object) array(
						'title'            => 'News & Media',
						'menu_item_parent' => '',
						'ID'               => '',
						'db_id'            => '',
						'url'              => fielding_page_link( 'news_media', false ),
					) );

				} else if ( is_404() ) {
					// 404
					array_unshift( $sorted_menu_items , (object) array(
						'title'            => '404',
						'menu_item_parent' => '',
						'ID'               => '',
						'db_id'            => '',
						'url'              => '#',
					) );
				} else if ( is_search() ) {
					// Search
					array_unshift( $sorted_menu_items , (object) array(
						'title'            => 'Search',
						'menu_item_parent' => '',
						'ID'               => '',
						'db_id'            => '',
						'url'              => '#',
					) );
				} else if ( is_single() ) {
					// Add current post
					array_push( $sorted_menu_items , (object) array(
						'title'            => get_the_title(),
						'menu_item_parent' => '',
						'ID'               => '',
						'db_id'            => '',
						'url'              => get_the_permalink(),
					) );
				} else if ( isset( $_GET['s'] ) ) {
					// Add search
					array_push( $sorted_menu_items , (object) array(
						'title'            => 'Search Results',
						'menu_item_parent' => '',
						'ID'               => '',
						'db_id'            => '',
						'url'              => '#',
					) );
				} else if ( is_category() ) {
					$categories = get_the_category();
					$category   = $categories[0];
					// Add current category
					array_push( $sorted_menu_items , (object) array(
						'title'            => $category->name,
						'menu_item_parent' => '',
						'ID'               => '',
						'db_id'            => '',
						'url'              => '#',
					) );
				}  else if ( ! fielding_page_in_menu( $menu_id, $current_object_id ) ) {
					// Add current post
					array_unshift( $sorted_menu_items , (object) array(
						'title'            => get_the_title(),
						'menu_item_parent' => '',
						'ID'               => '',
						'db_id'            => '',
						'url'              => get_the_permalink(),
					) );
				}

				// Add home
				array_unshift( $sorted_menu_items , (object) array(
					'title'            => 'Home',
					'menu_item_parent' => '',
					'ID'               => 'home',
					'db_id'            => '',
					'url'              => fielding_page_link( 'home', false ),
				) );

				// Trim titles
				$count         = count( $sorted_menu_items );
				$limit_current = 30;
				$limit_all     = ( $count > 5 ) ? 10 : $limit_current;
				$i             = 0;

				foreach ( $sorted_menu_items as &$item ) {
					$i++;

					if ( $i < $count && strlen( $item->title ) > $limit_all ) {
						$item->title = trim( substr( $item->title, 0, $limit_all ) ) . '...';
					} else if ( $i == $count && strlen( $item->title ) > $limit_current ) {
						$item->title = trim( substr( $item->title, 0, $limit_current ) ) . '...';
					}
				}
			}
		}
	}

	return $sorted_menu_items;
}

add_filter( 'wp_nav_menu_objects', 'fielding_filter_nav_menu', 10, 2 );


/* ==========================================================================
	YouTube
============================================================================= */

function fielding_youtube_params( $url ) {
	return ((strpos($url, "?") < -1) ? "?" : "&") . "autoplay=1&fs=1&rel=0";
}

function fielding_is_youtube( $url ) {
	return ( preg_match( '/youtu\.be/i', $url ) || preg_match( '/youtube\.com\/watch/i', $url ) );
}

function fielding_youtube_id( $url ) {
	if ( fielding_is_youtube( $url ) ) {
		$pattern = '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/';
		preg_match( $pattern, $url, $matches );

		if ( count( $matches ) && strlen( $matches[7] ) == 11 ) {
			return $matches[7];
		}
	}

	return '';
}

/* ==========================================================================
	TinyMCE
============================================================================= */

/*
function fielding_mce_buttons( $buttons ) {
	unset( $buttons[2] ); // strike
	unset( $buttons[6] ); // hr
	unset( $buttons[7] ); // alignleft
	unset( $buttons[8] ); // align center
	unset( $buttons[9] ); // align right
	unset( $buttons[12] ); // more

	array_unshift( $buttons, 'styleselect' );
	array_unshift( $buttons, 'formatselect' );

	return $buttons;
}

function fielding_mce_buttons_2( $buttons ) {
	unset( $buttons[0] ); // format
	unset( $buttons[1] ); // underline
	unset( $buttons[2] ); // justify
	unset( $buttons[3] ); // color

	return $buttons;
}

add_filter('mce_buttons', 'fielding_mce_buttons');
add_filter('mce_buttons_2', 'fielding_mce_buttons_2');

function fielding_mce_before_init( $config ) {
	$formats = array(
		array(
			'title' => 'Button - Yellow',
			'inline' => 'a',
			'classes' => 'button button_border_yellow',
		),
		array(
			'title' => 'Button - Gray',
			'inline' => 'a',
			'classes' => 'button button_border_gray_light',
		),
	);

	$config['style_formats'] = json_encode( $formats );

	return $config;
}

add_filter( 'tiny_mce_before_init', 'fielding_mce_before_init' );
*/

function fielding_add_editor_styles() {
	$theme_dir = get_template_directory_uri();

	add_editor_style( $theme_dir . '/css/admin-editor.css' );
}

add_action( 'admin_init', 'fielding_add_editor_styles' );


/* ==========================================================================
	Program Search Ajax
============================================================================= */

/*
function lima_ajax_program_search() {
	$query = $_POST['query'];
	$type  = $_POST['type'];

	// Set args
	$args = lima_get_program_post_args( $type );

	// Query Posts
	$groups = lima_get_programs( $args, $query );

	echo lima_program_listing( $groups );
	die();
}

add_action( 'wp_ajax_program_search', 'lima_ajax_program_search' );
add_action( 'wp_ajax_nopriv_program_search', 'lima_ajax_program_search' );

// Draw program Listing

function lima_program_listing( $groups ) {
	ob_start();

	if ( array_filter($groups) ) {
		foreach ( $groups as $letter => $programs ) {
		?>
		<div class="toggle_list_group program_search_group" id="<?php echo $letter; ?>">
			<?php
			foreach ( $programs as $program ) {
				$title   = get_field( 'program_sort', $program->ID );
				$content = get_field( 'program_blurb', $program->ID );
				$image   = get_field( 'program_image', $program->ID );

				$page = get_posts(array(
					'numberposts' => 1,
					'post_type'	  => 'page',
					'meta_key'	  => 'program',
					'meta_value'  => $program->ID
				));
				$page = ( array_filter( $page ) ) ? $page[0] : false;
				$link = ( $page && isset( $page->ID ) ) ? get_the_permalink( $page->ID ) : false;
			?>
			<article class="toggle_list_item program_search_result js-toggle">
				<header class="toggle_list_item_header program_search_result_header js-toggle_handle">
					<h3 class="toggle_list_item_header_cell toggle_list_item_title program_search_cell_title"><?php echo $title; ?></h3>
					<div class="toggle_list_item_header_cell program_search_result_tokens">
						<?php
						foreach ( $program->degrees as $degree ) {
						?>
						<span class="token_inline <?php echo $degree->slug; ?>"><?php echo $degree->slug; ?></span>
						<?php
						}
						?>
					</div>
				</header>
				<div class="toggle_list_item_detail program_search_result_detail">
					<?php if ( $image['id'] ) { ?>
					<figure class="program_search_result_figure">
						<?php lima_responsive_image( lima_image_program_list( $image['id'] ) ); ?>
					</figure>
					<?php } ?>
					<div class="toggle_list_item_content program_search_result_content">
						<p class="toggle_list_item_description program_search_result_description"><?php echo lima_trim_length( $content, 250 ); ?></p>
						<?php if ( $link ) { ?>
						<a href="<?php echo $link; ?>" class="button button_bg_white program_search_result_button">Program Details</a>
						<?php } ?>
					</div>
				</div>
			</article>
			<?php
			}
			?>
		</div>
		<?php
		}
	} else {
		?>
		<div class="margined_lg_bottom">
			<p class="no_results no_border">Sorry, no results found.</p>
		</div>
		<?php
	}

	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}

// Program args

function lima_get_program_post_args( $program_type ) {
	return array(
		'posts_per_page' => -1,
		'post_type'      => 'program',
		'orderby'        => 'meta_value',
		'order'          => 'ASC',
		'meta_key'       => 'program_sort',
		'tax_query' => array(
			array(
				'taxonomy'         => 'program-type',
				'field'            => 'slug',
				'terms'            => $program_type,
				'include_children' => false,
				'operator'         => 'IN'
			),
		),
	);
}

// Program alpha

function lima_get_program_alpha_nav( $args ) {
	$posts = get_posts( $args );
	$groups = array();

	foreach ( $posts as $post ) {
		setup_postdata($post);

		$sort   = get_field( 'program_sort', $post->ID );
		$letter = strtolower( substr( $sort, 0, 1) );

		if ( $letter ) {
			if ( ! isset( $groups[ $letter ] ) ) {
				$groups[ $letter ] = array();
			}

			$post->degrees = wp_get_post_terms( $post->ID, 'program-degree', array(
				'orderby' => 'ID',
				'order'   => 'ASC',
			) );

			$groups[ $letter ][] = $post;
		}
	}

	wp_reset_postdata();

	return $groups;
}

// Programs

function lima_get_programs( $args, $query ) {
	if ( $query ) {
		$args['meta_query'] = array(
			'relation' => 'OR',
			array(
				'key'     => 'program_sort',
				'value'   => $query,
				'compare' => 'LIKE',
			),
			array(
				'key'     => 'program_blurb',
				'value'   => $query,
				'compare' => 'LIKE',
			)
		);
	}

	$posts  = get_posts( $args );
	$groups = array();

	foreach ( $posts as $post ) {
		setup_postdata($post);

		$sort   = get_field( 'program_sort', $post->ID );
		$letter = strtolower( substr( $sort, 0, 1) );

		if ( $letter ) {
			if ( ! isset( $groups[ $letter ] ) ) {
				$groups[ $letter ] = array();
			}

			$post->degrees = wp_get_post_terms( $post->ID, 'program-degree', array(
				'orderby' => 'ID',
				'order'   => 'ASC',
			) );

			$groups[ $letter ][] = $post;
		}
	}

	wp_reset_postdata();

	return $groups;
}
*/

/* ==========================================================================
	Course Search Ajax
============================================================================= */

/*
function lima_ajax_course_search() {
	$type    = $_POST['type'];
	$term    = $_POST['term'];
	$subject = $_POST['subject'];
	$query   = $_POST['query'];
	$link    = $_POST['link'];

	if ( '' === $query && '' === $subject ) {
		$subjects = lima_get_subjects( $type, $term );
		$html = lima_course_landing( $subjects, $term, $link );
	} else {
		$couses = lima_get_courses( $type, $term, $subject, $query );
		$html = lima_course_listing( $couses, $term );
	}

	echo $html;
	die();
}

add_action( 'wp_ajax_course_search', 'lima_ajax_course_search' );
add_action( 'wp_ajax_nopriv_course_search', 'lima_ajax_course_search' );

function lima_course_landing( $subjects, $term, $page_link ) {
	ob_start();

	if ( array_filter( $subjects ) ) {
		?>
		<div class="subject_list margined_md_bottom">
			<?php
			foreach ( $subjects as $subject ) :
				$code = strtolower( $subject['STVSUBJ_CODE'] );
				$parts = array(
					'subject=' . $code
				);

				if ( $active_term ) {
					$parts[] = 'term=' . $term;
				}

				$link = $page_link . '?' . implode( '&', $parts );
			?>
			<div class="subject_list_item js-subject_filter_item" data-code="<?php echo $code; ?>">
				<a href="<?php echo $link; ?>" class="subject_list_link"><?php echo $subject['STVSUBJ_DESC']; ?></a>
			</div>
			<?php
			endforeach;
			?>
		</div>
		<?
	}

	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}

function lima_course_listing( $courses, $term ) {
	ob_start();

	if ( array_filter( $courses ) ) {
		?>
		<div class="toggle_list_header course_search_header">
			<span class="toggle_list_header_cell course_search_cell_title">Name</span>
			<span class="toggle_list_header_cell course_search_cell_code">CRN</span>
			<span class="toggle_list_header_cell course_search_cell_subject">Subject</span>
			<span class="toggle_list_header_cell course_search_cell_credits">Credits</span>
			<span class="toggle_list_header_cell course_search_cell_enrollment">Enrolled/Cap</span>
		</div>
		<div class="toggle_list_group course_search_group" id="programs-a">
			<?php
			foreach ( $courses as $course ) :
				$full = ( $course['maxEnrl'] > 0 && $course['enrl'] >= $course['maxEnrl'] );
				$restricted = $course['maxEnrl'] == 0;
				$name = $course['firstName'] . ' ' . $course['lastName'];
				$days = '';

				$types = array();
				if ( $course['online'] || $course['hybrid'] || $course['immersion'] ) {
					if ( 'true' == $course['online'] ) {
						$types[] = 'Online';
					}
					if ( 'true' == $course['hybrid'] ) {
						$types[] = 'Hybrid';
					}
					if ( 'true' == $course['immersion'] ) {
						$types[] = 'Immersion';
					}
				}

				$scheduledTimes = array();
				if($course['meetingTime']){
					$scheduledTimes = explode(';',$course['meetingTime']);
				}

				$days = array();
				if (strpos($course['days'], 'M') > -1) {
					$days[] = 'Monday';
				}
				if (strpos($course['days'], 'T') > -1) {
					$days[] = 'Tuesday';
				}
				if (strpos($course['days'], 'W') > -1) {
					$days[] = 'Wednesday';
				}
				if (strpos($course['days'], 'R') > -1) {
					$days[] = 'Thursday';
				}
				if (strpos($course['days'], 'F') > -1) {
					$days[] = 'Friday';
				}
			?>
			<article class="toggle_list_item course_search_result js-toggle">
				<header class="toggle_list_item_header course_search_result_header js-toggle_handle">
					<h3 class="toggle_list_item_header_cell toggle_list_item_title course_search_cell_title">
						<?php
						echo $course['title'];

						if ( $full ) :
						?>
						<span class="token_inline token_padded pink">Full</span>
						<?php
						endif;

						if ( $restricted ) :
						?>
						<span class="token_inline token_padded yellow">Restricted</span>
						<?php
						endif;

						if ( trim( $name ) ) :
						?>
						<span class="course_search_result_professor"><?php echo $name; ?></span>

						<?php
						endif;
						if ( $course['meetingTime'] ) :
						?>
						<span class="course_search_result_time">
							<em>
								<?php
								if($scheduledTimes) :
									foreach ( $scheduledTimes as $courseMeeting ) {
										echo $courseMeeting . ((count($scheduledTimes) > 1) ? "<br>" : "");
									}

								endif;
								?>
							</em>
						</span>
						<?php
						endif;
						?>

					</h3>
					<div class="toggle_list_item_header_cell course_search_cell_code">
						<span class="course_search_result_label">CRN</span>
						<?php echo $course['crn']; ?>
					</div>
					<div class="toggle_list_item_header_cell course_search_cell_subject">
						<span class="course_search_result_label">Subject</span>
						<?php echo $course['course']; ?>
					</div>
					<div class="toggle_list_item_header_cell course_search_cell_credits">
						<span class="course_search_result_label">Credits</span>
						<?php echo $course['credits']; ?>
					</div>
					<div class="toggle_list_item_header_cell course_search_cell_enrollment">
						<span class="course_search_result_label">Enrolled/Cap</span>
						<?php echo $course['enrl']; ?> / <?php echo $course['maxEnrl']; ?>
					</div>
				</header>
				<div class="toggle_list_item_detail course_search_result_detail">
					<div class="toggle_list_item_content course_search_result_content">
						<?php if ( $full ) : ?>
						<span class="toggle_list_item_description course_search_result_alert">We're sorry, but this class is already full!</span>
						<?php endif; ?>
						<p class="toggle_list_item_description course_search_result_description">
							<?php echo $course['description']; ?>
							<? if ( $course['description'] && $course['notes'] ) : ?>
							<br><br>
							<?php endif; ?>
							<? if ( $course['notes'] ) : ?>
							<?php echo $course['notes']; ?>
							<?php endif; ?>
						</p>
					</div>
					<aside class="course_search_result_info">
						<h4 class="course_search_result_info_heading">Class Info</h4>
						<?php
						if ( array_filter( $types ) ) :
						?>
						<span class="course_search_result_info_item type">
							<?php echo implode( ', ', $types ); ?>
						</span>
						<?php
						endif;

						if ( $course['bldgCode'] || $course['roomCode'] ) :
						?>
						<span class="course_search_result_info_item pin">
							<?php echo $course['bldgCode'] . ' ' . $course['roomCode']; ?>
						</span>
						<?
						endif;
						?>
						<span class="course_search_result_info_item book">
							<a href="<?php lima_bookstore_url( $course, $term ); ?>" class="js-lightbox" target="_blank">Required Books</a>
						</span>
					</aside>
				</div>
			</article>
			<?php
			endforeach;
			?>
		</div>
		<?php
	} else {
		?>
		<div class="margined_lg_bottom">
			<p class="no_results no_border">Sorry, no results found.</p>
		</div>
		<?php
	}

	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}

function lima_get_subjects( $type, $term ) {
	$parts = array(
		'term_code=' . $term,
	);

	if ( 'undergraduate' == $type ) {
		$url = 'https://wise.strose.edu/rest/public/UndergradPrograms/json';
	} else {
		$url = 'https://wise.strose.edu/rest/public/GradPrograms/json';
	}

	$url .= '?' . implode( '&', $parts);
	$key = 'subjects-' . $type . '-' . md5( $url );

	return lima_courses_request( $url, $key, $term );
}

function lima_get_courses( $type, $term, $subject, $query ) {
	$parts = array(
		'term_code=' . $term,
		'subj_code=' . strtoupper( $subject ),
	);

	if ( $query ) {
		$parts[] = '&search=' . $query;
	}

	if ( 'undergraduate' == $type ) {
		$url = 'https://wise.strose.edu/rest/public/UndergradCourses/json';
	} else {
		$url = 'https://wise.strose.edu/rest/public/GradCourses/json';
	}

	$url .= '?' . implode( '&', $parts);
	$key = 'courses-' . $type . '-' . md5( $url );

	return lima_courses_request( $url, $key );
}
*/


/* ==========================================================================
	Lockdown Alert
============================================================================= */

/*
function lima_lockdown_include( $template ) {
	global $lima_lockdown;

	$active = get_field( 'lockdown_active', 'option' );

	if ( is_array( $active ) && array_filter( $active ) && 'on' == $active[0] ) {
		$lima_lockdown = true;
		$lockdown = locate_template( array( 'page-lockdown.php' ) );
		if ( '' != $lockdown ) {
			$template = $lockdown;
		}
	}

	return $template;
}

add_filter( 'template_include', 'lima_lockdown_include', 99 );
*/


/* ==========================================================================
	Future Permalinks
============================================================================= */

/*
function lima_future_permalink( $permalink, $post, $leavename, $sample = false ) {
	static $recursing = false;

	if ( empty( $post->ID ) ) {
		return $permalink;
	}

	if ( !$recursing ) {
		if ( isset( $post->post_status ) && ( 'future' === $post->post_status ) ) {
			$post->post_status = 'publish';
			$recursing = true;
			return get_permalink( $post, $leavename ) ;
		}
	}

	$recursing = false;
	return $permalink;
}

add_filter( 'post_link', 'lima_future_permalink', 10, 3 );
add_filter( 'post_type_link', 'lima_future_permalink', 10, 4 );
*/

/* ==========================================================================
	Future Posts
============================================================================= */

/*
function lima_future_posts($posts) {
	global $wp_query, $wpdb;

	if ( is_single() && $wp_query->post_count == 0 ) {
		$posts = $wpdb->get_results($wp_query->request);
	}

	return $posts;
}

add_filter( 'the_posts', 'lima_future_posts' );

if ( !is_admin() ) {
	function lima_future_posts_loop( $query ) {
    	if ( $query->is_category() ) {
	    	$queried_object = get_queried_object();
			$scheduled = get_field('category_show_scheduled', $queried_object);

	    	if ( $scheduled[0] == 'show' ) {
        		$GLOBALS[ 'wp_post_statuses' ][ 'future' ]->public = true;
        	}
        }
	}

	add_filter( 'pre_get_posts', 'lima_future_posts_loop' );
}
*/


