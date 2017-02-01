<?php

class SH_Post_types
{
	
	function __construct()
	{
		// Hook into the 'init' action
		add_action( 'init', array( $this, 'bistro_slider' ), 0 );
		
	}
	
	function labels( $names = '', $labels = array() )
	{
		$default =  array(
			'name'                => _x( 'Slides', 'Slides', 'wp_deeds' ),
			'singular_name'       => _x( 'Slide', 'Slide', 'wp_deeds' ),
			'menu_name'           => __( 'Slidr', 'wp_deeds' ),
			'parent_item_colon'   => __( 'Parent Slide:', 'wp_deeds' ),
			'all_items'           => __( 'All Slides', 'wp_deeds' ),
			'view_item'           => __( 'View Slide', 'wp_deeds' ),
			'add_new_item'        => __( 'Add New Slide', 'wp_deeds' ),
			'add_new'             => __( 'New Slide', 'wp_deeds' ),
			'edit_item'           => __( 'Edit Slide', 'wp_deeds' ),
			'update_item'         => __( 'Update Slide', 'wp_deeds' ),
			'search_items'        => __( 'Search Slides', 'wp_deeds' ),
			'not_found'           => __( 'No Slides found', 'wp_deeds' ),
			'not_found_in_trash'  => __( 'No Slides found in Trash', 'wp_deeds' ),
		);
		
		foreach( $default as $k => $v ){
			$default[$k] = str_replace( array('Slide', 'Slides'), $names, $v);
		}
		$labels = wp_parse_args( $labels, $default );
		
		return $labels;
	}
	
	function args( $args = array() )
	{
		$default = array(
			'label'               => __( 'bistro_slider', 'wp_deeds' ),
			'labels'              => array(),
			'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'           => '',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			//'rewrite'             => array(),
			'capability_type'     => 'page',
		);
		$args = wp_parse_args( $args, $default );
		return $args;
	}
	
	// Register Custom Post Type
	function bistro_slider() 
	{
		
		$settings = include( SH_FRW_DIR.'resource/post_types.php');

		foreach( $options as $k => $v )
		{
			$labels = $this->labels(sh_set( $v, 'labels'), sh_set( $v, 'label_args' ) );	
	
			$rewrite = array(
				'slug'                => sh_set( $v, 'slug' ),
				'with_front'          => true,
				'pages'               => true,
				'feeds'               => false,
			);
		
			$args = $this->args( array('labels'=>$labels, 'supports'=>sh_set( $v, 'supports'),  'label'=>sh_set($v, 'label') ));
			$args = wp_parse_args( sh_set( $v, 'args' ), $args );

			$register = register_post_type( $k, $args );
			if( is_wp_error($register) ) echo $register->get_error_message();
		}

	}

}