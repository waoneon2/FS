<?php

// ====================================REGISTER CUSTOM POST=====================================
add_action( 'init', 'news_init' );
/**
 * Register a product post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function news_init() {
	$labels = array(
		'name'               => _x( 'News', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'News', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'News', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'News', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'News', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New News', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New News', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit News', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View News', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All News', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search News', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent News:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No News found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No News found in Trash.', 'your-plugin-textdomain' )

	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'news' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'			 => 'dashicons-format-aside',
		'supports'           => array( 'title', 'editor')
	);

	register_post_type( 'news_post', $args );
}


// ============================TAXONOMY====================================
// ============================TAXONOMY====================================
function news_category(){

	//set the name of the taxonomy
	$taxonomy = 'news-category';
	//set the post types for the taxonomy
	$object_type = 'news_post';

	//populate our array of names for our taxonomy
	$labels = array(
		'name'               => 'Category',
		'singular_name'      => 'Category',
		'search_items'       => 'Search Category',
		'all_items'          => 'All Category',
		'parent_item'        => 'Parent Category',
		'parent_item_colon'  => 'Parent Category:',
		'update_item'        => 'Update Category',
		'edit_item'          => 'Edit TypeCategory',
		'add_new_item'       => 'Add New Category',
		'new_item_name'      => 'New Type Category',
		'menu_name'          => 'News Categories'
	);

	//define arguments to be used
	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'show_ui'           => true,
		'how_in_nav_menus'  => true,
		'public'            => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'news-categories')
	);

	//call the register_taxonomy function
	register_taxonomy($taxonomy, $object_type, $args);
}
add_action('init','news_category');

function related_news_category(){

	//set the name of the taxonomy
	$taxonomy = 'related-news';
	//set the post types for the taxonomy
	$object_type = 'news_post';

	//populate our array of names for our taxonomy
	$labels = array(
		'name'               => 'Related News Category',
		'singular_name'      => 'Related News Category',
		'search_items'       => 'Search Related News Category',
		'all_items'          => 'All Related News Category',
		'parent_item'        => 'Parent Related News Category',
		'parent_item_colon'  => 'Parent Related News Category:',
		'update_item'        => 'Update Related News Category',
		'edit_item'          => 'Edit Related News Category',
		'add_new_item'       => 'Add New Related News Category',
		'new_item_name'      => 'New Type Related News Category',
		'menu_name'          => 'Related News Category'
	);

	//define arguments to be used
	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'show_ui'           => true,
		'how_in_nav_menus'  => true,
		'public'            => true,
		'show_admin_column' => true,
		'query_var'         => true
	);

	//call the register_taxonomy function
	register_taxonomy($taxonomy, $object_type, $args);
}
add_action('init','related_news_category');
?>