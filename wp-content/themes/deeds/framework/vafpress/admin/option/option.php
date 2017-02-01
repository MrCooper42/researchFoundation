<?php

return array(
    'title' => __('Webinane Theme Options', 'wp_deeds'),
    'logo' => 'logo.png',
    'menus' => array(
        // General Settings
        array(
            'title' => __('General Settings', 'wp_deeds'),
            'name' => 'general_settings',
            'icon' => 'font-awesome:fa fa-cog',
            'menus' => array(
                array(
                    'title' => __('General Settings', 'wp_deeds'),
                    'name' => 'general_settings',
                    'icon' => 'font-awesome:fa fa-th-large',
                    'controls' => array(
                        array(
                            'type' => 'section',
                            'repeating' => true,
                            'sortable' => true,
                            'title' => __('Color Scheme & Other Settings', 'wp_deeds'),
                            'name' => 'color_schemes',
                            'description' => __('This section is used for theme color & other settings', 'wp_deeds'),
                            'fields' => array(
                                array(
                                    'type' => 'select',
                                    'name' => 'time_zone',
                                    'label' => __('Select Your Time Zone', 'wp_deeds'),
                                    'items' => array(
                                        'data' => array(
                                            array(
                                                'source' => 'function',
                                                'value' => 'sh_time_zone',
                                            ),
                                        ),
                                    ),
                                ),
                                array(
                                    'type' => 'select',
                                    'name' => 'color_selection',
                                    'label' => __('Color Scheme', 'wp_deeds'),
                                    'description' => __('Enable to choose from Default Color Schemes', 'wp_deeds'),
                                    'items' => array(array('value' => 'custom', 'label' => 'Custom Color'), array('value' => 'default', 'label' => 'Default Color Schemes '),),
                                    'default' => 'custom'
                                ),
                                array(
                                    'type' => 'color',
                                    'name' => 'custom_color_scheme',
                                    'label' => __('Color Scheme', 'wp_deeds'),
                                    'description' => __('Choose the Custom color scheme for the theme.', 'wp_deeds'),
                                    'default' => '#EC644B',
                                    'dependency' => array(
                                        'field' => 'color_selection',
                                        'function' => 'vp_dep_is_custom_color',
                                    ),
                                ),
                                array(
                                    'type' => 'select',
                                    'name' => 'default_color_scheme',
                                    'label' => __('Color Scheme', 'wp_deeds'),
                                    'description' => __('Choose from Default color schemes for the theme.', 'wp_deeds'),
                                    'deafault' => 'no',
                                    'items' => array(
                                        array('value' => 'no', 'label' => 'No Color'),
                                        array('value' => 'blue', 'label' => 'Blue'),
                                        array('value' => 'darkgreen', 'label' => 'Dark Green'),
                                        array('value' => 'green', 'label' => 'Green'),
                                        array('value' => 'wedgewood', 'label' => 'Wedge Wood'),
                                        array('value' => 'red', 'label' => 'Red'),
                                    ),
                                    'dependency' => array(
                                        'field' => 'color_selection',
                                        'function' => 'vp_dep_is_default_color',
                                    ),
                                ),
                                array(
                                    'type' => 'toggle',
                                    'name' => 'boxed_layout',
                                    'label' => __('Boxed Layout', 'wp_deeds'),
                                    'description' => __('Turn Boxed Layout On.', 'wp_deeds'),
                                ),
                                array(
                                    'type' => 'radioimage',
                                    'name' => 'bg_pattorns',
                                    'label' => __('Choose Patorn', 'wp_deeds'),
                                    'item_max_height' => '150',
                                    'item_max_width' => '400',
                                    'dependency' => array(
                                        'field' => 'boxed_layout',
                                        'function' => 'vp_dep_boolean',
                                    ),
                                    'items' => array(
                                        array(
                                            'value' => 'pat1',
                                            'label' => __('Patorn 1', 'wp_deeds'),
                                            'img' => SH_URL . '/images/pat1.png',
                                        ),
                                        array(
                                            'value' => 'pat2',
                                            'label' => __('Patorn 2', 'wp_deeds'),
                                            'img' => SH_URL . '/images/pat2.png',
                                        ),
                                        array(
                                            'value' => 'pat3',
                                            'label' => __('Patorn 3', 'wp_deeds'),
                                            'img' => SH_URL . '/images/pat3.png',
                                        ),
                                        array(
                                            'value' => 'pat4',
                                            'label' => __('Patorn 4', 'wp_deeds'),
                                            'img' => SH_URL . '/images/pat4.png',
                                        ),
                                        array(
                                            'value' => 'pat5',
                                            'label' => __('Patorn 5', 'wp_deeds'),
                                            'img' => SH_URL . '/images/pat5.png',
                                        ),
                                    ),
                                ),
                                array(
                                    'type' => 'upload',
                                    'name' => 'site_background',
                                    'label' => __('Background', 'wp_deeds'),
                                    'description' => __('Upload the Background Image.', 'wp_deeds'),
                                    'default' => '',
                                    'dependency' => array(
                                        'field' => 'boxed_layout',
                                        'function' => 'vp_dep_boolean',
                                    ),
                                ),
                                array(
                                    'type' => 'toggle',
                                    'name' => 'rtl_style',
                                    'label' => __('RTL(Right to Left)', 'wp_deeds'),
                                    'description' => __('Turn RTL on or off', 'wp_deeds'),
                                    'items' => '',
                                ),
                                array(
                                    'type' => 'select',
                                    'name' => 'event_settings',
                                    'label' => __('Event Settings', 'wp_deeds'),
                                    'description' => __('Select the settings for event listing page', 'wp_deeds'),
                                    'items' => array(array('value' => 'default', 'label' => 'Recet Posts'), array('value' => 'by_events', 'label' => 'Order By Event Date'),),
                                    'default' => 'custom'
                                ),
                            ),
                        ),
                    ),
                ),
                /** Submenu for heading settings */
                array(
                    'title' => __('Header Settings', 'wp_deeds'),
                    'name' => 'header_settings',
                    'icon' => 'font-awesome:fa fa-th-large',
                    'controls' => array(
                        array(
                            'type' => 'upload',
                            'name' => 'site_favicon',
                            'label' => __('Favicon', 'wp_deeds'),
                            'description' => __('Upload the favicon, should be 16x16', 'wp_deeds'),
                            'default' => '',
                        ),
                        array(
                            'type' => 'upload',
                            'name' => 'shop_image',
                            'label' => __('Shop Image', 'wp_deeds'),
                            'description' => __('Upload the Shop Header Image', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'upload',
                            'name' => 'bbpress_image',
                            'label' => __('BBPress Image', 'wp_deeds'),
                            'description' => __('Upload the BBPress Header Image', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'section',
                            'title' => __('Logo Settings', 'wp_deeds'),
                            'name' => 'logo_with_image',
                            'fields' => array(
                                array(
                                    'type' => 'select',
                                    'name' => 'logo_type',
                                    'label' => __('Logo Type', 'wp_deeds'),
                                    'description' => __('select the type of logo', 'wp_deeds'),
                                    'items' => array(
                                        array(
                                            'value' => 'image',
                                            'label' => __('Image', 'wp_deeds'),
                                        ),
                                        array(
                                            'value' => 'text',
                                            'label' => __('Text', 'wp_deeds'),
                                        ),
                                    ),
                                    'default' => array(
                                        '{{first}}',
                                    ),
                                ),
                                array(
                                    'type' => 'upload',
                                    'name' => 'logo_image',
                                    'label' => __('Logo Image', 'wp_deeds'),
                                    'description' => __('Upload the logo image', 'wp_deeds'),
                                    'default' => get_template_directory_uri() . '/images/logo.png',
                                    'dependency' => array(
                                        'field' => 'logo_type',
                                        'function' => 'vp_dep_logo',
                                    ),
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'text_logo_text',
                                    'label' => __('Logo Text', 'wp_deeds'),
                                    'description' => __('Enter the Logo Text.', 'wp_deeds'),
                                    'default' => '',
                                    'dependency' => array(
                                        'field' => 'logo_type',
                                        'function' => 'vp_dep_logo_text',
                                    ),
                                ),
                                array(
                                    'type' => 'slider',
                                    'name' => 'text_logo_size',
                                    'label' => __('Logo Size', 'wp_deeds'),
                                    'description' => __('select the size of logo text', 'wp_deeds'),
                                    'min' => '10',
                                    'max' => '100',
                                    'step' => '1',
                                    'default' => '24',
                                    'dependency' => array(
                                        'field' => 'logo_type',
                                        'function' => 'vp_dep_logo_text',
                                    ),
                                ),
                                array(
                                    'type' => 'slider',
                                    'name' => 'text_logo_margin',
                                    'label' => __('Logo Top Margin', 'wp_deeds'),
                                    'description' => __('select the top margin of logo text', 'wp_deeds'),
                                    'min' => '10',
                                    'max' => '100',
                                    'step' => '1',
                                    'default' => '20',
                                    'dependency' => array(
                                        'field' => 'logo_type',
                                        'function' => 'vp_dep_logo_text',
                                    ),
                                ),
                                array(
                                    'type' => 'color',
                                    'name' => 'text_logo_color',
                                    'label' => __('Logo Color', 'wp_deeds'),
                                    'description' => __('Choose the logo color', 'wp_deeds'),
                                    'default' => '#98ed28',
                                    'dependency' => array(
                                        'field' => 'logo_type',
                                        'function' => 'vp_dep_logo_text',
                                    ),
                                ),
                                array(
                                    'type' => 'select',
                                    'label' => __('Logo Font', 'wp_deeds'),
                                    'name' => 'text_logo_font',
                                    'description' => __('Select the font family to use for logo', 'wp_deeds'),
                                    'dependency' => array(
                                        'field' => 'logo_type',
                                        'function' => 'vp_dep_logo_text',
                                    ),
                                    'items' => array(
                                        'data' => array(
                                            array(
                                                'source' => 'function',
                                                'value' => 'vp_get_gwf_family',
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_header_email',
                            'label' => __('Header Email', 'wp_deeds'),
                            'description' => __('Turn Header Email On.', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'textbox',
                            'name' => 'header_email',
                            'label' => __('Email', 'wp_deeds'),
                            'description' => __('Enter Email to display in Header.', 'wp_deeds'),
                            'default' => '',
                            'dependency' => array(
                                'field' => 'show_header_email',
                                'function' => 'vp_dep_boolean',
                            ),
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_header_contact',
                            'label' => __('Header Contact #', 'wp_deeds'),
                            'description' => __('Turn Header Contact # On.', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'textbox',
                            'name' => 'header_contact',
                            'label' => __('Contact #', 'wp_deeds'),
                            'description' => __('Enter Contact # to display in Header.', 'wp_deeds'),
                            'default' => '',
                            'dependency' => array(
                                'field' => 'show_header_contact',
                                'function' => 'vp_dep_boolean',
                            ),
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_header_event',
                            'label' => __('Header Event', 'wp_deeds'),
                            'description' => __('Turn Header Event On.', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'select',
                            'name' => 'header_event',
                            'label' => __('Select Header Event', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'show_header_event',
                                'function' => 'vp_dep_boolean',
                            ),
                            'items' => array(
                                'data' => array(
                                    array(
                                        'source' => 'function',
                                        'value' => 'vp_get_posts_custom',
                                    ),
                                ),
                            ),
                            'default' => ''
                        ),
                        array(
                            'type' => 'textbox',
                            'name' => 'header_event_title',
                            'label' => __('Event Title', 'wp_deeds'),
                            'description' => __('Enter Event Title to display in Header.', 'wp_deeds'),
                            'default' => '',
                            'dependency' => array(
                                'field' => 'show_header_event',
                                'function' => 'vp_dep_boolean',
                            ),
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_header_cart',
                            'label' => __('Header Cart', 'wp_deeds'),
                            'description' => __('Turn Header Cart On.', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_header_sticky',
                            'label' => __('Header Sticky', 'wp_deeds'),
                            'description' => __('Turn Header Sticky On.', 'wp_deeds'),
                        ),
                        // Custom Header Style
                        array(
                            'type' => 'section',
                            'title' => __('Custom Headers', 'wp_deeds'),
                            'name' => 'custom_headers_section',
                            'dependency' => array(
                                'field' => 'header_option',
                                'function' => 'vp_dep_boolean',
                            ),
                            'fields' => array(
                                array(
                                    'type' => 'radioimage',
                                    'name' => 'custom_header',
                                    'label' => __('Choose Header', 'wp_deeds'),
                                    'item_max_height' => '150',
                                    'item_max_width' => '575',
                                    'items' => array(
                                        array(
                                            'value' => 'header1',
                                            'label' => __('Header Style 1', 'wp_deeds'),
                                            'img' => SH_URL . '/images/header1.jpg',
                                        ),
                                        array(
                                            'value' => 'header2',
                                            'label' => __('Header Style 2', 'wp_deeds'),
                                            'img' => SH_URL . '/images/header-2.jpg',
                                        ),
                                        array(
                                            'value' => 'header3',
                                            'label' => __('Header Style 3', 'wp_deeds'),
                                            'img' => SH_URL . '/images/header-3.jpg',
                                        ),
                                        array(
                                            'value' => 'header4',
                                            'label' => __('Header Style 4', 'wp_deeds'),
                                            'img' => SH_URL . '/images/header-4.jpg',
                                        ),
                                        array(
                                            'value' => 'header5',
                                            'label' => __('Header Style 5', 'wp_deeds'),
                                            'img' => SH_URL . '/images/header-5.jpg',
                                        ),
                                        array(
                                            'value' => 'header6',
                                            'label' => __('Header Style 6', 'wp_deeds'),
                                            'img' => SH_URL . '/images/header-6.jpg',
                                        ),
                                        array(
                                            'value' => 'header7',
                                            'label' => __('Header Style 7', 'wp_deeds'),
                                            'img' => SH_URL . '/images/header-7.jpg',
                                        ),
                                        array(
                                            'value' => 'header8',
                                            'label' => __('Header Style 8', 'wp_deeds'),
                                            'img' => SH_URL . '/images/header-8.jpg',
                                        ),
                                        array(
                                            'value' => 'header9',
                                            'label' => __('Header Style 9', 'wp_deeds'),
                                            'img' => SH_URL . '/images/header-9.jpg',
                                        ),
                                    ),
                                ),
                                array(
                                    'type' => 'toggle',
                                    'name' => 'header_social',
                                    'label' => __('Social icons', 'wp_deeds'),
                                    'description' => __('Show or Hide Social icons.', 'wp_deeds'),
                                    'default' => '',
                                ),
                            ),
                        ),
                        // responsive header settings
                        array(
                            'type' => 'section',
                            'title' => __('Responsive Header', 'wp_deeds'),
                            'name' => 'responsive_header',
                            'fields' => array(
                                array(
                                    'type' => 'select',
                                    'label' => __('Responsive Menu', 'wp_deeds'),
                                    'name' => 'select_res_menu',
                                    'description' => __('Select Menu for Responsive View', 'wp_deeds'),
                                    'items' => array(
                                        'data' => array(
                                            array(
                                                'source' => 'function',
                                                'value' => 'sh_get_all_menut',
                                            ),
                                        ),
                                    ),
                                    'default' => array(
                                        '{{first}}',
                                    ),
                                ),
                                array(
                                    'type' => 'select',
                                    'name' => 'logo_type_res',
                                    'label' => __('Logo Type', 'wp_deeds'),
                                    'description' => __('select the type of logo', 'wp_deeds'),
                                    'items' => array(
                                        array(
                                            'value' => 'image',
                                            'label' => __('Image', 'wp_deeds'),
                                        ),
                                        array(
                                            'value' => 'text',
                                            'label' => __('Text', 'wp_deeds'),
                                        ),
                                    ),
                                    'default' => array(
                                        '{{first}}',
                                    ),
                                ),
                                array(
                                    'type' => 'upload',
                                    'name' => 'logo_image_res',
                                    'label' => __('Logo Image', 'wp_deeds'),
                                    'description' => __('Upload the logo image', 'wp_deeds'),
                                    'default' => get_template_directory_uri() . '/images/logo.png',
                                    'dependency' => array(
                                        'field' => 'logo_type_res',
                                        'function' => 'vp_dep_logo_res',
                                    ),
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'text_logo_text_res',
                                    'label' => __('Logo Text', 'wp_deeds'),
                                    'description' => __('Enter the Logo Text.', 'wp_deeds'),
                                    'default' => '',
                                    'dependency' => array(
                                        'field' => 'logo_type_res',
                                        'function' => 'vp_dep_logo_text_res',
                                    ),
                                ),
                                array(
                                    'type' => 'slider',
                                    'name' => 'text_logo_size_res',
                                    'label' => __('Logo Size', 'wp_deeds'),
                                    'description' => __('select the size of logo text', 'wp_deeds'),
                                    'min' => '10',
                                    'max' => '100',
                                    'step' => '1',
                                    'default' => '24',
                                    'dependency' => array(
                                        'field' => 'logo_type_res',
                                        'function' => 'vp_dep_logo_text_res',
                                    ),
                                ),
                                array(
                                    'type' => 'slider',
                                    'name' => 'text_logo_margin_res',
                                    'label' => __('Logo Top Margin', 'wp_deeds'),
                                    'description' => __('select the top margin of logo text', 'wp_deeds'),
                                    'min' => '10',
                                    'max' => '100',
                                    'step' => '1',
                                    'default' => '20',
                                    'dependency' => array(
                                        'field' => 'logo_type_res',
                                        'function' => 'vp_dep_logo_text_res',
                                    ),
                                ),
                                array(
                                    'type' => 'color',
                                    'name' => 'text_logo_color_res',
                                    'label' => __('Logo Color', 'wp_deeds'),
                                    'description' => __('Choose the logo color', 'wp_deeds'),
                                    'default' => '#98ed28',
                                    'dependency' => array(
                                        'field' => 'logo_type_res',
                                        'function' => 'vp_dep_logo_text_res',
                                    ),
                                ),
                                array(
                                    'type' => 'select',
                                    'label' => __('Logo Font', 'wp_deeds'),
                                    'name' => 'text_logo_font_res',
                                    'description' => __('Select the font family to use for logo', 'wp_deeds'),
                                    'dependency' => array(
                                        'field' => 'logo_type_res',
                                        'function' => 'vp_dep_logo_text_res',
                                    ),
                                    'items' => array(
                                        'data' => array(
                                            array(
                                                'source' => 'function',
                                                'value' => 'vp_get_gwf_family',
                                            ),
                                        ),
                                    ),
                                ),
                                array(
                                    'type' => 'toggle',
                                    'name' => 'show_h_event',
                                    'label' => __('Show Event', 'wp_deeds'),
                                    'description' => __('Show or Hide event.', 'wp_deeds'),
                                ),
                                array(
                                    'type' => 'toggle',
                                    'name' => 'show_h_email',
                                    'label' => __('Show Email', 'wp_deeds'),
                                    'description' => __('Show or Hide email.', 'wp_deeds'),
                                ),
                                array(
                                    'type' => 'toggle',
                                    'name' => 'show_h_contact',
                                    'label' => __('Show Contact', 'wp_deeds'),
                                    'description' => __('Show or Hide contact.', 'wp_deeds'),
                                ),
                                array(
                                    'type' => 'toggle',
                                    'name' => 'show_h_search',
                                    'label' => __('Show Search', 'wp_deeds'),
                                    'description' => __('Show or Hide Search.', 'wp_deeds'),
                                ),
                                array(
                                    'type' => 'toggle',
                                    'name' => 'show_h_social',
                                    'label' => __('Show Social Media', 'wp_deeds'),
                                    'description' => __('Show or Hide social media.', 'wp_deeds'),
                                ),
                                array(
                                    'type' => 'toggle',
                                    'name' => 'show_h_cart',
                                    'label' => __('Show Social Cart', 'wp_deeds'),
                                    'description' => __('Show or Hide cart.', 'wp_deeds'),
                                ),
                            )
                        ),
                        // Custom HEader Style End
                        array(
                            'type' => 'codeeditor',
                            'name' => 'header_css',
                            'label' => __('Header CSS', 'wp_deeds'),
                            'description' => __('Write your custom css to include in header.', 'wp_deeds'),
                            'theme' => 'github',
                            'mode' => 'css',
                        ),
                    ),
                ),
                /** Submenu for footer area */
                array(
                    'title' => __('Footer Settings', 'wp_deeds'),
                    'name' => 'sub_footer_settings',
                    'icon' => 'font-awesome:fa fa-th-large',
                    'controls' => array(
                        array(
                            'type' => 'toggle',
                            'name' => 'show_footer',
                            'label' => __('Show Upper Footer', 'wp_deeds'),
                            'description' => __('enable this option to show footer upper section which holds widgets for footer.', 'wp_deeds'),
                            'default' => 1,
                        ),
                        array(
                            'type' => 'section',
                            'name' => 'main_footer_sect',
                            'label' => __('Footer Settings', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'show_footer',
                                'function' => 'vp_dep_boolean',
                            ),
                            'fields' => array(
                                array(
                                    'type' => 'builder',
                                    'repeating' => true,
                                    'sortable' => true,
                                    'label' => __('Dynamic Sidebar', 'wp_deeds'),
                                    'name' => 'footer_dynamic_sidebar',
                                    'description' => __('This section is used to add custom sidebar in footer', 'wp_deeds'),
                                    'fields' => array(
                                        array(
                                            'type' => 'textbox',
                                            'name' => 'footer_sidebar_name',
                                            'label' => __('Sidebar Name', 'wp_deeds'),
                                        ),
                                        array(
                                            'type' => 'select',
                                            'name' => 'footer_sidebar_column',
                                            'label' => __('Column', 'wp_deeds'),
                                            'default' => __('Select number of column to show widget in footer', 'wp_deeds'),
                                            'items' =>
                                            array(
                                                array('value' => 'col-md-6', 'label' => __('Two Columns', 'wp_deeds')),
                                                array('value' => 'col-md-4', 'label' => __('Three Columns', 'wp_deeds')),
                                                array('value' => 'col-md-3', 'label' => __('Four Columns', 'wp_deeds')),
                                                array('value' => 'col-md-2', 'label' => __('Six Columns', 'wp_deeds')),
                                            ),
                                            'default' => array('col-md-4'),
                                        ),
                                    ),
                                ),
                                array(
                                    'type' => 'upload',
                                    'title' => __('Footer Background', 'wp_deeds'),
                                    'name' => 'footer_background',
                                ),
                            ),
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_copyright',
                            'label' => __('Show copyright', 'wp_deeds'),
                            'default' => 1,
                        ),
                        array(
                            'type' => 'textarea',
                            'name' => 'copyright_text',
                            'label' => __('Copyright Text', 'wp_deeds'),
                            'description' => __('Enter the Copyright Text', 'wp_deeds'),
                            'default' => '',
                            'dependency' => array(
                                'field' => 'show_copyright',
                                'function' => 'vp_dep_boolean',
                            ),
                        ),
                        array(
                            'type' => 'codeeditor',
                            'name' => 'footer_analytics',
                            'label' => __('Footer Analytics / Scripts', 'wp_deeds'),
                            'description' => __('In this area you can put Google Analytics Code or any other Script that you want to be included in the footer before the Body tag.', 'wp_deeds'),
                            'theme' => 'twilight',
                            'mode' => 'javascript',
                        ),
                    )
                ), //End of submenu
                array(
                    'title' => __('Twitter Settings', 'wp_deeds'),
                    'name' => 'sub_twitter_settings',
                    'icon' => 'font-awesome:fa fa-th-large',
                    'controls' => array(
                        array(
                            'type' => 'textbox',
                            'name' => 'twitter_api',
                            'label' => __('API', 'wp_deeds'),
                            'description' => __('Enter Twitter API key Here.', 'wp_deeds'),
                            'default' => '',
                        ),
                        array(
                            'type' => 'textbox',
                            'name' => 'twitter_api_secret',
                            'label' => __('API Secret', 'wp_deeds'),
                            'description' => __('Enter Twitter API Secret Here.', 'wp_deeds'),
                            'default' => '',
                        ),
                        array(
                            'type' => 'textbox',
                            'name' => 'twitter_token',
                            'label' => __('Token', 'wp_deeds'),
                            'description' => __('Enter Twitter Token here.', 'wp_deeds'),
                            'default' => '',
                        ),
                        array(
                            'type' => 'textbox',
                            'name' => 'twitter_token_Secret',
                            'label' => __('Token Secret', 'wp_deeds'),
                            'description' => __('Enter Token Secret', 'wp_deeds'),
                            'default' => '',
                        ),
                    )
                ), //End of submenu
            ),
        ),
        // Pages , Blog Pages Settings
        array(
            'title' => __('Page Settings', 'wp_deeds'),
            'name' => 'general_settings',
            'icon' => 'font-awesome:fa fa-desktop',
            'menus' => array(
                // shop page settings
                array(
                    'title' => __('Shop Page Settings', 'wp_deeds'),
                    'name' => 'shop_page_settings',
                    'icon' => 'font-awesome:fa fa-th-large',
                    'controls' => array(
                        array(
                            'type' => 'select',
                            'name' => 'shop_page_sidebar',
                            'label' => __('Sidebar', 'wp_deeds'),
                            'items' => array(
                                'data' => array(
                                    array(
                                        'source' => 'function',
                                        'value' => 'sh_get_sidebars_2',
                                    ),
                                ),
                            ),
                            'default' => array(
                                '{{first}}',
                            ),
                        ),
                        array(
                            'type' => 'radiobutton',
                            'name' => 'shop_page_sidebar_position',
                            'label' => __('Sidebar Position', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'shop_page_sidebar',
                                'function' => 'vp_dep_boolean',
                            ),
                            'items' => array(
                                array(
                                    'value' => 'left',
                                    'label' => __('Left', 'wp_deeds'),
                                ),
                                array(
                                    'value' => 'right',
                                    'label' => __('Right', 'wp_deeds'),
                                ),
                            ),
                            'default' => array(
                                'left',
                            ),
                        ),
                    )
                ),
                // Search Page Settings
                array(
                    'title' => __('Search Page Settings', 'wp_deeds'),
                    'name' => 'search_page_settings',
                    'icon' => 'font-awesome:fa fa-th-large',
                    'controls' => array(
                        array(
                            'type' => 'toggle',
                            'name' => 'show_search_banner',
                            'label' => __('Show Banner', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'section',
                            'name' => 'search_banner_setting',
                            'label' => __('Page Banner Setting', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'show_search_banner',
                                'function' => 'vp_dep_boolean',
                            ),
                            'fields' => array(
                                array(
                                    'type' => 'textbox',
                                    'name' => 'search_page_title',
                                    'label' => __('Page Title', 'wp_deeds'),
                                    'description' => __('Enter the Title you want to show on Search page', 'wp_deeds'),
                                    'default' => 'Search Page',
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'search_page_subtitle',
                                    'label' => __('Page Subtitle', 'wp_deeds'),
                                    'description' => __('Enter subtitle, you want to show on Search page', 'wp_deeds'),
                                    'default' => 'Search Page Subtitle',
                                ),
                                array(
                                    'type' => 'upload',
                                    'name' => 'search_page_bg',
                                    'label' => __('Background  Image', 'wp_deeds'),
                                    'description' => __('Upload Image for Author Page Background', 'wp_deeds'),
                                    'default' => get_template_directory_uri() . '/images/logo.png'
                                ),
                            ),
                        ),
                        array(
                            'type' => 'select',
                            'name' => 'search_page_sidebar',
                            'label' => __('Sidebar', 'wp_deeds'),
                            'default' => '',
                            'items' => sh_get_sidebars(true)
                        ),
                        array(
                            'type' => 'radioimage',
                            'name' => 'search_page_sidebar_position',
                            'label' => __('Sidebar Position', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'search_page_sidebar',
                                'function' => 'vp_dep_boolean',
                            ),
                            'items' => array(
                                array(
                                    'value' => 'left',
                                    'label' => __('Left Sidebar', 'wp_deeds'),
                                    'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cl.png',
                                ),
                                array(
                                    'value' => 'right',
                                    'label' => __('Right Sidebar', 'wp_deeds'),
                                    'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cr.png',
                                ),
                            ),
                        ),
                    )
                ),
                // Category Page Settings
                array(
                    'title' => __('Category Page Settings', 'wp_deeds'),
                    'name' => 'category_page_settings',
                    'icon' => 'font-awesome:fa fa-th-large',
                    'controls' => array(
                        array(
                            'type' => 'toggle',
                            'name' => 'show_cat_banner',
                            'label' => __('Show Banner', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'section',
                            'name' => 'cat_banner_setting',
                            'label' => __('Page Banner Setting', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'show_cat_banner',
                                'function' => 'vp_dep_boolean',
                            ),
                            'fields' => array(
                                array(
                                    'type' => 'textbox',
                                    'name' => 'category_page_title',
                                    'label' => __('Page Title', 'wp_deeds'),
                                    'description' => __('Enter the Title you want to show on Author page', 'wp_deeds'),
                                    'default' => 'Category Page',
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'cat_page_subtitle',
                                    'label' => __('Page Subtitle', 'wp_deeds'),
                                    'description' => __('Enter subtitle, you want to show on Author page', 'wp_deeds'),
                                    'default' => 'Category Page Subtitle',
                                ),
                                array(
                                    'type' => 'upload',
                                    'name' => 'category_page_bg',
                                    'label' => __('Background  Image', 'wp_deeds'),
                                    'description' => __('Upload Image for Author Page Background', 'wp_deeds'),
                                    'default' => get_template_directory_uri() . '/images/logo.png'
                                ),
                            ),
                        ),
                        array(
                            'type' => 'select',
                            'name' => 'category_page_sidebar',
                            'label' => __('Sidebar', 'wp_deeds'),
                            'default' => '',
                            'items' => sh_get_sidebars(true)
                        ),
                        array(
                            'type' => 'radioimage',
                            'name' => 'category_page_sidebar_position',
                            'label' => __('Sidebar Position', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'category_page_sidebar',
                                'function' => 'vp_dep_boolean',
                            ),
                            'items' => array(
                                array(
                                    'value' => 'left',
                                    'label' => __('Left Sidebar', 'wp_deeds'),
                                    'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cl.png',
                                ),
                                array(
                                    'value' => 'right',
                                    'label' => __('Right Sidebar', 'wp_deeds'),
                                    'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cr.png',
                                ),
                            ),
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_category_date',
                            'label' => __('Show Date', 'wp_deeds'),
                            'default' => 1,
                        ),
                    )
                ),
                // Tag Page Settings
                array(
                    'title' => __('Tag Page Settings', 'wp_deeds'),
                    'name' => 'tag_page_settings',
                    'icon' => 'font-awesome:fa fa-th-large',
                    'controls' => array(
                        array(
                            'type' => 'toggle',
                            'name' => 'show_tag_banner',
                            'label' => __('Show Banner', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'section',
                            'name' => 'tag_banner_setting',
                            'label' => __('Page Banner Setting', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'show_tag_banner',
                                'function' => 'vp_dep_boolean',
                            ),
                            'fields' => array(
                                array(
                                    'type' => 'textbox',
                                    'name' => 'tag_page_title',
                                    'label' => __('Page Title', 'wp_deeds'),
                                    'description' => __('Enter the Title you want to show on Tag page', 'wp_deeds'),
                                    'default' => 'Tag Page',
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'tag_page_subtitle',
                                    'label' => __('Page Subtitle', 'wp_deeds'),
                                    'description' => __('Enter subtitle, you want to show on Tag page', 'wp_deeds'),
                                    'default' => 'Tag Page Subtitle',
                                ),
                                array(
                                    'type' => 'upload',
                                    'name' => 'tag_page_bg',
                                    'label' => __('Background  Image', 'wp_deeds'),
                                    'description' => __('Upload Image for Author Page Background', 'wp_deeds'),
                                    'default' => get_template_directory_uri() . '/images/logo.png'
                                ),
                            ),
                        ),
                        array(
                            'type' => 'select',
                            'name' => 'tag_page_sidebar',
                            'label' => __('Sidebar', 'wp_deeds'),
                            'default' => '',
                            'items' => sh_get_sidebars(true)
                        ),
                        array(
                            'type' => 'radioimage',
                            'name' => 'tag_page_sidebar_position',
                            'label' => __('Sidebar Position', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'tag_page_sidebar',
                                'function' => 'vp_dep_boolean',
                            ),
                            'items' => array(
                                array(
                                    'value' => 'left',
                                    'label' => __('Left Sidebar', 'wp_deeds'),
                                    'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cl.png',
                                ),
                                array(
                                    'value' => 'right',
                                    'label' => __('Right Sidebar', 'wp_deeds'),
                                    'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cr.png',
                                ),
                            ),
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_tag_date',
                            'label' => __('Show Date', 'wp_deeds'),
                            'default' => 1,
                        ),
                    )
                ),
                // Archive Page Settings
                array(
                    'title' => __('Archive Page Settings', 'wp_deeds'),
                    'name' => 'archive_page_settings',
                    'icon' => 'font-awesome:fa fa-th-large',
                    'controls' => array(
                        array(
                            'type' => 'toggle',
                            'name' => 'show_archive_banner',
                            'label' => __('Show Banner', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'section',
                            'name' => 'archive_banner_setting',
                            'label' => __('Page Banner Setting', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'show_archive_banner',
                                'function' => 'vp_dep_boolean',
                            ),
                            'fields' => array(
                                array(
                                    'type' => 'textbox',
                                    'name' => 'archive_page_title',
                                    'label' => __('Page Title', 'wp_deeds'),
                                    'description' => __('Enter the Title you want to show on Archive page', 'wp_deeds'),
                                    'default' => 'Archive Page Title',
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'archive_page_subtitle',
                                    'label' => __('Page Subtitle', 'wp_deeds'),
                                    'description' => __('Enter subtitle, you want to show on Archive page', 'wp_deeds'),
                                    'default' => 'Archive Page Subtitle',
                                ),
                                array(
                                    'type' => 'upload',
                                    'name' => 'archive_page_bg',
                                    'label' => __('Background Image', 'wp_deeds'),
                                    'description' => __('Upload Image for Archive Page Background', 'wp_deeds'),
                                    'default' => get_template_directory_uri() . '/images/logo.png'
                                ),
                            ),
                        ),
                        array(
                            'type' => 'select',
                            'name' => 'archive_page_sidebar',
                            'label' => __('Sidebar', 'wp_deeds'),
                            'default' => '',
                            'items' => sh_get_sidebars(true)
                        ),
                        array(
                            'type' => 'radioimage',
                            'name' => 'archive_page_sidebar_position',
                            'label' => __('Sidebar Position', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'archive_page_sidebar',
                                'function' => 'vp_dep_boolean',
                            ),
                            'items' => array(
                                array(
                                    'value' => 'left',
                                    'label' => __('Left Sidebar', 'wp_deeds'),
                                    'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cl.png',
                                ),
                                array(
                                    'value' => 'right',
                                    'label' => __('Right Sidebar', 'wp_deeds'),
                                    'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cr.png',
                                ),
                            ),
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_archive_date',
                            'label' => __('Show Date', 'wp_deeds'),
                            'default' => 1,
                        ),
                    )
                ),
                // Author Page Settings
                array(
                    'title' => __('Author Page Settings', 'wp_deeds'),
                    'name' => 'author_page_settings',
                    'icon' => 'font-awesome:fa fa-th-large',
                    'controls' => array(
                        array(
                            'type' => 'toggle',
                            'name' => 'show_author_banner',
                            'label' => __('Show Banner', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'section',
                            'name' => 'author_banner_setting',
                            'label' => __('Page Banner Setting', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'show_author_banner',
                                'function' => 'vp_dep_boolean',
                            ),
                            'fields' => array(
                                array(
                                    'type' => 'textbox',
                                    'name' => 'author_page_title',
                                    'label' => __('Page Title', 'wp_deeds'),
                                    'description' => __('Enter the Title you want to show on Author page', 'wp_deeds'),
                                    'default' => 'Author Posts',
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'author_page_subtitle',
                                    'label' => __('Page Subtitle', 'wp_deeds'),
                                    'description' => __('Enter subtitle, you want to show on Author page', 'wp_deeds'),
                                    'default' => 'Author Page Subtitle',
                                ),
                                array(
                                    'type' => 'upload',
                                    'name' => 'author_page_bg',
                                    'label' => __('Background  Image', 'wp_deeds'),
                                    'description' => __('Upload Image for Author Page Background', 'wp_deeds'),
                                    'default' => get_template_directory_uri() . '/images/logo.png'
                                ),
                            ),
                        ),
                        array(
                            'type' => 'select',
                            'name' => 'author_page_sidebar',
                            'label' => __('Sidebar', 'wp_deeds'),
                            'default' => '',
                            'items' => sh_get_sidebars(true)
                        ),
                        array(
                            'type' => 'radioimage',
                            'name' => 'author_page_sidebar_position',
                            'label' => __('Sidebar Position', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'author_page_sidebar',
                                'function' => 'vp_dep_boolean',
                            ),
                            'items' => array(
                                array(
                                    'value' => 'left',
                                    'label' => __('Left Sidebar', 'wp_deeds'),
                                    'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cl.png',
                                ),
                                array(
                                    'value' => 'right',
                                    'label' => __('Right Sidebar', 'wp_deeds'),
                                    'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cr.png',
                                ),
                            ),
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_author_date',
                            'label' => __('Show Date', 'wp_deeds'),
                            'default' => 1,
                        ),
                    )
                ),
                // 404 Page Settings
                array(
                    'title' => __('404 Page Settings', 'wp_deeds'),
                    'name' => '404_page_settings',
                    'icon' => 'font-awesome:fa fa-th-large',
                    'controls' => array(
                        array(
                            'type' => 'textbox',
                            'name' => '404_page_title',
                            'label' => __('Page Title', 'wp_deeds'),
                            'description' => __('Enter the Title you want to show on 404 page', 'wp_deeds'),
                            'default' => '404 Page not Found',
                        ),
                        array(
                            'type' => 'textbox',
                            'name' => '404_page_heading',
                            'label' => __('Page Heading', 'wp_deeds'),
                            'description' => __('Enter the Heading you want to show on 404 page', 'wp_deeds'),
                            'default' => '404 Page not Found',
                        ),
                        array(
                            'type' => 'textbox',
                            'name' => '404_page_tag_line',
                            'label' => __('Page Tagline', 'wp_deeds'),
                            'description' => __('Enter the Tagline you want to show on 404 page', 'wp_deeds'),
                            'default' => '404 Page not Found',
                        ),
                        array(
                            'type' => 'textarea',
                            'name' => '404_page_text',
                            'label' => __('404 Page Text', 'wp_deeds'),
                            'description' => __('Enter the Text you want to show on 404 page', 'wp_deeds'),
                            'default' => '',
                        ),
                        array(
                            'type' => 'upload',
                            'name' => '404_page_bg',
                            'label' => __('Background  Image', 'wp_deeds'),
                            'description' => __('Upload Image for 404 Page Background', 'wp_deeds'),
                            'default' => get_template_directory_uri() . '/images/logo.png'
                        ),
                    )
                ),
                // Blog Single Page Settings
                array(
                    'title' => __('Blog Single Settings', 'wp_deeds'),
                    'name' => 'single_settings',
                    'icon' => 'font-awesome:fa fa-th-large',
                    'controls' => array(
                        array(
                            'type' => 'toggle',
                            'name' => 'show_single_banner',
                            'label' => __('Show Banner', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'textbox',
                            'name' => 'single_subtitle',
                            'label' => __('Subtitle', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'show_single_banner',
                                'function' => 'vp_dep_boolean',
                            ),
                        ),
                        array(
                            'type' => 'upload',
                            'name' => 'single_banner_image',
                            'label' => __('Image', 'wp_deeds'),
                            'description' => __('Upload an image for background in page banner', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'show_single_banner',
                                'function' => 'vp_dep_boolean',
                            ),
                        ),
                        array(
                            'type' => 'select',
                            'name' => 'single_sidebar',
                            'label' => __('Sidebar', 'wp_deeds'),
                            'default' => '',
                            'items' => sh_get_sidebars(true)
                        ),
                        array(
                            'type' => 'radioimage',
                            'name' => 'single_layout',
                            'label' => __('Page Layout', 'wp_deeds'),
                            'description' => __('Choose the layout for blog pages', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'single_sidebar',
                                'function' => 'vp_dep_boolean',
                            ),
                            'items' => array(
                                array(
                                    'value' => 'left',
                                    'label' => __('Left Sidebar', 'wp_deeds'),
                                    'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cl.png',
                                ),
                                array(
                                    'value' => 'right',
                                    'label' => __('Right Sidebar', 'wp_deeds'),
                                    'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cr.png',
                                ),
                            ),
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_single_cat',
                            'label' => __('Show Category', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_single_author',
                            'label' => __('Show Author', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_single_date',
                            'label' => __('Show Date', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_single_tags',
                            'label' => __('Show Tags', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_single_sharing',
                            'label' => __('Show Social Sharing', 'wp_deeds'),
                        ),
                    ),
                ),
                // Single Sermon Page Settings
                array(
                    'title' => __('Single Sermon Settings', 'wp_deeds'),
                    'name' => 'single_sermon_settings',
                    'icon' => 'font-awesome:fa fa-th-large',
                    'controls' => array(
                        array(
                            'type' => 'toggle',
                            'name' => 'show_single_sermon_banner',
                            'label' => __('Show Page Banner', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'textbox',
                            'name' => 'single_sermon_subtitle',
                            'label' => __('Subtitle', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'show_single_sermon_banner',
                                'function' => 'vp_dep_boolean',
                            ),
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_single_sermon_breadcrumbs',
                            'label' => __('Show BreadCrumbs', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'upload',
                            'name' => 'single_sermon_banner_image',
                            'label' => __('Image', 'wp_deeds'),
                            'description' => __('Upload an image for background in page banner', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'show_single_sermon_banner',
                                'function' => 'vp_dep_boolean',
                            ),
                        ),
                        array(
                            'type' => 'select',
                            'name' => 'single_sermon_sidebar',
                            'label' => __('Sidebar', 'wp_deeds'),
                            'default' => '',
                            'items' => sh_get_sidebars(true)
                        ),
                        array(
                            'type' => 'radioimage',
                            'name' => 'single_sermon_layout',
                            'label' => __('Page Layout', 'wp_deeds'),
                            'description' => __('Choose the layout for blog pages', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'single_sermon_sidebar',
                                'function' => 'vp_dep_boolean',
                            ),
                            'items' => array(
                                array(
                                    'value' => 'left',
                                    'label' => __('Left Sidebar', 'wp_deeds'),
                                    'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cl.png',
                                ),
                                array(
                                    'value' => 'right',
                                    'label' => __('Right Sidebar', 'wp_deeds'),
                                    'img' => get_template_directory_uri() . '/framework/vafpress/public/img/2cr.png',
                                ),
                            ),
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_single_sermon_date',
                            'label' => __('Show Date', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_single_sermon_author',
                            'label' => __('Show Author', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_single_sermon_shareicon',
                            'label' => __('Show Share Icon', 'wp_deeds'),
                        ),
                    ),
                ),
            ),
        ),
        // Services Section
        array(
            'title' => __('Service Section', 'wp_deeds'),
            'name' => 'service_settings',
            'icon' => 'font-awesome:fa fa-cog',
            'controls' => array(
                array(
                    'type' => 'builder',
                    'repeating' => true,
                    'sortable' => true,
                    'label' => __('Service', 'wp_deeds'),
                    'name' => 'dynamic_services',
                    'description' => __('This section is used to add Services.', 'wp_deeds'),
                    'fields' => array(
                        array(
                            'type' => 'textbox',
                            'name' => 'service_title',
                            'label' => __('Title', 'wp_deeds'),
                            'description' => __('Enter Title for the Service.', 'wp_deeds'),
                            'default' => __('OUR PRAYERS', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'textbox',
                            'name' => 'service_link',
                            'label' => __('Link', 'wp_deeds'),
                            'default' => '#',
                        ),
                        array(
                            'type' => 'textbox',
                            'name' => 'btn_text',
                            'label' => __('Button Text', 'wp_deeds'),
                            'default' => 'GET INFORMATION',
                        ),
                        array(
                            'type' => 'textbox',
                            'name' => 'service_tag_line',
                            'label' => __('Tag Line', 'wp_deeds'),
                            'default' => 'Office Of Global Partnerships',
                        ),
                        array(
                            'type' => 'fontawesome',
                            'name' => 'srvices_social_icon',
                            'label' => __('Icon', 'wp_deeds'),
                            'description' => __('Choose Icon.', 'wp_deeds'),
                            'default' => '',
                        ),
                        array(
                            'type' => 'upload',
                            'name' => 'service_bg',
                            'label' => __('Background', 'wp_deeds'),
                            'description' => __('Upload Service Background.', 'wp_deeds'),
                        ),
                    ),
                ),
            )
        ),
        // Services Section
        array(
            'title' => __('Survey Box', 'wp_deeds'),
            'name' => 'survey_box',
            'icon' => 'font-awesome:fa fa-bullhorn',
            'controls' => array(
                array(
                    'type' => 'textbox',
                    'name' => 'survey_title',
                    'label' => __('Title', 'wp_deeds'),
                    'description' => __('Enter Title for this section.', 'wp_deeds'),
                ),
                array(
                    'type' => 'textarea',
                    'name' => 'survey_description',
                    'label' => __('Description', 'wp_deeds'),
                ),
                array(
                    'type' => 'textbox',
                    'name' => 'btn_text',
                    'label' => __('Button Text', 'wp_deeds'),
                    'default' => 'Read More',
                ),
                array(
                    'type' => 'textbox',
                    'name' => 'btn_link',
                    'label' => __('Button Link', 'wp_deeds'),
                    'default' => '#',
                ),
                array(
                    'type' => 'textbox',
                    'name' => 'servey_box_ammount',
                    'label' => __('Box Amount', 'wp_deeds'),
                ),
                array(
                    'type' => 'fontawesome',
                    'name' => 'servey_amnt_box_icn',
                    'label' => __('Icon', 'wp_deeds'),
                    'description' => __('Select Icon.', 'wp_deeds'),
                    'default' => '',
                ),
                array(
                    'type' => 'textbox',
                    'name' => 'servey_spent',
                    'label' => __('Spent Amount', 'wp_deeds'),
                ),
                array(
                    'type' => 'fontawesome',
                    'name' => 'servey_spent_box_icn',
                    'label' => __('Icon', 'wp_deeds'),
                    'description' => __('Select Icon.', 'wp_deeds'),
                    'default' => '',
                ),
                array(
                    'type' => 'textbox',
                    'name' => 'servey_project',
                    'label' => __('Project Amount', 'wp_deeds'),
                ),
                array(
                    'type' => 'fontawesome',
                    'name' => 'servey_project_box_icn',
                    'label' => __('Icon', 'wp_deeds'),
                    'description' => __('Select Icon.', 'wp_deeds'),
                    'default' => '',
                ),
            )
        ),
        // Services Section
        array(
            'title' => __('Pastors Message', 'wp_deeds'),
            'name' => 'pastors_settings',
            'icon' => 'font-awesome:fa fa-envelope',
            'controls' => array(
                array(
                    'type' => 'builder',
                    'repeating' => true,
                    'sortable' => true,
                    'label' => __('Pastors', 'wp_deeds'),
                    'name' => 'dynamic_pastors',
                    'description' => __('This section is used to add Pastor.', 'wp_deeds'),
                    'fields' => array(
                        array(
                            'type' => 'textbox',
                            'name' => 'pastor_name',
                            'label' => __('Pastors Name', 'wp_deeds'),
                            'description' => __('Enter name of the Pastor.', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'textbox',
                            'name' => 'pastor_design',
                            'label' => __('Pastors Designation', 'wp_deeds'),
                            'description' => __('Enter Pastor designation.', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'textarea',
                            'name' => 'pastor_msg',
                            'label' => __('Message', 'wp_deeds'),
                            'description' => __('Enter Message of the Pastors.', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'textbox',
                            'name' => 'pastor_vimeo',
                            'label' => __('Vimeo Video Code', 'wp_deeds'),
                            'description' => __('Enter vimeo video code.', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'upload',
                            'name' => 'pastor_audio',
                            'label' => __('Audio File', 'wp_deeds'),
                            'description' => __('Upload Audio File.', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'upload',
                            'name' => 'pastor_pdf',
                            'label' => __('PDF File', 'wp_deeds'),
                            'description' => __('Upload Pdf File.', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'textbox',
                            'name' => 'pastor_pdf_view',
                            'label' => __('PDF Link', 'wp_deeds'),
                            'description' => __('Enter the PDF Link if have', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'upload',
                            'name' => 'pastor_img',
                            'label' => __('Pastor img', 'wp_deeds'),
                            'description' => __('Upload Pastor image', 'wp_deeds'),
                        ),
                    ),
                ),
            )
        ),
        // Partners Section
        array(
            'title' => __('Partners', 'wp_deeds'),
            'name' => 'partners_settings',
            'icon' => 'font-awesome:fa fa-group',
            'controls' => array(
                array(
                    'type' => 'builder',
                    'repeating' => true,
                    'sortable' => true,
                    'label' => __('Partners', 'wp_deeds'),
                    'name' => 'dynamic_partners',
                    'description' => __('This section is used to add Partners.', 'wp_deeds'),
                    'fields' => array(
                        array(
                            'type' => 'textbox',
                            'name' => 'partner_link',
                            'label' => __('Pastors Link', 'wp_deeds'),
                            'description' => __('Enter Link of the Partner.', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'upload',
                            'name' => 'partner_img',
                            'label' => __('Image', 'wp_deeds'),
                            'description' => __('Upload image.', 'wp_deeds'),
                        ),
                    ),
                ),
            )
        ),
        // Donation Setting
        array(
            'title' => __('Donation Settings', 'wp_deeds'),
            'name' => 'donation_settings',
            'icon' => 'font-awesome:fa  fa-usd',
            'menus' => array(
                array(
                    'title' => __('Donation', 'wp_deeds'),
                    'name' => 'donation',
                    'icon' => 'font-awesome:fa fa-money',
                    'controls' => array(
                        array(
                            'type' => 'textbox',
                            'name' => 'donation_popup_title',
                            'label' => __('Donation PopUp Title', 'wp_deeds'),
                            'default' => '',
                        ),
                        array(
                            'type' => 'textbox',
                            'name' => 'donation_popup_sub_title',
                            'label' => __('Donation PopUp Sub Title', 'wp_deeds'),
                            'default' => '',
                        ),
                        array(
                            'type' => 'textbox',
                            'name' => 'donation_needed',
                            'label' => __('Donation Needed', 'wp_deeds'),
                            'default' => '',
                        ),
                        array(
                            'type' => 'textbox',
                            'name' => 'donation_collected',
                            'label' => __('Donation Collected', 'wp_deeds'),
                            'default' => '',
                        ),
                        array(
                            'type' => 'textbox',
                            'name' => 'currency_symbol',
                            'label' => __('Currency Symbol', 'wp_deeds'),
                            'default' => '',
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Currency Code', 'wp_deeds'),
                            'name' => 'currency_code',
                            'description' => __('Select the currency code', 'wp_deeds'),
                            'items' => sh_get_currencies(),
                        ),
                        array(
                            'type' => 'MultiSelect',
                            'name' => 'donation_periods',
                            'label' => __('Select Recuring Periods For PayPal', 'wp_deeds'),
                            'items' => array(
                                array(
                                    'value' => 'one_time',
                                    'label' => __('One Time', 'wp_deeds'),
                                ),
                                array(
                                    'value' => 'daily',
                                    'label' => __('Daily', 'wp_deeds'),
                                ),
                                array(
                                    'value' => 'weekly',
                                    'label' => __('Weekly', 'wp_deeds'),
                                ),
                                array(
                                    'value' => 'fortnightly',
                                    'label' => __('Fortnightly', 'wp_deeds'),
                                ),
                                array(
                                    'value' => 'monthly',
                                    'label' => __('Monthly', 'wp_deeds'),
                                ),
                                array(
                                    'value' => 'quarterly',
                                    'label' => __('Quarterly', 'wp_deeds'),
                                ),
                                array(
                                    'value' => 'half_year',
                                    'label' => __('Half Year', 'wp_deeds'),
                                ),
                                array(
                                    'value' => 'yearly',
                                    'label' => __('Yearly', 'wp_deeds'),
                                ),
                            ),
                        ),
                        array(
                            'type' => 'builder',
                            'repeating' => true,
                            'sortable' => true,
                            'label' => __('Dynamic Amount', 'wp_deeds'),
                            'name' => 'dynamic_amount',
                            'description' => __('This section is used for create dynamic donation amount builder', 'wp_deeds'),
                            'fields' => array(
                                array(
                                    'type' => 'textbox',
                                    'name' => 'dynamic_donation_amount',
                                    'label' => __('Enter Amount', 'wp_deeds'),
                                    'description' => __('Enter the amount.', 'wp_deeds'),
                                    'validation' => 'numeric',
                                ),
                            ),
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'paypal_info',
                            'label' => __('Enable PayPal', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'section',
                            'title' => __('PayPal Information', 'wp_deeds'),
                            'name' => 'paypal_info_section',
                            'dependency' => array(
                                'field' => 'paypal_info',
                                'function' => 'vp_dep_boolean',
                            ),
                            'fields' => array(
                                array(
                                    'type' => 'select',
                                    'label' => __('Paypal Type', 'wp_deeds'),
                                    'name' => 'paypal_type',
                                    'description' => __('Select the paypal type', 'wp_deeds'),
                                    'items' => array(array('value' => 'live', 'label' => 'Live'), array('value' => 'sandbox', 'label' => 'Sandbox'),),
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'paypal_api_email',
                                    'label' => __('Paypal Email', 'wp_deeds'),
                                    'description' => __('Enter the paypal Email', 'wp_deeds'),
                                    'default' => '',
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'paypal_api_username',
                                    'label' => __('Paypal API Username', 'wp_deeds'),
                                    'description' => __('Enter the paypal API username', 'wp_deeds'),
                                    'default' => '',
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'paypal_api_password',
                                    'label' => __('Paypal API Password', 'wp_deeds'),
                                    'description' => __('Enter the paypal API password', 'wp_deeds'),
                                    'default' => '',
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'paypal_api_signature',
                                    'label' => __('Paypal API Signature', 'wp_deeds'),
                                    'description' => __('Enter the paypal API signature', 'wp_deeds'),
                                    'default' => '',
                                ),
                            )
                        ),
                        // stripe options
                        array(
                            'type' => 'toggle',
                            'name' => 'stripe_info',
                            'label' => __('Enable Stripe', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'section',
                            'title' => __('Stripe Information', 'wp_deeds'),
                            'name' => 'stripe_info_section',
                            'dependency' => array(
                                'field' => 'stripe_info',
                                'function' => 'vp_dep_boolean',
                            ),
                            'fields' => array(
                                array(
                                    'type' => 'textbox',
                                    'name' => 'stripe_secret_key',
                                    'label' => __('Stripe Secret Key', 'wp_deeds'),
                                    'description' => __('Enter the Stripe secret key', 'wp_deeds'),
                                    'default' => '',
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'stripe_publishable_key',
                                    'label' => __('Stripe Publishable Key', 'wp_deeds'),
                                    'description' => __('Enter the Stripe publishable key', 'wp_deeds'),
                                    'default' => '',
                                ),
                            )
                        ),
                        // 2checkout options
                        array(
                            'type' => 'toggle',
                            'name' => 'checkout2_info',
                            'label' => __('Enable 2Checkout', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'section',
                            'title' => __('2Checkout Information', 'wp_deeds'),
                            'name' => 'checkout2_info_section',
                            'dependency' => array(
                                'field' => 'checkout2_info',
                                'function' => 'vp_dep_boolean',
                            ),
                            'fields' => array(
                                array(
                                    'type' => 'select',
                                    'label' => __('2Checkout Type', 'wp_deeds'),
                                    'name' => 'checkout2_type',
                                    'description' => __('Select the 2Checkout type', 'wp_deeds'),
                                    'items' => array(array('value' => 'false', 'label' => 'Live'), array('value' => 'true', 'label' => 'Sandbox'),),
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'checkout2_account_number',
                                    'label' => __('2Checkout Account Nummber', 'wp_deeds'),
                                    'description' => __('Enter 2Checkout Account Number', 'wp_deeds'),
                                    'default' => '',
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'checkout2_private_key',
                                    'label' => __('2Checkout Private Key', 'wp_deeds'),
                                    'description' => __('Enter the 2Checkout private key', 'wp_deeds'),
                                    'default' => '',
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'checkout2_publishable_key',
                                    'label' => __('2Checkout Publishable Key', 'wp_deeds'),
                                    'description' => __('Enter the 2Checkout publishable key', 'wp_deeds'),
                                    'default' => '',
                                ),
                            )
                        ),
                        // braintree options
                        array(
                            'type' => 'toggle',
                            'name' => 'braintree_info',
                            'label' => __('Enable Braintree', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'section',
                            'title' => __('Braintree Information', 'wp_deeds'),
                            'name' => 'braintree_info_section',
                            'dependency' => array(
                                'field' => 'braintree_info',
                                'function' => 'vp_dep_boolean',
                            ),
                            'fields' => array(
                                array(
                                    'type' => 'select',
                                    'label' => __('Braintree Type', 'wp_deeds'),
                                    'name' => 'braintree_type',
                                    'description' => __('Select the Braintree type', 'wp_deeds'),
                                    'items' => array(array('value' => 'live', 'label' => 'Live'), array('value' => 'sandbox', 'label' => 'Sandbox'),),
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'braintree_merchant_id',
                                    'label' => __('Braintree Merchant ID', 'wp_deeds'),
                                    'description' => __('Enter Braintree Merchant ID', 'wp_deeds'),
                                    'default' => '',
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'braintree_private_key',
                                    'label' => __('Braintree Private Key', 'wp_deeds'),
                                    'description' => __('Enter the Braintree private key', 'wp_deeds'),
                                    'default' => '',
                                ),
                                array(
                                    'type' => 'textbox',
                                    'name' => 'braintree_publishable_key',
                                    'label' => __('Braintree Publishable Key', 'wp_deeds'),
                                    'description' => __('Enter the Braintree publishable key', 'wp_deeds'),
                                    'default' => '',
                                ),
                            )
                        ),
                    ),
                ),
                array(
                    'title' => __('Donation Transactions', 'wp_deeds'),
                    'name' => 'donation_transactions',
                    'icon' => 'font-awesome:fa fa-shopping-cart',
                    'controls' => array(
                        array(
                            'type' => 'transaction',
                            'label' => __('Paypal Type', 'wp_deeds'),
                            'name' => 'paypal_types',
                            'description' => '',
                        ),
                    ),
                ),
            )
        ),
        // Sidebar Creator
        array(
            'title' => __('Sidebar Settings', 'wp_deeds'),
            'name' => 'sidebar-settings',
            'icon' => 'font-awesome:fa fa-columns',
            'controls' => array(
                array(
                    'type' => 'builder',
                    'repeating' => true,
                    'sortable' => true,
                    'label' => __('Dynamic Sidebar', 'wp_deeds'),
                    'name' => 'dynamic_sidebar',
                    'description' => __('This section is used for theme color settings', 'wp_deeds'),
                    'fields' => array(
                        array(
                            'type' => 'textbox',
                            'name' => 'sidebar_name',
                            'label' => __('Sidebar Name', 'wp_deeds'),
                            'description' => __('Choose the default color scheme for the theme.', 'wp_deeds'),
                            'default' => __('Dynamic Sidebar', 'wp_deeds'),
                        ),
                    ),
                ),
            )
        ),
        // Dynamic Social Media Creator
        array(
            'title' => __('Social Media ', 'wp_deeds'),
            'name' => 'social_media_section',
            'icon' => 'font-awesome:fa fa-share-alt',
            'controls' => array(
                array(
                    'type' => 'builder',
                    'repeating' => true,
                    'sortable' => true,
                    'label' => __('Social Media', 'wp_deeds'),
                    'name' => 'social_media',
                    'description' => __('This section is used to add Social Media.', 'wp_deeds'),
                    'fields' => array(
                        array(
                            'type' => 'textbox',
                            'name' => 'social_link',
                            'label' => __('Link', 'wp_deeds'),
                            'description' => __('Enter the Link for Social Media.', 'wp_deeds'),
                            'default' => __('#', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'fontawesome',
                            'name' => 'social_icon',
                            'label' => __('Icon', 'wp_deeds'),
                            'description' => __('Choose Icon for Social Media.', 'wp_deeds'),
                            'default' => '',
                        ),
                        array(
                            'type' => 'color',
                            'name' => 'social_btn_color',
                            'label' => __('Icon Color', 'vp_textdomain'),
                            'description' => __('set social media Icon color', 'vp_textdomain'),
                            'default' => '#f00',
                            'format' => 'rgb',
                        ),
                    ),
                ),
            )
        ),
        // language settings
        array(
            'title' => __('Languages', 'wp_deeds'),
            'name' => 'sh_language_settings',
            'icon' => 'font-awesome:fa fa-language',
            'controls' => array(
                array(
                    'type' => 'language',
                    'name' => 'sh_language_uploader',
                    'label' => __('Uploade Your .mo file:', 'wp_deeds'),
                    'description' => __('Please Upload Your .mo file.', 'wp_deeds'),
                ),
                array(
                    'type' => 'select',
                    'name' => 'sh_localize',
                    'label' => __('Select Language:', 'wp_deeds'),
                    'items' => array(
                        'data' => array(
                            array(
                                'source' => 'function',
                                'value' => 'fw_get_languages',
                            ),
                        ),
                    ),
                ),
            ),
        ),
        /* Font settings */
        array(
            'title' => __('Font Settings', 'wp_deeds'),
            'name' => 'font_settings',
            'icon' => 'font-awesome:fa fa-font',
            'menus' => array(
                /** heading font settings */
                array(
                    'title' => __('Heading Font', 'wp_deeds'),
                    'name' => 'heading_font_settings',
                    'icon' => 'font-awesome:fa fa-th-large',
                    'controls' => array(
                        array(
                            'type' => 'toggle',
                            'name' => 'use_custom_font',
                            'label' => __('Use Custom Font', 'wp_deeds'),
                            'description' => __('Use custom font or not', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'section',
                            'title' => __('H1 Settings', 'wp_deeds'),
                            'name' => 'h1_settings',
                            'description' => __('heading 1 font settings', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'use_custom_font',
                                'function' => 'vp_dep_boolean',
                            ),
                            'fields' => array(
                                array(
                                    'type' => 'select',
                                    'label' => __('Font Family', 'wp_deeds'),
                                    'name' => 'h1_font_family',
                                    'description' => __('Select the font family to use for h1', 'wp_deeds'),
                                    'items' => array(
                                        'data' => array(
                                            array(
                                                'source' => 'function',
                                                'value' => 'vp_get_gwf_family',
                                            ),
                                        ),
                                    ),
                                ),
                                array(
                                    'type' => 'color',
                                    'name' => 'h1_font_color',
                                    'label' => __('Font Color', 'wp_deeds'),
                                    'description' => __('Choose the font color for heading h1', 'wp_deeds'),
                                    'default' => '#98ed28',
                                ),
                            ),
                        ),
                        array(
                            'type' => 'section',
                            'title' => __('H2 Settings', 'wp_deeds'),
                            'name' => 'h2_settings',
                            'description' => __('heading h2 font settings', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'use_custom_font',
                                'function' => 'vp_dep_boolean',
                            ),
                            'fields' => array(
                                array(
                                    'type' => 'select',
                                    'label' => __('Font Family', 'wp_deeds'),
                                    'name' => 'h2_font_family',
                                    'description' => __('Select the font family to use for h2', 'wp_deeds'),
                                    'items' => array(
                                        'data' => array(
                                            array(
                                                'source' => 'function',
                                                'value' => 'vp_get_gwf_family',
                                            ),
                                        ),
                                    ),
                                ),
                                array(
                                    'type' => 'color',
                                    'name' => 'h2_font_color',
                                    'label' => __('Font Color', 'wp_deeds'),
                                    'description' => __('Choose the font color for heading h1', 'wp_deeds'),
                                    'default' => '#98ed28',
                                ),
                            ),
                        ),
                        array(
                            'type' => 'section',
                            'title' => __('H3 Settings', 'wp_deeds'),
                            'name' => 'h3_settings',
                            'description' => __('heading h3 font settings', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'use_custom_font',
                                'function' => 'vp_dep_boolean',
                            ),
                            'fields' => array(
                                array(
                                    'type' => 'select',
                                    'label' => __('Font Family', 'wp_deeds'),
                                    'name' => 'h3_font_family',
                                    'description' => __('Select the font family to use for h3', 'wp_deeds'),
                                    'items' => array(
                                        'data' => array(
                                            array(
                                                'source' => 'function',
                                                'value' => 'vp_get_gwf_family',
                                            ),
                                        ),
                                    ),
                                ),
                                array(
                                    'type' => 'color',
                                    'name' => 'h3_font_color',
                                    'label' => __('Font Color', 'wp_deeds'),
                                    'description' => __('Choose the font color for heading h3', 'wp_deeds'),
                                    'default' => '#98ed28',
                                ),
                            ),
                        ),
                        array(
                            'type' => 'section',
                            'title' => __('H4 Settings', 'wp_deeds'),
                            'name' => 'h4_settings',
                            'description' => __('heading h4 font settings', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'use_custom_font',
                                'function' => 'vp_dep_boolean',
                            ),
                            'fields' => array(
                                array(
                                    'type' => 'select',
                                    'label' => __('Font Family', 'wp_deeds'),
                                    'name' => 'h4_font_family',
                                    'description' => __('Select the font family to use for h4', 'wp_deeds'),
                                    'items' => array(
                                        'data' => array(
                                            array(
                                                'source' => 'function',
                                                'value' => 'vp_get_gwf_family',
                                            ),
                                        ),
                                    ),
                                ),
                                array(
                                    'type' => 'color',
                                    'name' => 'h4_font_color',
                                    'label' => __('Font Color', 'wp_deeds'),
                                    'description' => __('Choose the font color for heading h4', 'wp_deeds'),
                                    'default' => '#98ed28',
                                ),
                            ),
                        ),
                        array(
                            'type' => 'section',
                            'title' => __('H5 Settings', 'wp_deeds'),
                            'name' => 'h5_settings',
                            'description' => __('heading h5 font settings', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'use_custom_font',
                                'function' => 'vp_dep_boolean',
                            ),
                            'fields' => array(
                                array(
                                    'type' => 'select',
                                    'label' => __('Font Family', 'wp_deeds'),
                                    'name' => 'h5_font_family',
                                    'description' => __('Select the font family to use for h5', 'wp_deeds'),
                                    'items' => array(
                                        'data' => array(
                                            array(
                                                'source' => 'function',
                                                'value' => 'vp_get_gwf_family',
                                            ),
                                        ),
                                    ),
                                ),
                                array(
                                    'type' => 'color',
                                    'name' => 'h5_font_color',
                                    'label' => __('Font Color', 'wp_deeds'),
                                    'description' => __('Choose the font color for heading h5', 'wp_deeds'),
                                    'default' => '#98ed28',
                                ),
                            ),
                        ),
                        array(
                            'type' => 'section',
                            'title' => __('H6 Settings', 'wp_deeds'),
                            'name' => 'h6_settings',
                            'description' => __('heading h6 font settings', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'use_custom_font',
                                'function' => 'vp_dep_boolean',
                            ),
                            'fields' => array(
                                array(
                                    'type' => 'select',
                                    'label' => __('Font Family', 'wp_deeds'),
                                    'name' => 'h6_font_family',
                                    'description' => __('Select the font family to use for h6', 'wp_deeds'),
                                    'items' => array(
                                        'data' => array(
                                            array(
                                                'source' => 'function',
                                                'value' => 'vp_get_gwf_family',
                                            ),
                                        ),
                                    ),
                                ),
                                array(
                                    'type' => 'color',
                                    'name' => 'h6_font_color',
                                    'label' => __('Font Color', 'wp_deeds'),
                                    'description' => __('Choose the font color for heading h6', 'wp_deeds'),
                                    'default' => '#98ed28',
                                ),
                            ),
                        ),
                    )
                ),
                /** body font settings */
                array(
                    'title' => __('Body Font', 'wp_deeds'),
                    'name' => 'body_font_settingss',
                    'icon' => 'font-awesome:fa fa-th-large',
                    'controls' => array(
                        array(
                            'type' => 'toggle',
                            'name' => 'body_custom_fonts',
                            'label' => __('Use Custom Font', 'wp_deeds'),
                            'description' => __('Use custom font or not', 'wp_deeds'),
                        ),
                        array(
                            'type' => 'section',
                            'title' => __('Body Font Settings', 'wp_deeds'),
                            'name' => 'body_font_settings',
                            'description' => __('body font settings', 'wp_deeds'),
                            'dependency' => array(
                                'field' => 'body_custom_fonts',
                                'function' => 'vp_dep_boolean',
                            ),
                            'fields' => array(
                                array(
                                    'type' => 'select',
                                    'label' => __('Font Family', 'wp_deeds'),
                                    'name' => 'body_font_family',
                                    'description' => __('Select the font family to use for body', 'wp_deeds'),
                                    'items' => array(
                                        'data' => array(
                                            array(
                                                'source' => 'function',
                                                'value' => 'vp_get_gwf_family',
                                            ),
                                        ),
                                    ),
                                ),
                                array(
                                    'type' => 'color',
                                    'name' => 'body_font_color',
                                    'label' => __('Font Color', 'wp_deeds'),
                                    'description' => __('Choose the font color for heading body', 'wp_deeds'),
                                    'default' => '#98ed28',
                                ),
                            ),
                        ),
                    )
                )
            )
        ),
    /* Font settings */
//        array(
//            'title' => __('Update Settings', 'wp_deeds'),
//            'name' => 'update_settings',
//            'icon' => 'font-awesome:fa fa-cloud',
//            'controls' => array(
//                array(
//                    'type' => 'textbox',
//                    'name' => 'purchase_code',
//                    'label' => __('Purchase Code:', 'wp_deeds'),
//                    'description' => __('Enter Your Purchase Code.', 'wp_deeds'),
//                ),
//                array(
//                    'type' => 'toggle',
//                    'name' => 'xml_update_notifier',
//                    'label' => __('Update Notifier:', 'wp_deeds'),
//                    'description' => __('Show update notifier, when update is available.', 'wp_deeds'),
//                ),
//                array(
//                    'type' => 'select',
//                    'name' => 'update_xml_notifier',
//                    'label' => __('Select Hour:', 'wp_deeds'),
//                    'description' => __('Select the hour to perform automatic update every selected hour.', 'wp_deeds'),
//                    'items' => array(
//                        'data' => array(
//                            array(
//                                'source' => 'function',
//                                'value' => 'sh_houre_range',
//                            ),
//                        ),
//                    ),
//                    'default' => array(
//                        '{{first}}',
//                    ),
//                    'dependency' => array(
//                        'field' => 'xml_update_notifier',
//                        'function' => 'vp_dep_boolean',
//                    ),
//                ),
//                array(
//                    'type' => 'toggle',
//                    'name' => 'update_notice',
//                    'label' => __('Show Update Bar:', 'wp_deeds'),
//                    'description' => __('Show or hide update bar.', 'wp_deeds'),
//                ),
//                array(
//                    'type' => 'notebox',
//                    'name' => 'notebox_backup',
//                    'label' => __('Note:', 'wp_deeds'),
//                    'description' => __('This section is use to Enable/Disable to create backup and delete old backup before theme update process each time.', 'wp_deeds'),
//                    'status' => 'info',
//                ),
//                array(
//                    'type' => 'toggle',
//                    'name' => 'create_backup',
//                    'label' => __('Backup:', 'wp_deeds'),
//                    'description' => __('Create backup or not before update.', 'wp_deeds'),
//                ),
//                array(
//                    'type' => 'toggle',
//                    'name' => 'delete_old_backup',
//                    'label' => __('Delete Backup:', 'wp_deeds'),
//                    'description' => __('Delete old backup files.', 'wp_deeds'),
//                ),
//                array(
//                    'type' => 'notebox',
//                    'name' => 'notebox',
//                    'label' => __('Note:', 'wp_deeds'),
//                    'description' => __('When you will update theme your all customization in the current theme will be lossed. So Please make sure you have enable backup option before update your theme.', 'wp_deeds'),
//                    'status' => 'info',
//                ),
//                array(
//                    'type' => 'button',
//                    'name' => 'update_button',
//                    'label' => __('Update Theme', 'wp_deeds'),
//                    'description' => __('Update your theme to latest version.', 'wp_deeds'),
//                ),
//            )
//        ),
    )
);

/**
 *EOF
 */
