<?php
$options = array();
$options[] =  array(
	'id'          => _WSH()->set_term_key('category'),
	'types'       => array('category'),
	'title'       => __('Category Settings', 'wp_deeds'),
	'priority'    => 'high',
	'template'    => 
			array(
					array(
						'type'      => 'group',
						'repeating' => false,
						'length'    => 1,
						'name'      => 'sh_category_options',
						'title'     => __('Category Settings', 'wp_deeds'),
						'fields'    => 
						array(
							array(
								'type' => 'select',
								'name' => 'category_page_sidebars',
								'label' => __('Sidebar', 'wp_deeds'),
								'default' => '',
								'items' => sh_get_sidebars(true),
							),
							array(
								'type' => 'radioimage',
								'name' => 'category_page_layout',
								'label' => __('Category Page Layout', 'wp_deeds'),
								'description' => __('Choose the layout for category post listing page', 'wp_deeds'),
								'items' => array(
									array(
										'value' => 'left',
										'label' => __('Left Sidebar', 'wp_deeds'),
										'img' => get_template_directory_uri().'/framework/vafpress/public/img/2cl.png',
									),
									array(
										'value' => 'right',
										'label' => __('Right Sidebar', 'wp_deeds'),
										'img' => get_template_directory_uri().'/framework/vafpress/public/img/2cr.png',
									),									
								),
							),
						),
					),
				),
);
$options[] =  array(
	'id'          => _WSH()->set_term_key('ministry_category'),
	'types'       => array('ministry_category'),
	'title'       => __('Category Settings', 'wp_deeds'),
	'priority'    => 'high',
	'template'    => 
			array(
					array(
						'type'      => 'group',
						'repeating' => false,
						'length'    => 1,
						'name'      => 'sh_category_options',
						'title'     => __('Category Settings', 'wp_deeds'),
						'fields'    => 
						array(
							array(
								'type' => 'select',
								'name' => 'category_page_sidebar',
								'label' => __('Sidebar', 'wp_deeds'),
								'default' => '',
								'items' => sh_get_sidebars(true)	
							),
							array(
								'type' => 'radioimage',
								'name' => 'category_page_layout',
								'label' => __('Category Page Layout', 'wp_deeds'),
								'description' => __('Choose the layout for category post listing page', 'wp_deeds'),
								'items' => array(
									array(
										'value' => 'left',
										'label' => __('Left Sidebar', 'wp_deeds'),
										'img' => get_template_directory_uri().'/framework/vafpress/public/img/2cl.png',
									),
									array(
										'value' => 'right',
										'label' => __('Right Sidebar', 'wp_deeds'),
										'img' => get_template_directory_uri().'/framework/vafpress/public/img/2cr.png',
									),
								),
							),
							array(
								'type' => 'upload',
								'name' => 'category_page_header_image',
								'label' => __('Header Image', 'wp_deeds'),
								'default' => '',
								'description' => __('Upload Header Image.', 'wp_deeds')
							),
							
						),
					),
				),
);
$options[] =  array(
	'id'          => _WSH()->set_term_key('team_category'),
	'types'       => array('team_category'),
	'title'       => __('Category Settings', 'wp_deeds'),
	'priority'    => 'high',
	'template'    => 
			array(
					array(
						'type'      => 'group',
						'repeating' => false,
						'length'    => 1,
						'name'      => 'sh_category_options',
						'title'     => __('Category Settings', 'wp_deeds'),
						'fields'    => 
						array(
							array(
								'type' => 'select',
								'name' => 'category_page_sidebar',
								'label' => __('Sidebar', 'wp_deeds'),
								'default' => '',
								'items' => sh_get_sidebars(true)	
							),
							array(
								'type' => 'radioimage',
								'name' => 'category_page_layout',
								'label' => __('Category Page Layout', 'wp_deeds'),
								'description' => __('Choose the layout for category post listing page', 'wp_deeds'),
								'items' => array(
									array(
										'value' => 'left',
										'label' => __('Left Sidebar', 'wp_deeds'),
										'img' => get_template_directory_uri().'/framework/vafpress/public/img/2cl.png',
									),
									array(
										'value' => 'right',
										'label' => __('Right Sidebar', 'wp_deeds'),
										'img' => get_template_directory_uri().'/framework/vafpress/public/img/2cr.png',
									),									
								),
							),
							array(
								'type' => 'upload',
								'name' => 'category_page_header_image',
								'label' => __('Header Image', 'wp_deeds'),
								'default' => '',
								'description' => __('Upload Header Image.', 'wp_deeds')
							),
							
						),
					),
				),
);
$options[] =  array(
	'id'          => _WSH()->set_term_key('event_category'),
	'types'       => array('events_category'),
	'title'       => __('Category Settings', 'wp_deeds'),
	'priority'    => 'high',
	'template'    => 
			array(
					array(
						'type'      => 'group',
						'repeating' => false,
						'length'    => 1,
						'name'      => 'sh_category_options',
						'title'     => __('Category Settings', 'wp_deeds'),
						'fields'    => 
						array(
							array(
								'type' => 'select',
								'name' => 'category_page_sidebar',
								'label' => __('Sidebar', 'wp_deeds'),
								'default' => '',
								'items' => sh_get_sidebars(true)	
							),
							array(
								'type' => 'radioimage',
								'name' => 'category_page_layout',
								'label' => __('Category Page Layout', 'wp_deeds'),
								'description' => __('Choose the layout for category post listing page', 'wp_deeds'),
								'items' => array(
									array(
										'value' => 'left',
										'label' => __('Left Sidebar', 'wp_deeds'),
										'img' => get_template_directory_uri().'/framework/vafpress/public/img/2cl.png',
									),
									array(
										'value' => 'right',
										'label' => __('Right Sidebar', 'wp_deeds'),
										'img' => get_template_directory_uri().'/framework/vafpress/public/img/2cr.png',
									),									
								),
							),
							array(
								'type' => 'upload',
								'name' => 'category_page_header_image',
								'label' => __('Header Image', 'wp_deeds'),
								'default' => '',
								'description' => __('Upload Header Image.', 'wp_deeds')
							),
							
						),
					),
				),
);
$options[] =  array(
	'id'          => _WSH()->set_term_key('church_category'),
	'types'       => array('church_category'),
	'title'       => __('Category Settings', 'wp_deeds'),
	'priority'    => 'high',
	'template'    => 
			array(
					array(
						'type'      => 'group',
						'repeating' => false,
						'length'    => 1,
						'name'      => 'sh_category_options',
						'title'     => __('Category Settings', 'wp_deeds'),
						'fields'    => 
						array(
							array(
								'type' => 'select',
								'name' => 'category_page_sidebar',
								'label' => __('Sidebar', 'wp_deeds'),
								'default' => '',
								'items' => sh_get_sidebars(true)	
							),
							array(
								'type' => 'radioimage',
								'name' => 'category_page_layout',
								'label' => __('Category Page Layout', 'wp_deeds'),
								'description' => __('Choose the layout for category post listing page', 'wp_deeds'),
								'items' => array(
									array(
										'value' => 'left',
										'label' => __('Left Sidebar', 'wp_deeds'),
										'img' => get_template_directory_uri().'/framework/vafpress/public/img/2cl.png',
									),
									array(
										'value' => 'right',
										'label' => __('Right Sidebar', 'wp_deeds'),
										'img' => get_template_directory_uri().'/framework/vafpress/public/img/2cr.png',
									),									
								),
							),
							array(
								'type' => 'upload',
								'name' => 'category_page_header_image',
								'label' => __('Header Image', 'wp_deeds'),
								'default' => '',
								'description' => __('Upload Header Image.', 'wp_deeds')
							),
							
						),
					),
				),
);
$options[] =  array(
	'id'          => _WSH()->set_term_key('post_tag'),
	'types'       => array('post_tag'),
	'title'       => __('Category Settings', 'wp_deeds'),
	'priority'    => 'high',
	'template'    => 
			array(
					array(
						'type'      => 'group',
						'repeating' => false,
						'length'    => 1,
						'name'      => 'sh_post_tag_options',
						'title'     => __('Tag Settings', 'wp_deeds'),
						'fields'    => 
						array(
							array(
								'type' => 'select',
								'name' => 'post_tag_page_sidebar',
								'label' => __('Sidebar', 'wp_deeds'),
								'default' => '',
								'items' => sh_get_sidebars(true)	
							),
							array(
								'type' => 'radioimage',
								'name' => 'post_tag_page_layout',
								'label' => __('Tag Page Layout', 'wp_deeds'),
								'description' => __('Choose the layout for tag posts listing page', 'wp_deeds'),
								'items' => array(
									array(
										'value' => 'left',
										'label' => __('Left Sidebar', 'wp_deeds'),
										'img' => get_template_directory_uri().'/framework/vafpress/public/img/2cl.png',
									),
									array(
										'value' => 'right',
										'label' => __('Right Sidebar', 'wp_deeds'),
										'img' => get_template_directory_uri().'/framework/vafpress/public/img/2cr.png',
									),									
								),
							),
							array(
								'type' => 'upload',
								'name' => 'post_tag_page_header_image',
								'label' => __('Header Image', 'wp_deeds'),
								'default' => '',
								'description' => __('Upload Header Image.', 'wp_deeds')
							),
							
						),
					),
				),
);
$options[] =  array(
	'id'          => _WSH()->set_term_key('product_cat'),
	'types'       => array('product_cat'),
	'title'       => __('Product Settings', 'wp_deeds'),
	'priority'    => 'high',
	'template'    => 
			array(
					array(
						'type'      => 'group',
						'repeating' => false,
						'length'    => 1,
						'name'      => 'sh_product_options',
						'title'     => __('General Product Settings', 'wp_deeds'),
						'fields'    => 
						array(
							
							array(
								'type' => 'textbox',
								'name' => 'offer',
								'label' => __('Category Offer', 'wp_deeds'),
								'default' => '',
							),
							
						),
					),
				),
);
return $options;
/**
 * EOF
 */
 
 
