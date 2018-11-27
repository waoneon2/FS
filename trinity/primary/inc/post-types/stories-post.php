<?php

// ====================================REGISTER CUSTOM POST=====================================
add_action( 'init', 'stories_init' );
/**
 * Register a product post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function stories_init() {
	$labels = array(
		'name'               => _x( 'Stories', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Stories', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Stories', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Stories', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Stories', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Stories', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Stories', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Stories', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Stories', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Stories', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Stories', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Stories:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Stories found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Stories found in Trash.', 'your-plugin-textdomain' )

	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => false,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'stories' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'			 => 'dashicons-format-quote',
		'supports'           => array( 'title')
	);

	register_post_type( 'stories_post', $args );
}
?>