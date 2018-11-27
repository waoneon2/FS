<?php

/* ==========================================================================
	Site Settings
============================================================================= */

if ( function_exists( 'acf_add_options_sub_page' ) ) {
	// Theme
	acf_add_options_sub_page(array(
		'page_title' => 'Theme Settings',
		'title' => 'Theme Settings',
		'parent' => 'options-general.php',
		'capability' => 'manage_options'
	));
}

/* ==========================================================================
	Admin Menu Order
============================================================================= */

function fielding_remove_menus() {
	remove_menu_page( 'edit-comments.php' );
}

add_action( 'admin_menu', 'fielding_remove_menus' );

function fielding_admin_menu_order() {
	global $menu;

	// Move media down
	$menu['27'] = $menu[10];
	unset( $menu[10] );

	// Move posts down
	$menu['21'] = $menu[5];
	unset( $menu[5] );

	$menu[21][0] = "News";

	// Move events down
	$menu['21.5'] = $menu[6];
	unset( $menu[6] );
}

add_action( 'admin_menu', 'fielding_admin_menu_order', 20 );

/* ==========================================================================
	Directory
============================================================================= */

function fielding_register_directory() {
	register_post_type( 'directory', array(
		'labels'              => array(
			'name'            => 'Directory',
			'singular_name'   => 'Person',
			'add_new_item'    => 'Add Person',
			'edit_item'       => 'Edit Person',
			'view_item'       => 'View Person',
		),
		'description'         => '',
		'public'              => true,
		'show_ui'             => true,
		'has_archive'         => false,
		'show_in_menu'        => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array(
			'slug'            => 'directory',
			'with_front'      => true,
		),
		'query_var'           => false,
		'menu_position'       => 22
	) );

	register_taxonomy( 'directory-departments', 'directory', array(
		'labels'            => array(
			'name'          => 'Departments',
			'add_new_item'  => 'Add New Department',
			'new_item_name' => 'New Department',
		),
		'show_ui'           => true,
		'show_tagcloud'     => false,
		'show_admin_column' => false,
		'hierarchical'      => true,
	) );

	register_taxonomy_for_object_type( 'directory-departments', 'directory' );

	fielding_import_directory();
}

add_action( 'init', 'fielding_register_directory' );

function fielding_import_directory() {
	$dir  = get_template_directory();
	$file = $dir . '/directory.csv';

	// if (!$_GET["debug"]) {
		return;
	// }

	if ( ($handle = fopen($file, 'r')) !== false ) {
		while ( ($data = fgetcsv($handle, 1000, ',')) !== false ) {
			fielding_import_directory_item( $data );
		}

		fclose($handle);
	}
}

function fielding_import_directory_item( $item ) {
	global $wpdb;

	$first    = $item[1];
	$last     = $item[0];
	$sort     = strtolower( substr( $last , 0, 1 ) );
	$email    = $item[2];
	$phone    = $item[3];

	$position = $item[4];
	$dept     = $item[5];

	$type     = 'directory';
	$tax      = 'directory-departments';
	$title    = $last . ', ' . $first;

	$term_check = get_term_by( 'name', htmlspecialchars($dept), $tax );
	if ( !$term_check ) {
		wp_insert_term( $dept, $tax );

		$term_check = get_term_by( 'name', htmlspecialchars($dept), $tax );
	}

	$post_id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type= %s", $title, $type ) );
	$term_id = $term_check->term_id;

	// Create entry
	if ( ! $post_id ) {
		$post_id = wp_insert_post( array(
			'post_author'    => 1,
			// 'post_name'      => $slug,
			'post_title'     => $title,
			'post_status'    => 'publish',
			'post_type'      => $type,
			// 'post_date'      => date( 'Y-m-d H:i:s', strtotime( $item['time'] ) ),
			// 'post_date_gmt'  => gmdate( 'Y-m-d H:i:s', strtotime( $item['time'] ) ),
			'comment_status' => 'closed',
		) );
	}

	// Update content
	if ( $post_id > 0 ) {
		wp_set_object_terms( $post_id, $term_id, $tax );

		update_field( 'field_56deced037085', $sort, $post_id );		// Sort
		update_field( 'field_56dc8bbffadd9', $first, $post_id );	// First Name
		update_field( 'field_56dc8b14a1217', $last, $post_id );		// Last Name

		if ($phone) {
			$phone = array( array( "phone" => $item[3] ) );
			update_field( 'field_56dc8ac3a1213', $phone, $post_id );	// Phone
		}

		if ($email) {
			$email = array( array( "email" => $item[2] ) );
			update_field( 'field_56dc8aeaa1215', $email, $post_id );	// Email
		}

		update_field( 'field_56dc8a61a1211', $position, $post_id );	// Position / Title
	}
}


/* ==========================================================================
	Testimonials
============================================================================= */

function fielding_register_testimonials() {
	register_post_type( 'testimonials', array(
		'labels'              => array(
			'name'            => 'Testimonials',
			'singular_name'   => 'Testimonial',
			'add_new_item'    => 'Add Testimonial',
			'edit_item'       => 'Edit Testimonial',
			'view_item'       => 'View Testimonial',
		),
		'description'         => '',
		'public'              => true,
		'show_ui'             => true,
		'has_archive'         => false,
		'show_in_menu'        => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array(
			'slug'            => 'testimonial',
			'with_front'      => true,
		),
		'query_var'           => false,
		'menu_position'       => 22
	) );

	register_taxonomy( 'testimonials-categories', 'testimonials', array(
		'labels'            => array(
			'name'          => 'Categories',
			'add_new_item'  => 'Add New Category',
			'new_item_name' => 'New Category',
		),
		'show_ui'           => true,
		'show_tagcloud'     => false,
		'show_admin_column' => true,
		'hierarchical'      => true,
	) );

	register_taxonomy_for_object_type( 'testimonials-categories', 'testimonials' );
}

add_action( 'init', 'fielding_register_testimonials' );

/* ==========================================================================
	Spotlights
============================================================================= */

function fielding_register_spotlights() {
	register_post_type( 'spotlights', array(
		'labels'              => array(
			'name'            => 'Spotlights',
			'singular_name'   => 'Spotlight',
			'add_new_item'    => 'Add Spotlight',
			'edit_item'       => 'Edit Spotlight',
			'view_item'       => 'View Spotlight',
		),
		'description'         => '',
		'public'              => true,
		'show_ui'             => true,
		'has_archive'         => false,
		'show_in_menu'        => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array(
			'slug'            => 'spotlights',
			'with_front'      => true,
		),
		'query_var'           => 'spotlights',
		'menu_position'       => 22
	) );

	register_taxonomy( 'spotlights-categories', 'spotlights', array(
		'labels'            => array(
			'name'          => 'Categories',
			'add_new_item'  => 'Add New Category',
			'new_item_name' => 'New Category',
		),
		'show_ui'           => true,
		'show_tagcloud'     => false,
		'show_admin_column' => true,
		'hierarchical'      => true,
	) );

	register_taxonomy_for_object_type( 'spotlights-categories', 'spotlights' );
}

add_action( 'init', 'fielding_register_spotlights' );


/* ==========================================================================
	Map Pins
============================================================================= */

function fielding_register_mappins() {
	register_post_type( 'mappins', array(
		'labels'              => array(
			'name'            => 'Alumni Map',
			'singular_name'   => 'Map Pin',
			'add_new_item'    => 'Add Map Pin',
			'edit_item'       => 'Edit Map Pin',
			'view_item'       => 'View Map Pin',
		),
		'description'         => '',
		'public'              => true,
		'show_ui'             => true,
		'has_archive'         => false,
		'show_in_menu'        => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array(
			'slug'            => 'mappins',
			'with_front'      => true,
		),
		'query_var'           => false,
		'menu_position'       => 22
	) );
}

add_action( 'init', 'fielding_register_mappins' );
