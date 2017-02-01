<?php

$options = array();
$options[] = array(
	'id' => 'sh_post_meta',
	'types' => array( 'post' ),
	'title' => __( 'Post Settings', 'wp_deeds' ),
	'priority' => 'high',
	'template' =>
	array(
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'sh_post_options',
			'title' => __( 'General Post Settings', 'wp_deeds' ),
			'fields' =>
			array(
				array(
					'type'	=>	'toggle',
					'name'	=>	'show_banner',
					'label'	=>	__('Show Banner','wp_deeds'),
				),
				array(
					'type' => 'textbox',
					'name' => 'sub_title',
					'label' => __( 'Subtitle', 'wp_deeds' ),
					'default' => '',
					'dependency'	=>	array(
						'field'	=>	'show_banner',
						'function'	=>	'vp_dep_boolean',
					),
				),
				array(
					'type' => 'upload',
					'name' => 'top_img',
					'label' => __( 'Top Image', 'wp_deeds' ),
					'default' => '',
					'dependency'	=>	array(
						'field'	=>	'show_banner',
						'function'	=>	'vp_dep_boolean',
					),
				),
				array(
					'type' => 'select',
					'name' => 'sidebar',
					'label' => __( 'Sidebar', 'wp_deeds' ),
					'default' => '',
					'items' => sh_get_sidebars( true ),
				),
				array(
					'type' => 'radioimage',
					'name' => 'layout',
					'label' => __( 'Page Layout', 'wp_deeds' ),
					'description' => __( 'Choose the layout for blog pages', 'wp_deeds' ),
					'dependency' => array(
						'field' => 'sidebar',
						'function' => 'vp_dep_boolean',
					),
					'items' => array(
						array(
							'value' => 'left',
							'label' => __( 'Left Sidebar', 'wp_deeds' ),
							'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cl.png',
						),
						array(
							'value' => 'right',
							'label' => __( 'Right Sidebar', 'wp_deeds' ),
							'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cr.png',
						),
						array(
							'value' => 'full',
							'label' => __( 'Full Width', 'wp_deeds' ),
							'img' => get_template_directory_uri() . '/framework/vafpress/public/img/1col.png',
						),
					),
				),
				array(
					'type' => 'textarea',
					'name' => 'video',
					'label' => __( 'Video Embed Code', 'wp_deeds' ),
					'default' => '',
					'description' => __( 'If post format is video then this embed code will be used in content. <a href="https://s3.amazonaws.com/webinane/video_instructions.jpg" target="_blank">' . __( 'More Info', 'wp_deeds' ) . '</a>', 'wp_deeds' )
				),
				array(
					'type' => 'select',
					'name' => 'audio_type',
					'label' => __( 'Select your audio type', 'wp_deeds' ),
					'items' => array( array( 'value' => 'soundcloud', 'label' => 'Sound Cloud' ), array( 'value' => 'own', 'label' => 'Your Own', ) ),
					'description' => __( 'If post format is audio then this will be used in content', 'wp_deeds' )
				),
				array(
					'type' => 'textbox',
					'name' => 'soundcloud_id',
					'label' => __( 'Enter your Sound Cloud ID', 'wp_deeds' ),
					'dependency' => array(
						'field' => 'audio_type',
						'function' => 'vp_dep_is_soundcloud',
					),
				),
				array(
					'type' => 'upload',
					'name' => 'own_audio',
					'label' => __( 'Select Your Audio File', 'wp_deeds' ),
					'dependency' => array(
						'field' => 'audio_type',
						'function' => 'vp_dep_is_own',
					),
				),
				array(
					'type'      => 'group',
					'repeating' => false,
					'length'    => 1,
					'name'      => 'galleries_setting',
					'title'     => esc_html__('Gallery', 'wp_deeds'),
					'fields'    => 
					 array(
						array(
							'type' => 'gallery',
							'name' => 'gallery_opt',
							'label' => esc_html__('Gallery Images', 'wp_deeds'),
							'description' => esc_html__('Upload the images for the gallery', 'wp_deeds'),	
						),
					),
				),				
			),
		),
	),
);

/* Page options */
$options[] = array(
	'id' => 'sh_page_meta',
	'types' => array( 'page' ),
	'title' => __( 'Page Settings', 'wp_deeds' ),
	'priority' => 'high',
	'template' =>
	array(
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'sh_page_options',
			'title' => __( 'General Page Settings', 'wp_deeds' ),
			'fields' =>
			array(
				array(
					'type' => 'toggle',
					'name' => 'breadcumb',
					'label' => __( 'Show Breadcumb', 'wp_deeds' ),
				),
				array(
					'type' => 'textbox',
					'name' => 'sub_title',
					'label' => __( 'Subtitle', 'wp_deeds' ),
					'default' => '',
				),
				array(
					'type' => 'select',
					'name' => 'sidebar',
					'label' => __( 'Sidebar', 'wp_deeds' ),
					'default' => '',
					'items' => sh_get_sidebars( true )
				),
				array(
					'type' => 'radioimage',
					'name' => 'layout',
					'label' => __( 'Page Layout', 'wp_deeds' ),
					'description' => __( 'Choose the layout for blog pages', 'wp_deeds' ),
					'dependency' => array(
						'field' => 'sidebar',
						'function' => 'vp_dep_boolean',
					),
					'items' => array(
						array(
							'value' => 'left',
							'label' => __( 'Left Sidebar', 'wp_deeds' ),
							'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cl.png',
						),
						array(
							'value' => 'right',
							'label' => __( 'Right Sidebar', 'wp_deeds' ),
							'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cr.png',
						),
						array(
							'value' => 'full',
							'label' => __( 'Full Width', 'wp_deeds' ),
							'img' => get_template_directory_uri() . '/framework/vafpress/public/img/1col.png',
						),
					),
				),
				array(
					'type' => 'upload',
					'name' => 'top_img',
					'label' => __( 'Top Image', 'wp_deeds' ),
					'default' => '',
				),
				array(
					'type' => 'toggle',
					'name' => 'home',
					'label' => __( 'Make this Home Page', 'wp_deeds' ),
					'default' => '',
				),
			),
		),
	),
);

/** Team Options */
$options[] = array(
	'id' => 'sh_team_meta',
	'types' => array( 'cs_team' ),
	'title' => __( 'Team Options', 'wp_deeds' ),
	'priority' => 'high',
	'template' => array(
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'sh_team_page_options',
			'title' => __( 'Team Page Settings', 'wp_deeds' ),
			'fields' =>
			array(
				array(
					'type'	=>	'toggle',
					'name'	=>	'show_team_banner',
					'label'	=>	__('Show Page Banner','wp_deeds'),
				),
				array(
					'type' => 'textbox',
					'name' => 'sub_title',
					'label' => __( 'Subtitle', 'wp_deeds' ),
					'default' => '',
					'dependency'	=>	array(
						'field'	=>	'show_team_banner',
						'function'	=>	'vp_dep_boolean',
					),
				),
				array(
					'type'	=>	'toggle',
					'name'	=>	'show_breadcrumbs',
					'label'	=>	__('Show BreadCrumbs', 'wp_deeds'),
					'dependency'	=>	array(
						'field'	=>	'show_team_banner',
						'function'	=>	'vp_dep_boolean',
					),
				),
				array(
					'type' => 'upload',
					'name' => 'top_img',
					'label' => __( 'Top Image', 'wp_deeds' ),
					'default' => '',
					'dependency'	=>	array(
						'field'	=>	'show_team_banner',
						'function'	=>	'vp_dep_boolean',
					),
				),
				array(
					'type' => 'select',
					'name' => 'sidebar',
					'label' => __( 'Sidebar', 'wp_deeds' ),
					'default' => '',
					'items' => sh_get_sidebars( true )
				),
				array(
					'type' => 'radioimage',
					'name' => 'layout',
					'label' => __( 'Page Layout', 'wp_deeds' ),
					'description' => __( 'Choose the layout for blog pages', 'wp_deeds' ),
					'dependency' => array(
						'field' => 'sidebar',
						'function' => 'vp_dep_boolean',
					),
					'items' => array(
						array(
							'value' => 'left',
							'label' => __( 'Left Sidebar', 'wp_deeds' ),
							'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cl.png',
						),
						array(
							'value' => 'right',
							'label' => __( 'Right Sidebar', 'wp_deeds' ),
							'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cr.png',
						),
						array(
							'value' => 'full',
							'label' => __( 'Full Width', 'wp_deeds' ),
							'img' => get_template_directory_uri() . '/framework/vafpress/public/img/1col.png',
						),
					),
				),
			),
		),
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'sh_team_options',
			'title' => __( 'Team Information', 'wp_deeds' ),
			'fields' => array(
				array(
					'type' => 'textbox',
					'name' => 'ph_number',
					'label' => __( 'Phone Number', 'wp_deeds' ),
					'default' => '',
				),
				array(
					'type' => 'textbox',
					'name' => 'designation',
					'label' => __( 'Designation', 'wp_deeds' ),
					'default' => '',
				),
				array(
					'type' => 'textbox',
					'name' => 'website',
					'label' => __( 'Website', 'wp_deeds' ),
					'default' => '',
				),
				array(
					'type' => 'textbox',
					'name' => 'email',
					'label' => __( 'Email', 'wp_deeds' ),
					'default' => '',
				),
				array(
					'type' => 'textarea',
					'name' => 'address',
					'label' => __( 'Address', 'wp_deeds' ),
					'default' => '',
				),
			),
		),
		array(
			'type' => 'group',
			'repeating' => true,
			'length' => 1,
			'name' => 'sh_team_social_profile',
			'title' => __( 'Team Social Profile', 'wp_deeds' ),
			'fields' => array(
				array(
					'type' => 'textbox',
					'name' => 'social_link',
					'label' => __( 'Link', 'wp_deeds' ),
					'default' => '',
				),
				array(
					'type' => 'fontawesome',
					'name' => 'social_icon',
					'label' => __( 'Icon', 'wp_deeds' ),
					'default' => '',
				),
			),
		),
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'sh_team_qualification',
			'title' => __( 'Qualification', 'wp_deeds' ),
			'fields' => array(
				array(
					'type' => 'textarea',
					'name' => 'content',
					'label' => __( 'Description', 'wp_deeds' ),
					'default' => '',
				),
				array(
					'type' => 'group',
					'repeating' => true,
					'length' => 1,
					'name' => 'sh_team_qualification_info',
					'title' => __( 'Qualification', 'wp_deeds' ),
					'fields' => array(
						array(
							'type' => 'textbox',
							'name' => 'qualification_line',
							'label' => __( 'qualification', 'wp_deeds' ),
							'default' => '',
						),
					),
				),
			),
		),
	),
);


/** Event Options * */
$options[] = array(
	'id' => 'sh_event_meta',
	'types' => array( 'cs_events' ),
	'title' => __( 'Event Options', 'wp_deeds' ),
	'priority' => 'high',
	'template' => array(
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'sh_events_page_options',
			'title' => __( 'Events Page Settings', 'wp_deeds' ),
			'fields' =>
			array(
				array(
					'type' => 'textbox',
					'name' => 'sub_title',
					'label' => __( 'Subtitle', 'wp_deeds' ),
					'default' => '',
				),
				array(
					'type' => 'select',
					'name' => 'sidebar',
					'label' => __( 'Sidebar', 'wp_deeds' ),
					'default' => '',
					'items' => sh_get_sidebars( true )
				),
				array(
					'type' => 'radioimage',
					'name' => 'layout',
					'label' => __( 'Page Layout', 'wp_deeds' ),
					'description' => __( 'Choose the layout for blog pages', 'wp_deeds' ),
					'dependency' => array(
						'field' => 'sidebar',
						'function' => 'vp_dep_boolean',
					),
					'items' => array(
						array(
							'value' => 'left',
							'label' => __( 'Left Sidebar', 'wp_deeds' ),
							'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cl.png',
						),
						array(
							'value' => 'right',
							'label' => __( 'Right Sidebar', 'wp_deeds' ),
							'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cr.png',
						),
						array(
							'value' => 'full',
							'label' => __( 'Full Width', 'wp_deeds' ),
							'img' => get_template_directory_uri() . '/framework/vafpress/public/img/1col.png',
						),
					),
				),
				array(
					'type' => 'upload',
					'name' => 'top_img',
					'label' => __( 'Top Image', 'wp_deeds' ),
					'default' => '',
				),
			),
		),
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'sh_event_options',
			'title' => __( 'Event Information', 'wp_deeds' ),
			'fields' =>
			array(
				array(
					'type' => 'date',
					'name' => 'start_date',
					'label' => __( 'Start Date', 'wp_deeds' ),
					'format' => 'yy-mm-dd',
				),
				array(
					'type' => 'date',
					'name' => 'end_date',
					'label' => __( 'End Date', 'wp_deeds' ),
					'format' => 'yy-mm-dd',
				),
				array(
					'type' => 'timepicker',
					'name' => 'start_time',
					'label' => __( 'Start Time', 'wp_deeds' ),
					'default' => '02:45:34',
				),
				array(
					'type' => 'timepicker',
					'name' => 'end_time',
					'label' => __( 'End Time', 'wp_deeds' ),
					'default' => '02:45:34',
				),
				array(
					'type' => 'textbox',
					'name' => 'location',
					'label' => __( 'Location', 'wp_deeds' ),
					'default' => '',
				),
				array(
					'type' => 'toggle',
					'name' => 'show_social_sharing',
					'label' => __( 'Show Social Sharing', 'wp_deeds' ),
					'default' => '',
				),
				array(
					'type' => 'textarea',
					'name' => 'google_map',
					'label' => __( 'Enter Google Map Code', 'wp_deeds' ),
					'default' => '',
				),
			),
		),
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'sh_event_pastor',
			'title' => __( 'Pastor Information', 'wp_deeds' ),
			'fields' => array(
				array(
					'type' => 'toggle',
					'name' => 'show_pastor',
					'label' => __( 'Show Pastor Information', 'wp_deeds' ),
					'default' => '',
				),
				array(
					'type' => 'textbox',
					'name' => 'pastor_name',
					'label' => __( 'Name', 'wp_deeds' ),
					'default' => '',
					'dependency' => array(
						'field' => 'show_pastor',
						'function' => 'vp_dep_boolean',
					),
				),
				array(
					'type' => 'textbox',
					'name' => 'pastor_desig',
					'label' => __( 'Role', 'wp_deeds' ),
					'default' => '',
					'dependency' => array(
						'field' => 'show_pastor',
						'function' => 'vp_dep_boolean',
					),
				),
				array(
					'type' => 'textarea',
					'name' => 'pastor_description',
					'label' => __( 'Description', 'wp_deeds' ),
					'default' => '',
					'dependency' => array(
						'field' => 'show_pastor',
						'function' => 'vp_dep_boolean',
					),
				),
				array(
					'type' => 'upload',
					'name' => 'pastor_image',
					'label' => __( 'Snap', 'wp_deeds' ),
					'default' => '',
					'dependency' => array(
						'field' => 'show_pastor',
						'function' => 'vp_dep_boolean',
					),
				),
			),
		),
	),
);


/** Sermons Options * */
$options[] = array(
	'id' => 'sh_sermon_meta',
	'types' => array( 'cs_sermons' ),
	'title' => __( 'Sermon Options', 'wp_deeds' ),
	'priority' => 'high',
	'template' => array(
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'sh_sermons_page_options',
			'title' => __( 'Sermons Page Settings', 'wp_deeds' ),
			'fields' =>
			array(
				array(
					'type'	=>	'toggle',
					'name'	=>	'show_sermon_banner',
					'label'	=>	__('Show Page Banner', 'wp_deeds'),
				),
				array(
					'type' => 'textbox',
					'name' => 'sub_title',
					'label' => __( 'Subtitle', 'wp_deeds' ),
					'default' => '',
					'dependency'	=>	array(
						'field'	=>	'show_sermon_banner',
						'function'	=>	'vp_dep_boolean',
					),
				),
				array(
					'type' => 'upload',
					'name' => 'top_img',
					'label' => __( 'Top Image', 'wp_deeds' ),
					'default' => '',
					'dependency'	=>	array(
						'field'	=>	'show_sermon_banner',
						'function'	=>	'vp_dep_boolean',
					),
				),
				
				array(
					'type' => 'select',
					'name' => 'sidebar',
					'label' => __( 'Sidebar', 'wp_deeds' ),
					'default' => '',
					'items' => sh_get_sidebars( true )
				),
				array(
					'type' => 'radioimage',
					'name' => 'layout',
					'label' => __( 'Page Layout', 'wp_deeds' ),
					'description' => __( 'Choose the layout for blog pages', 'wp_deeds' ),
					'dependency' => array(
						'field' => 'sidebar',
						'function' => 'vp_dep_boolean',
					),
					'items' => array(
						array(
							'value' => 'left',
							'label' => __( 'Left Sidebar', 'wp_deeds' ),
							'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cl.png',
						),
						array(
							'value' => 'right',
							'label' => __( 'Right Sidebar', 'wp_deeds' ),
							'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cr.png',
						),
					),
				),
			),
		),
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'sh_sermon_options',
			'title' => __( 'Sermon Options', 'wp_deeds' ),
			'fields' =>
			array(
				array(
					'type' => 'textbox',
					'name' => 'sermon_vid_link',
					'label' => __( 'Video Link', 'wp_deeds' ),
					'default' => '#',
					'description'	=>	__('Note: Enter Embed Link','wp_deeds')
				),
				array(
					'type' => 'upload',
					'name' => 'audio_upload',
					'label' => __( 'Audio File', 'wp_deeds' ),
					'default' => '',
				),
				array(
					'type' => 'upload',
					'name' => 'download_link',
					'label' => __( 'Download Link', 'wp_deeds' ),
					'default' => '',
				),
				array(
					'type' => 'upload',
					'name' => 'pdf_file',
					'label' => __( 'Pdf File', 'wp_deeds' ),
					'default' => '',
				),
				/*array(
					'type' => 'toggle',
					'name' => 'show_social_sharing',
					'label' => __( 'Show Social Sharing', 'wp_deeds' ),
					'default' => '',
				),*/
			),
		),
		array(
			'type' => 'group',
			'repeating' => false,
			'length' => 1,
			'name' => 'sh_sermon_pastor',
			'title' => __( 'Pastor Information', 'wp_deeds' ),
			'fields' => array(
				array(
					'type' => 'toggle',
					'name' => 'show_pastor',
					'label' => __( 'Show Pastor Information', 'wp_deeds' ),
					'default' => '',
				),
				array(
					'type' => 'textbox',
					'name' => 'pastor_name',
					'label' => __( 'Name', 'wp_deeds' ),
					'default' => '',
					'dependency' => array(
						'field' => 'show_pastor',
						'function' => 'vp_dep_boolean',
					),
				),
				array(
					'type' => 'textbox',
					'name' => 'pastor_desig',
					'label' => __( 'Role', 'wp_deeds' ),
					'default' => '',
					'dependency' => array(
						'field' => 'show_pastor',
						'function' => 'vp_dep_boolean',
					),
				),
				array(
					'type' => 'textarea',
					'name' => 'pastor_description',
					'label' => __( 'Description', 'wp_deeds' ),
					'default' => '',
					'dependency' => array(
						'field' => 'show_pastor',
						'function' => 'vp_dep_boolean',
					),
				),
				array(
					'type' => 'upload',
					'name' => 'pastor_image',
					'label' => __( 'Snap', 'wp_deeds' ),
					'default' => '',
					'dependency' => array(
						'field' => 'show_pastor',
						'function' => 'vp_dep_boolean',
					),
				),
			),
		),
	),
);



/** Gallery Options */
$options[] = array(
	'id' => 'sh_gallery_meta',
	'types' => array( 'cs_gallery' ),
	'title' => __( 'Gallery Options', 'wp_deeds' ),
	'priority' => 'high',
	'template' => array(
		array(
			'type' => 'group',
			'repeating' => true,
			'length' => 1,
			'name' => 'sh_gallery_items',
			'title' => __( 'Gallery Items', 'wp_deeds' ),
			'fields' => array(
				array(
					'type' => 'upload',
					'name' => 'gallery_item',
					'label' => __( 'Image', 'wp_deeds' ),
					'default' => '',
				),
			),
		),
	),
);

/**
 * EOF
 */
$options[] = array(
	'id' => 'sh_product_meta',
	'types' => array( 'product' ),
	'title' => __( 'Product Settings', 'wp_deeds' ),
	'priority' => 'high',
	'template' =>
	array(
		array(
			'type' => 'textbox',
			'name' => 'product_sub_title',
			'label' => __( 'Subtitle', 'wp_deeds' ),
			'default' => '',
		),
		array(
			'type' => 'upload',
			'name' => 'product_top_img',
			'label' => __( 'Top Image', 'wp_deeds' ),
			'default' => '',
		),
	),
);


$options[] = array(
	'id' => 'sh_church_meta',
	'types' => array( 'cs_church' ),
	'title' => __( 'Church Settings', 'wp_deeds' ),
	'priority' => 'high',
	'template' =>
	array(
		array(
			'type' => 'textbox',
			'name' => 'author',
			'label' => __( 'Author', 'wp_deeds' ),
			'default' => '',
		),
		array(
			'type' => 'upload',
			'name' => 'author_img',
			'label' => __( 'Author Image', 'wp_deeds' ),
			'default' => '',
		),
		array(
			'type' => 'textbox',
			'name' => 'sub_title',
			'label' => __( 'Subtitle', 'wp_deeds' ),
			'default' => '',
		),
		array(
			'type' => 'select',
			'name' => 'sidebar',
			'label' => __( 'Sidebar', 'wp_deeds' ),
			'default' => '',
			'items' => sh_get_sidebars( true )
		),
		array(
			'type' => 'radioimage',
			'name' => 'layout',
			'label' => __( 'Page Layout', 'wp_deeds' ),
			'description' => __( 'Choose the layout for blog pages', 'wp_deeds' ),
			'dependency' => array(
				'field' => 'sidebar',
				'function' => 'vp_dep_boolean',
			),
			'items' => array(
				array(
					'value' => 'left',
					'label' => __( 'Left Sidebar', 'wp_deeds' ),
					'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cl.png',
				),
				array(
					'value' => 'right',
					'label' => __( 'Right Sidebar', 'wp_deeds' ),
					'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cr.png',
				),
				array(
					'value' => 'full',
					'label' => __( 'Full Width', 'wp_deeds' ),
					'img' => get_template_directory_uri() . '/framework/vafpress/public/img/1col.png',
				),
			),
		),
		array(
			'type' => 'upload',
			'name' => 'top_img',
			'label' => __( 'Top Image', 'wp_deeds' ),
			'default' => '',
		),
	),
);

$options[] = array(
	'id' => 'sh_ministry_meta',
	'types' => array( 'cs_ministry' ),
	'title' => __( 'Ministry Settings', 'wp_deeds' ),
	'priority' => 'high',
	'template' =>
	array(
		array(
			'type' => 'textbox',
			'name' => 'sub_title',
			'label' => __( 'Subtitle', 'wp_deeds' ),
			'default' => '',
		),
		array(
			'type' => 'select',
			'name' => 'sidebar',
			'label' => __( 'Sidebar', 'wp_deeds' ),
			'default' => '',
			'items' => sh_get_sidebars( true )
		),
		array(
			'type' => 'radioimage',
			'name' => 'layout',
			'label' => __( 'Page Layout', 'wp_deeds' ),
			'description' => __( 'Choose the layout for blog pages', 'wp_deeds' ),
			'dependency' => array(
				'field' => 'sidebar',
				'function' => 'vp_dep_boolean',
			),
			'items' => array(
				array(
					'value' => 'left',
					'label' => __( 'Left Sidebar', 'wp_deeds' ),
					'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cl.png',
				),
				array(
					'value' => 'right',
					'label' => __( 'Right Sidebar', 'wp_deeds' ),
					'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cr.png',
				),
				array(
					'value' => 'full',
					'label' => __( 'Full Width', 'wp_deeds' ),
					'img' => get_template_directory_uri() . '/framework/vafpress/public/img/1col.png',
				),
			),
		),
		array(
			'type' => 'upload',
			'name' => 'top_img',
			'label' => __( 'Top Image', 'wp_deeds' ),
			'default' => '',
		),
	),
);
return $options;







