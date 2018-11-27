<?php

// ====================================REGISTER CUSTOM POST=====================================
add_action( 'init', 'alerts_init' );
/**
 * Register a product post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function alerts_init() {
	$labels = array(
		'name'               => _x( 'Alerts', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Alert', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Alerts', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Alerts', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Alerts', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Alerts', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Alerts', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Alerts', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Alerts', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Alerts', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Alerts', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Alerts:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Alerts found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Alerts found in Trash.', 'your-plugin-textdomain' )

	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => false,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'alerts' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'			 => 'dashicons-megaphone',
		'supports'           => array( 'title' )
	);

	register_post_type( 'alerts_post', $args );
}
?>