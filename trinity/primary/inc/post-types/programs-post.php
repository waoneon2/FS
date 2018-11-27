<?php

// ====================================REGISTER CUSTOM POST=====================================
add_action( 'init', 'programs_init' );
/**
 * Register a product post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function programs_init() {
	$labels = array(
		'name'               => _x( 'Programs', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Program', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Programs', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Programs', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Program', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Programs', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Programs', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Programs', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Programs', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Programs', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Programs', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Programs:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Programs found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Programs found in Trash.', 'your-plugin-textdomain' )

	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => false,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'programs' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'			 => 'dashicons-welcome-learn-more',
		'supports'           => array( 'title', 'editor')
	);

	register_post_type( 'programs_post', $args );
}


// ============================TAXONOMY====================================
// ============================TAXONOMY====================================

/* $term = [
	'Visual and Performing Arts',
	'Language and Culture',
	'Engineering',
	'Social Sciences',
	'Natural Sciences',
	'Computer Science & Mathematics',
	'Humanities'
]*/

function programs_type(){

	//set the name of the taxonomy
	$taxonomy = 'areas-of-study';
	//set the post types for the taxonomy
	$object_type = 'programs_post';

	//populate our array of names for our taxonomy
	$labels = array(
		'name'               => 'Type',
		'singular_name'      => 'Type',
		'search_items'       => 'Search Programs Type',
		'all_items'          => 'All Type',
		'parent_item'        => 'Parent Type',
		'parent_item_colon'  => 'Parent Type:',
		'update_item'        => 'Update Type',
		'edit_item'          => 'Edit Type',
		'add_new_item'       => 'Add New Type',
		'new_item_name'      => 'New Type Name',
		'menu_name'          => 'Areas of Study'
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
		'rewrite'           => array('slug' => 'programs-type')
	);

	//call the register_taxonomy function
	register_taxonomy($taxonomy, $object_type, $args);

	// Register Initial terms of "Areas of Study"
	$terms = array (
		'0' => array (
			'name'          => 'Visual and Performing Arts',
			'slug'          => 'visual-and-performing-arts',
			'description'   => 'Visual and Performing Arts',
		),
		'1' => array (
			'name'          => 'Language and Culture',
			'slug'          => 'language-and-culture',
			'description'   => 'Language and Culture',
		),
		'2' => array (
			'name'          => 'Engineering',
			'slug'          => 'engineering',
			'description'   => 'Engineering',
		),
		'3' => array (
			'name'          => 'Social Sciences',
			'slug'          => 'social-sciences',
			'description'   => 'Social Sciences',
		),
		'4' => array (
			'name'          => 'Natural Sciences',
			'slug'          => 'natural-sciences',
			'description'   => 'Natural Sciences',
		),
		'5' => array (
			'name'          => 'Computer Science & Mathematics',
			'slug'          => 'computer-science-mathematics',
			'description'   => 'Computer Science & Mathematics',
		),
		'6' => array (
			'name'          => 'Humanities',
			'slug'          => 'humanities',
			'description'   => 'Humanities',
		),
	);

	foreach ( $terms as $term)
	{
		$deleted_term = get_option( 'tric_term_deleted_' . $term['slug']);
		if (!$deleted_term) {
			if( !term_exists( $term['name'], $taxonomy ) ) {
				wp_insert_term(
					$term['name'],
					$taxonomy,
					array(
						'description'   => $term['description'],
						'slug'          => $term['slug'],
					)
				);
				unset( $term );
			}
		}
	}
}
add_action('init','programs_type');

?>