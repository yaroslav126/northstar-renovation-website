<?php
/**
 * Custom Post Types and Taxonomies for Northstar Renovation.
 *
 * @package NorthstarSiteCore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Northstar Custom Post Types.
 */
function northstar_core_register_post_types() {
	// 1. Projects Custom Post Type
	$project_labels = array(
		'name'                  => _x( 'Projects', 'Post type general name', 'northstar-site-core' ),
		'singular_name'         => _x( 'Project', 'Post type singular name', 'northstar-site-core' ),
		'menu_name'             => _x( 'Projects', 'Admin Menu text', 'northstar-site-core' ),
		'name_admin_bar'        => _x( 'Project', 'Add New on Toolbar', 'northstar-site-core' ),
		'add_new'               => __( 'Add New Project', 'northstar-site-core' ),
		'add_new_item'          => __( 'Add New Renovation Project', 'northstar-site-core' ),
		'new_item'              => __( 'New Project', 'northstar-site-core' ),
		'edit_item'             => __( 'Edit Project', 'northstar-site-core' ),
		'view_item'             => __( 'View Project', 'northstar-site-core' ),
		'all_items'             => __( 'All Projects', 'northstar-site-core' ),
		'search_items'          => __( 'Search Projects', 'northstar-site-core' ),
		'not_found'             => __( 'No projects found.', 'northstar-site-core' ),
		'not_found_in_trash'    => __( 'No projects found in Trash.', 'northstar-site-core' ),
	);

	$project_args = array(
		'labels'             => $project_labels,
		'description'        => __( 'Residential renovation and architectural portfolio projects.', 'northstar-site-core' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'projects', 'with_front' => false ),
		'capability_type'    => 'post',
		'has_archive'        => 'projects',
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-hammer',
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ),
	);

	register_post_type( 'northstar_project', $project_args );

	// 2. Services Custom Post Type
	$service_labels = array(
		'name'                  => _x( 'Services', 'Post type general name', 'northstar-site-core' ),
		'singular_name'         => _x( 'Service', 'Post type singular name', 'northstar-site-core' ),
		'menu_name'             => _x( 'Services', 'Admin Menu text', 'northstar-site-core' ),
		'add_new'               => __( 'Add New Service', 'northstar-site-core' ),
		'add_new_item'          => __( 'Add New Renovation Service', 'northstar-site-core' ),
		'edit_item'             => __( 'Edit Service', 'northstar-site-core' ),
		'view_item'             => __( 'View Service', 'northstar-site-core' ),
		'all_items'             => __( 'All Services', 'northstar-site-core' ),
		'search_items'          => __( 'Search Services', 'northstar-site-core' ),
	);

	$service_args = array(
		'labels'             => $service_labels,
		'description'        => __( 'Specialized renovation and design services offered by Northstar.', 'northstar-site-core' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'services', 'with_front' => false ),
		'capability_type'    => 'post',
		'has_archive'        => 'services',
		'hierarchical'       => false,
		'menu_position'      => 6,
		'menu_icon'          => 'dashicons-admin-tools',
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
	);

	register_post_type( 'northstar_service', $service_args );

	// 3. Demonstration Testimonials Custom Post Type
	$testimonial_labels = array(
		'name'                  => _x( 'Demonstration Testimonials', 'Post type general name', 'northstar-site-core' ),
		'singular_name'         => _x( 'Demonstration Testimonial', 'Post type singular name', 'northstar-site-core' ),
		'menu_name'             => _x( 'Testimonials (Demo)', 'Admin Menu text', 'northstar-site-core' ),
		'add_new'               => __( 'Add New Demo Testimonial', 'northstar-site-core' ),
		'add_new_item'          => __( 'Add New Demonstration Testimonial', 'northstar-site-core' ),
		'edit_item'             => __( 'Edit Testimonial', 'northstar-site-core' ),
		'all_items'             => __( 'All Demonstration Testimonials', 'northstar-site-core' ),
	);

	$testimonial_args = array(
		'labels'             => $testimonial_labels,
		'description'        => __( 'Demonstration client reviews for portfolio demonstration purposes only.', 'northstar-site-core' ),
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_position'      => 7,
		'menu_icon'          => 'dashicons-testimonial',
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'custom-fields' ),
	);

	register_post_type( 'northstar_testimonial', $testimonial_args );
}
add_action( 'init', 'northstar_core_register_post_types' );

/**
 * Register Custom Taxonomies.
 */
function northstar_core_register_taxonomies() {
	// Project Categories Taxonomy
	$tax_labels = array(
		'name'              => _x( 'Project Categories', 'taxonomy general name', 'northstar-site-core' ),
		'singular_name'     => _x( 'Project Category', 'taxonomy singular name', 'northstar-site-core' ),
		'search_items'      => __( 'Search Project Categories', 'northstar-site-core' ),
		'all_items'         => __( 'All Project Categories', 'northstar-site-core' ),
		'parent_item'       => __( 'Parent Category', 'northstar-site-core' ),
		'parent_item_colon' => __( 'Parent Category:', 'northstar-site-core' ),
		'edit_item'         => __( 'Edit Category', 'northstar-site-core' ),
		'update_item'       => __( 'Update Category', 'northstar-site-core' ),
		'add_new_item'      => __( 'Add New Project Category', 'northstar-site-core' ),
		'new_item_name'     => __( 'New Category Name', 'northstar-site-core' ),
		'menu_name'         => __( 'Categories', 'northstar-site-core' ),
	);

	$tax_args = array(
		'hierarchical'      => true,
		'labels'            => $tax_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'project-category' ),
		'show_in_rest'      => true,
	);

	register_taxonomy( 'project_category', array( 'northstar_project' ), $tax_args );
}
add_action( 'init', 'northstar_core_register_taxonomies' );

/**
 * Register Custom Meta Fields for REST & Block Editor.
 */
function northstar_core_register_meta() {
	// Project Meta Fields
	$project_fields = array(
		'_ns_project_location'             => 'string',
		'_ns_project_timeline'             => 'string',
		'_ns_project_budget_tier'          => 'string',
		'_ns_project_scope'                => 'string',
		'_ns_project_architectural_style'  => 'string',
		'_ns_project_materials'            => 'string',
		'_ns_project_is_featured'          => 'boolean',
	);

	foreach ( $project_fields as $field => $type ) {
		register_post_meta( 'northstar_project', $field, array(
			'show_in_rest' => true,
			'single'       => true,
			'type'         => $type,
			'auth_callback'=> function() {
				return current_user_can( 'edit_posts' );
			},
		) );
	}

	// Service Meta Fields
	$service_fields = array(
		'_ns_service_key_deliverables'     => 'string',
		'_ns_service_typical_timeline'     => 'string',
		'_ns_service_investment_guide'     => 'string',
		'_ns_service_icon'                 => 'string',
	);

	foreach ( $service_fields as $field => $type ) {
		register_post_meta( 'northstar_service', $field, array(
			'show_in_rest' => true,
			'single'       => true,
			'type'         => $type,
			'auth_callback'=> function() {
				return current_user_can( 'edit_posts' );
			},
		) );
	}

	// Testimonial Meta Fields
	$testimonial_fields = array(
		'_ns_testimonial_client_name'      => 'string',
		'_ns_testimonial_neighborhood'     => 'string',
		'_ns_testimonial_project_type'     => 'string',
		'_ns_testimonial_completion_year'  => 'string',
		'_ns_testimonial_rating'           => 'integer',
	);

	foreach ( $testimonial_fields as $field => $type ) {
		register_post_meta( 'northstar_testimonial', $field, array(
			'show_in_rest' => true,
			'single'       => true,
			'type'         => $type,
			'auth_callback'=> function() {
				return current_user_can( 'edit_posts' );
			},
		) );
	}
}
add_action( 'init', 'northstar_core_register_meta' );
