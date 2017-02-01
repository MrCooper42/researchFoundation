<?php

class SH_Taxonomies

{

	function __construct()

	{
		// Hook into the 'init' action
		add_action( 'init', array($this, 'taxonomies'), 0 );
	}

	// Register Custom Taxonomy

	function taxonomies()  {

		$labels = array(
			'name'                       => _x( 'Categories', 'Categories', 'wp_deeds' ),
			'singular_name'              => _x( 'Category', 'Category', 'wp_deeds' ),
			'menu_name'                  => __( 'Categories', 'wp_deeds' ),
			'all_items'                  => __( 'All Categories', 'wp_deeds' ),
			'parent_item'                => __( 'Parent Category', 'wp_deeds' ),
			'parent_item_colon'          => __( 'Parent Category:', 'wp_deeds' ),
			'new_item_name'              => __( 'New Category Name', 'wp_deeds' ),
			'add_new_item'               => __( 'Add New Category', 'wp_deeds' ),
			'edit_item'                  => __( 'Edit Category', 'wp_deeds' ),
			'update_item'                => __( 'Update Category', 'wp_deeds' ),
			'separate_items_with_commas' => __( 'Separate Categories with commas', 'wp_deeds' ),
			'search_items'               => __( 'Search Categories', 'wp_deeds' ),
			'add_or_remove_items'        => __( 'Add or remove Categories', 'wp_deeds' ),
			'choose_from_most_used'      => __( 'Choose from the most used Categories', 'wp_deeds' ),
		);

		$rewrite = array(
			'slug'                       => 'events_category',
			'with_front'                 => true,
			'hierarchical'               => true,
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
		register_taxonomy( 'events_category', array('cs_events'), $args );
		
		$labels = array(
			'name'                       => _x( 'Categories', 'Categories', 'wp_deeds' ),
			'singular_name'              => _x( 'Category', 'Category', 'wp_deeds' ),
			'menu_name'                  => __( 'Categories', 'wp_deeds' ),
			'all_items'                  => __( 'All Categories', 'wp_deeds' ),
			'parent_item'                => __( 'Parent Category', 'wp_deeds' ),
			'parent_item_colon'          => __( 'Parent Category:', 'wp_deeds' ),
			'new_item_name'              => __( 'New Category Name', 'wp_deeds' ),
			'add_new_item'               => __( 'Add New Category', 'wp_deeds' ),
			'edit_item'                  => __( 'Edit Category', 'wp_deeds' ),
			'update_item'                => __( 'Update Category', 'wp_deeds' ),
			'separate_items_with_commas' => __( 'Separate Categories with commas', 'wp_deeds' ),
			'search_items'               => __( 'Search Categories', 'wp_deeds' ),
			'add_or_remove_items'        => __( 'Add or remove Categories', 'wp_deeds' ),
			'choose_from_most_used'      => __( 'Choose from the most used Categories', 'wp_deeds' ),
		);

		$rewrite = array(
			'slug'                       => 'team_category',
			'with_front'                 => true,
			'hierarchical'               => true,
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
		register_taxonomy( 'team_category', array('cs_team'), $args ); 
		
		
		$labels = array(
			'name'                       => _x( 'Categories', 'Categories', 'wp_deeds' ),
			'singular_name'              => _x( 'Category', 'Category', 'wp_deeds' ),
			'menu_name'                  => __( 'Categories', 'wp_deeds' ),
			'all_items'                  => __( 'All Categories', 'wp_deeds' ),
			'parent_item'                => __( 'Parent Category', 'wp_deeds' ),
			'parent_item_colon'          => __( 'Parent Category:', 'wp_deeds' ),
			'new_item_name'              => __( 'New Category Name', 'wp_deeds' ),
			'add_new_item'               => __( 'Add New Category', 'wp_deeds' ),
			'edit_item'                  => __( 'Edit Category', 'wp_deeds' ),
			'update_item'                => __( 'Update Category', 'wp_deeds' ),
			'separate_items_with_commas' => __( 'Separate Categories with commas', 'wp_deeds' ),
			'search_items'               => __( 'Search Categories', 'wp_deeds' ),
			'add_or_remove_items'        => __( 'Add or remove Categories', 'wp_deeds' ),
			'choose_from_most_used'      => __( 'Choose from the most used Categories', 'wp_deeds' ),
		);

		$rewrite = array(
			'slug'                       => 'church_category',
			'with_front'                 => true,
			'hierarchical'               => true,
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			//'rewrite'                    => $rewrite,
		);
		register_taxonomy( 'church_category', array('cs_church'), $args );
		
		
		$labels = array(
			'name'                       => _x( 'Categories', 'Categories', 'wp_deeds' ),
			'singular_name'              => _x( 'Category', 'Category', 'wp_deeds' ),
			'menu_name'                  => __( 'Categories', 'wp_deeds' ),
			'all_items'                  => __( 'All Categories', 'wp_deeds' ),
			'parent_item'                => __( 'Parent Category', 'wp_deeds' ),
			'parent_item_colon'          => __( 'Parent Category:', 'wp_deeds' ),
			'new_item_name'              => __( 'New Category Name', 'wp_deeds' ),
			'add_new_item'               => __( 'Add New Category', 'wp_deeds' ),
			'edit_item'                  => __( 'Edit Category', 'wp_deeds' ),
			'update_item'                => __( 'Update Category', 'wp_deeds' ),
			'separate_items_with_commas' => __( 'Separate Categories with commas', 'wp_deeds' ),
			'search_items'               => __( 'Search Categories', 'wp_deeds' ),
			'add_or_remove_items'        => __( 'Add or remove Categories', 'wp_deeds' ),
			'choose_from_most_used'      => __( 'Choose from the most used Categories', 'wp_deeds' ),
		);

		$rewrite = array(
			'slug'                       => 'ministry_category',
			'with_front'                 => true,
			'hierarchical'               => true,
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
		register_taxonomy( 'ministry_category', array('cs_ministry'), $args );
	}
}