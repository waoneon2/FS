<?php
/**
 * Trinity College functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Trinity_College
 */

if ( ! function_exists( 'tric_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function tric_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Trinity College, use a find and replace
		 * to change 'tric' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'tric', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'secondary' 		=> esc_html__( 'Secondary', 'tric' ),
			'exposed' 			=> esc_html__( 'Exposed', 'tric' ),
			'footer-primary' 	=> esc_html__( 'Footer - Primary ', 'tric' ),
			'footer-info' 		=> esc_html__( 'Footer - Information For ', 'tric' ),
			'footer-social' 	=> esc_html__( 'Footer - Social', 'tric' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'tric_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'tric_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tric_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'tric_content_width', 640 );
}
add_action( 'after_setup_theme', 'tric_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tric_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'tric' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'tric' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'tric_widgets_init' );

function tric_search_filter($query) {

	if ($query->is_archive() && $query->is_main_query()) {

		$search_filter = isset($_GET['fsearch']) ? $_GET['fsearch'] : '';
		if ($search_filter) {
			$query->set('s', $search_filter);
		}

		$term_filter = isset($_GET['fcat']) ? $_GET['fcat'] : '';
		if ($term_filter) {
			$query->set('tax_query', array(
				array(
					'taxonomy' => 'news-category',
					'field'    => 'slug',
					'terms'    => $term_filter,
				),
			));
		}
	}
}
add_action('pre_get_posts', 'tric_search_filter');

function tric_bulrb_autofill() {
	global $post;

	$meta_blurb = get_post_meta($post->ID, 'blurb', true);
	$trim   = 30; //max length of words to display

	if (!$meta_blurb || empty($meta_blurb))
	{
		$content = strip_tags($post->post_content);

		$old_arr = array_map('trim', explode(' ', $content));
		$new_arr = array_slice($old_arr, 0, $trim);

		$content = implode(' ',$new_arr).' ...';
		echo '<p>'.$content.'</p>';
	} else {
		echo '<p>'.$meta_blurb.'</p>';
	}
}

/**
 * Program Filter AJAX
 */

add_action('wp_ajax_data_fetch' , 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch','data_fetch');
function data_fetch() {
	include get_template_directory() . '/inc/partials/homepage-programs-ajax.php';
	exit;
}

/**
 * Enqueue scripts and styles.
 */

function tric_scripts() {
	wp_enqueue_style( 'tric-style', get_stylesheet_uri() );

	wp_enqueue_style( 'tric-site', get_template_directory_uri() . '/css/site.css' );

	wp_enqueue_style( 'tric-wpfix', get_template_directory_uri() . '/css/wpfix.css' );

	wp_enqueue_script( 'tric-site', get_template_directory_uri() . '/js/site.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'tric-custom-script', get_template_directory_uri() . '/js/custom.js', array('jquery'), '20180709', true );

	wp_register_script( 'tric-program-filter', get_template_directory_uri() . '/js/program.js', array('jquery'), '20180709', true );

	if (is_front_page()) {
		wp_localize_script ( 'tric-program-filter', 'search_by_keyword', array (
		   'ajaxurl' => admin_url('admin-ajax.php')
		));
		wp_enqueue_script('tric-program-filter');
	}

	?>
	<script>
		var WWW_ROOT = "";
		var STATIC_ROOT = "<?php echo get_template_directory_uri() . '/' ?>";
	</script>
	<?php

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tric_scripts' );

function tric_wysiwgy_style() {
    add_editor_style( '/css/wysiwgy.css' );
}
add_action( 'init', 'tric_wysiwgy_style' );

/**
 * Hidden acf title on program post type
 */
function test_save_hook( $post_id, $post, $update ){

    if( 'programs_post' !== $post->post_type ) {
      return $post_id;
    }
    update_field( 'title', $post->post_title, $post_id );
    return $post_id;
}
add_action( 'save_post', 'test_save_hook', 10, 3 );

/**
 * Sync ACF Json Folder
 */
add_filter('acf/settings/load_json', function($paths) {
    $paths = array(get_template_directory() . '/acf-json');

    if(is_child_theme()){
        $paths = array(
            get_stylesheet_directory() . '/acf-json',
            get_template_directory() . '/acf-json'
        );

    }

    return $paths;
});
add_filter('acf/settings/save_json', function() {
	return get_stylesheet_directory() . '/acf-json';
});


/**
 * tinymce button
 */
function tric_tinymce_button() {
    if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
        return;
    }
    if ( 'true' == get_user_option( 'rich_editing' ) ) {
        add_filter( 'mce_external_plugins', 'tric_tinymce_plugin' );
        add_filter( 'mce_buttons', 'tric_register_tinymce_button' );
    }
}
add_action( 'admin_head', 'tric_tinymce_button' );
function tric_tinymce_plugin( $plugin_array ) {
    $plugin_array['tric_tinymce_button'] = get_template_directory_uri() . '/js/tinymce_quote.js';
    return $plugin_array;
}
function tric_register_tinymce_button( $buttons ) {
    array_push( $buttons, 'tric_tinymce_button' );
    return $buttons;
}

// Remove the toolbar font and fontsize button
add_filter('mce_buttons_2', 'remove_link_button', 3000);
function remove_link_button( $buttons ) {
  $remove = array('fontselect', 'fontsizeselect');
  return array_diff( $buttons, $remove );
}


add_action('admin_init','sync_all_custom_taxonomy');
function sync_all_custom_taxonomy(){
	global $blog_id;
	if($blog_id > 1){
		switch_to_blog(1);
		$news_cat_terms = get_terms( array(
		    'taxonomy' => 'news-category',
		    'hide_empty' => false
		) );
		$news_related_terms = get_terms( array(
		    'taxonomy' => 'related-news',
		    'hide_empty' => false
		) );
		restore_current_blog();

		foreach ($news_cat_terms as $value) {
			if(!term_exists( $value->name, 'news-category', null )){
				wp_insert_term( $value->name, 'news-category', array( '' ) );
			}
		}

		foreach ($news_related_terms as $value) {
			if(!term_exists( $value->name, 'related-news', null )){
				wp_insert_term( $value->name, 'related-news', array( '' ) );
			}
		}
	}
}

add_action('admin_init', 't_custom_code');
function t_custom_code(){
	$id_front_page = get_option('page_on_front');
	$post_id = isset($_GET['post']) ? $_GET['post'] : 0 ;
	if((int) $post_id != (int) $id_front_page){
		add_action('admin_head', 't_custom_style');
	}
}

function t_custom_style(){
?>
<style type="text/css">
	div.acf-fc-popup.-top ul li a[data-layout="news_events"] {
		display: none !important;
	}
</style>
<?php
}
/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Functions to define the image size
 */
require get_template_directory() . '/inc/tric_image_size.php';

/**
 * Functions to craft primary navigation
 */
require get_template_directory() . '/inc/tric_walker_nav_menu.php';

/**
 * Functions support video
 */
require get_template_directory() . '/inc/tric_video_support.php';

 /**
  * Custom Post Type
  *
  * alerts, events, news, programs, stories
  */
 require get_template_directory() . '/inc/post-types/alerts-post.php';
 require get_template_directory() . '/inc/post-types/events-post.php';
 require get_template_directory() . '/inc/post-types/news-post.php';
 require get_template_directory() . '/inc/post-types/programs-post.php';
 require get_template_directory() . '/inc/post-types/stories-post.php';

 //REMOVE 'POSTS' MENU
function remove_posts_menus() {
  remove_menu_page( 'edit.php' );
}
add_action( 'admin_menu', 'remove_posts_menus' );

add_action( 'admin_bar_menu', 'remove_on_new_handle', 999 );
function remove_on_new_handle()
{
    global $wp_admin_bar, $blog_id;
    $wp_admin_bar->remove_node( 'new-post' );

    if(is_multisite()){
    	if($blog_id > 1){
    		$wp_admin_bar->remove_node( 'new-alerts_post' );
    		$wp_admin_bar->remove_node( 'new-events_post' );
    		$wp_admin_bar->remove_node( 'new-news_post' );
    		$wp_admin_bar->remove_node( 'new-programs_post' );
    		$wp_admin_bar->remove_node( 'new-stories_post' );
    	}
    }
}

//remove featured image on 'page'
function remove_thumbnail_box() {
    remove_meta_box( 'postimagediv','page','side' );
}
add_action('do_meta_boxes', 'remove_thumbnail_box');

function reset_permalinks() {
    global $wp_rewrite;
    if($wp_rewrite->permalink_structure != '/%postname%/'){
    	$wp_rewrite->set_permalink_structure( '/%postname%/' );
    }
}
add_action( 'init', 'reset_permalinks' );


/**
 * Functions ACF Multisite location rule
 */
if ( is_multisite() ) {
	add_filter('acf/location/rule_types', 'acf_location_rule_type_multisite');
	add_filter('acf/location/rule_values/site',  'acf_location_rule_values_multisites');
	add_filter('acf/location/rule_match/site', 'acf_location_rules_match_site', 10, 3);
}
function acf_location_rule_type_multisite( $choices ) {

	$choices['Multisite']['site'] = 'Site';
	return $choices;

}
function acf_location_rule_values_multisites( $choices ) {

	$choices ['all'] = 'All';
	$sites = get_sites();

	foreach( $sites as $site ) {
		$choices[ get_object_vars($site)["blog_id"] ] = get_object_vars($site)["path"];
	}

	return $choices;
}
function acf_location_rules_match_site( $match, $rule, $options ) {
	$current_site = get_current_blog_id();
	$selected_site = (int) $rule['value'];

	if($rule['operator'] == "==") {
		$match = ( $current_site == $selected_site );
	}
	elseif($rule['operator'] == "!=") {
		$match = ( $current_site != $selected_site );
	}

	return $match;
}

add_action( 'template_redirect', 'custom_redirect_alert_to_not_found' );
function custom_redirect_alert_to_not_found() {
 global $wp_query;
 $queried_post_type = get_query_var('post_type');
 if ( is_single() && 'alerts_post' ==  $queried_post_type ) {
     	$wp_query->set_404();
        status_header( 404 );
        get_template_part( 404 );
        exit();
 }
}

/**
 * If Default area stury term deleted
 */
add_action( 'pre_delete_term', 'on_term_deleted', 10, 2);
function on_term_deleted($id, $taxonomy) {
	$default_aos_term = array(
		'visual-and-performing-arts',
		'language-and-culture',
		'engineering',
		'social-sciences',
		'natural-sciences',
		'computer-science-mathematics',
		'humanities'
	);

	$term = get_term_by( 'id', $id, $taxonomy);
	if (in_array($term->slug, $default_aos_term )) {
		add_option( 'tric_term_deleted_' . $term->slug, $term->slug);
	}
}

/**
 * Target Blank
 */
function tric_tblank($link) {

	$urls 	= explode('//', network_home_url());
	$url 	= $urls[1];
	$url 	= str_replace("www.","",$url);
	$link 	= esc_url($link);

	$is_internal 	= strpos($link, $url);

	echo ($is_internal) ? '' : 'target="_blank"';
}