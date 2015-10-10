<?php 

function wpp_promotion_pt() {
	$labels = array(
	'name'               => _x( 'Promotions', 'post type general name' ),
	'singular_name'      => _x( 'Promotion', 'post type singular name' ),
	'add_new'            => _x( 'Add New', 'book' ),
	'add_new_item'       => __( 'Add New Promotion' ),
	'edit_item'          => __( 'Edit Promotion' ),
	'new_item'           => __( 'New Promotion' ),
	'all_items'          => __( 'All Promotions' ),
	'view_item'          => __( 'View Promotion' ),
	'search_items'       => __( 'Search Promotions' ),
	'not_found'          => __( 'No promotions found' ),
	'not_found_in_trash' => __( 'No promotions found in the Trash' ), 
	'parent_item_colon'  => '',
	'menu_name'          => 'Promotions'
	);

	$args = array(
	'labels'             => $labels,
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'query_var'          => true,
	'rewrite'            => array( 'slug' => 'promotion' ),
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => false,
	'menu_position'      => null,
	'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'promotion', $args );
}

add_action( 'init', 'wpp_promotion_pt' );

function wpp_promotion_taxonomies() {

	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search categories' ),
		'all_items'         => __( 'All categories' ),
		'parent_item'       => __( 'Parent category' ),
		'parent_item_colon' => __( 'Parent category:' ),
		'edit_item'         => __( 'Edit category' ),
		'update_item'       => __( 'Update category' ),
		'add_new_item'      => __( 'Add New category' ),
		'new_item_name'     => __( 'New category Name' ),
		'menu_name'         => __( 'category' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'category' ),
	);

	register_taxonomy( 'promotion_category', array( 'promotion' ), $args );
}

add_action( 'init', 'wpp_promotion_taxonomies' );