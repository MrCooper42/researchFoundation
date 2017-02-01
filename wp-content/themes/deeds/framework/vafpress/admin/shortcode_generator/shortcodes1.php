<?php

return array(

	'Showcase' => array(
		'elements'=> array(

			'all_controls' => array(
				'title'   => 'All Controls',
				'code'    => '[controls][/controls]',
				'attributes' => array(
					array(
						'name'                       => 'wpeditor',
						'type'                       => 'wpeditor',
						'label'                      => __('WP Visual Editor', 'wp_deeds'),
						'use_external_plugins'       => 1,
						'disabled_externals_plugins' => 'vp_sc_button',
						'disabled_internals_plugins' => '',
					),
					array(
						'name'  => 'radiobutton',
						'type'  => 'radiobutton',
						'label' => __('Radio Button', 'wp_deeds'),
						'items' => array(
							array(
								'value' => 'value_1',
								'label' => 'Value 1'
							),
							array(
								'value' => 'value_2',
								'label' => 'Value 2'
							),
							array(
								'value' => 'value_3',
								'label' => 'Value 3'
							),
						),
					),
					array(
						'name'  => 'checkbox',
						'type'  => 'checkbox',
						'label' => __('Checkbox', 'wp_deeds'),
						'items' => array(
							array(
								'value' => 'value_1',
								'label' => 'Value 1'
							),
							array(
								'value' => 'value_2',
								'label' => 'Value 2'
							),
							array(
								'value' => 'value_3',
								'label' => 'Value 3'
							),
						),
						'default' => array('{{first}}')
					),
					array(
						'name'  => 'select',
						'type'  => 'select',
						'label' => __('Select', 'wp_deeds'),
						'items' => array(
							array(
								'value' => 'value_1',
								'label' => 'Value 1'
							),
							array(
								'value' => 'value_2',
								'label' => 'Value 2'
							),
							array(
								'value' => 'value_3',
								'label' => 'Value 3'
							),
						),
					),
					array(
						'name'  => 'fontawesome',
						'type'  => 'fontawesome',
						'label' => __('Fontawesome Icon', 'wp_deeds'),
					),
					array(
						'name'  => 'multiselect',
						'type'  => 'multiselect',
						'label' => __('Multiselect', 'wp_deeds'),
						'items' => array(
							array(
								'value' => 'value_1',
								'label' => 'Value 1'
							),
							array(
								'value' => 'value_2',
								'label' => 'Value 2'
							),
							array(
								'value' => 'value_3',
								'label' => 'Value 3'
							),
						),
						'default' => array('{{first}}')
					),
					array(
						'name'  => 'color',
						'type'  => 'color',
						'label' => __('Color', 'wp_deeds'),
						'default' => '#00FF00',
					),
					array(
						'name'  => 'sorter',
						'type'  => 'sorter',
						'label' => __('Sorter', 'wp_deeds'),
						'items' => array(
							array(
								'value' => 'value_1',
								'label' => 'Value 1'
							),
							array(
								'value' => 'value_2',
								'label' => 'Value 2'
							),
							array(
								'value' => 'value_3',
								'label' => 'Value 3'
							),
						),
						'default' => array('{{first}}')
					),
					array(
						'name'  => 'slider',
						'type'  => 'slider',
						'label' => __('Slider', 'wp_deeds'),
						'default' => '20',
						'min' => 5,
						'max' => 50,
					),
					array(
						'name'  => 'upload',
						'type'  => 'upload',
						'label' => __('Upload', 'wp_deeds'),
					),
					array(
						'name'  => 'date',
						'type'  => 'date',
						'label' => __('Date', 'wp_deeds'),
					),
					array(
						'name'  => 'textarea',
						'type'  => 'textarea',
						'label' => __('Textarea', 'wp_deeds'),
						'default' => 'test',
					),
					array(
						'name'  => 'checkimage',
						'type'  => 'checkimage',
						'label' => __('Check Image', 'wp_deeds'),
						'items' => array(
							array(
								'value' => 'value_1',
								'label' => __('Label 1', 'wp_deeds'),
								'img' => 'http://placehold.it/100x100',
							),
							array(
								'value' => 'value_2',
								'label' => __('Label 2', 'wp_deeds'),
								'img' => 'http://placehold.it/120x80',
							),
							array(
								'value' => 'value_3',
								'label' => __('Label 3', 'wp_deeds'),
								'img' => 'http://placehold.it/80x120',
							),
							array(
								'value' => 'value_4',
								'label' => __('Label 4', 'wp_deeds'),
								'img' => 'http://placehold.it/50x50',
							),
						),
						'default' => array('{{first}}', '{{last}}'),
					),
					array(
						'name'  => 'radioimage',
						'type'  => 'radioimage',
						'label' => __('Radio Image', 'wp_deeds'),
						'items' => array(
							array(
								'value' => 'value_1',
								'label' => __('Label 1', 'wp_deeds'),
								'img'   => 'http://placehold.it/100x100',
							),
							array(
								'value' => 'value_2',
								'label' => __('Label 2', 'wp_deeds'),
								'img'   => 'http://placehold.it/120x80',
							),
							array(
								'value' => 'value_3',
								'label' => __('Label 3', 'wp_deeds'),
								'img'   => 'http://placehold.it/80x120',
							),
							array(
								'value' => 'value_4',
								'label' => __('Label 4', 'wp_deeds'),
								'img'   => 'http://placehold.it/50x50',
							),
						),
						'default' => array('{{first}}'),
					),
					array(
						'name'  => 'codeeditor',
						'type'  => 'codeeditor',
						'label' => __('Code Editor', 'wp_deeds'),
						'default' => 'test',
					),
					array(
						'name'  => 'toggle',
						'type'  => 'toggle',
						'label' => __('Toggle', 'wp_deeds'),
					),
				)
			),

		),
	),

	'Layout System' => array(
		'elements' => array(

			'section'  => array(
				'title' => 'Section',
				'code'  => '[section][/section]',
				'attributes' => array(
					array(
						'name'  => 'accent',
						'type'  => 'select',
						'label' => __('Color Accent', 'wp_deeds'),
						'items' => array(
							array(
								'value' => 'standard',
								'label' => 'Standard Color Accent'
							),
							array(
								'value' => 'alternative_1',
								'label' => 'Alternative 1 Color Accent'
							),
							array(
								'value' => 'alternative_2',
								'label' => 'Alternative 2 Color Accent'
							),
							array(
								'value' => 'alternative_3',
								'label' => 'Alternative 3 Color Accent'
							),
							array(
								'value' => 'alternative_4',
								'label' => 'Alternative 4 Color Accent'
							),
						),
					),
					array(
						'name'  => 'background_image_url',
						'type'  => 'upload',
						'label' => __('Background Image URL', 'wp_deeds'),
					),
					array(
						'name'  => 'background_image_repeat',
						'type'  => 'select',
						'label' => __('Background Image Repeat', 'wp_deeds'),
						'items' => array(
							array(
								'value' => 'repeat-x',
								'label' => 'repeat-x'
							),
							array(
								'value' => 'repeat-y',
								'label' => 'repeat-y'
							),
							array(
								'value' => 'no-repeat',
								'label' => 'no-repeat'
							),
						),
					),
					array(
						'name'  => 'background_image_attachment',
						'type'  => 'select',
						'label' => __('Background Image Attachment', 'wp_deeds'),
						'items' => array(
							array(
								'value' => 'scroll',
								'label' => 'scroll'
							),
							array(
								'value' => 'fixed',
								'label' => 'fixed'
							),
							array(
								'value' => 'inherit',
								'label' => 'inherit'
							),
						),
					),
					array(
						'name'  => 'background_image_position',
						'type'  => 'select',
						'label' => __('Background Image Position', 'wp_deeds'),
						'items' => array(
							array(
								'value' => 'top left',
								'label' => 'top left'
							),
							array(
								'value' => 'top center',
								'label' => 'top center'
							),
							array(
								'value' => 'top right',
								'label' => 'top right'
							),
							array(
								'value' => 'center left',
								'label' => 'center left'
							),
							array(
								'value' => 'center center',
								'label' => 'center center'
							),
							array(
								'value' => 'center right',
								'label' => 'center right'
							),
							array(
								'value' => 'bottom left',
								'label' => 'bottom left'
							),
							array(
								'value' => 'bottom center',
								'label' => 'bottom center'
							),
							array(
								'value' => 'bottom right',
								'label' => 'bottom right'
							),
						),
					),
					array(
						'name'  => 'background_image_size',
						'type'  => 'select',
						'label' => __('Background Image Size', 'wp_deeds'),
						'items' => array(
							array(
								'value' => 'cover',
								'label' => 'cover'
							),
							array(
								'value' => 'contain',
								'label' => 'contain'
							),
						),
					),
				),
			),
			'grid'  => array(
				'title' => 'Grid',
				'code'  => '[grid][/grid]',
				'attributes' => array(
					array(
						'name'  => 'col',
						'type'  => 'slider',
						'label' => __('Column', 'wp_deeds'),
						'min'   => 1,
						'max'   => 12,
					),
					array(
						'name'  => 'offset',
						'type'  => 'slider',
						'label' => __('Offset', 'wp_deeds'),
						'min'   => 0,
						'max'   => 11,
					),
				),
			),

		)
	),

	'Elements' => array(
		'elements'=> array(

			'button' => array(
				'title'   => 'Button',
				'code'    => '[button][/button]',
				'attributes' => array(
					array(
						'name'  => 'accent',
						'type'  => 'select',
						'label' => __('Color Accent', 'wp_deeds'),
						'items' => array(
							array(
								'value' => 'standard',
								'label' => 'Standard Color Accent'
							),
							array(
								'value' => 'alternative_1',
								'label' => 'Alternative 1 Color Accent'
							),
							array(
								'value' => 'alternative_2',
								'label' => 'Alternative 2 Color Accent'
							),
							array(
								'value' => 'alternative_3',
								'label' => 'Alternative 3 Color Accent'
							),
							array(
								'value' => 'alternative_4',
								'label' => 'Alternative 4 Color Accent'
							),
						),
						'default' => array('{{first}}')
					),
					array(
						'name'  => 'text_color',
						'type'  => 'color',
						'label' => __('Text Color', 'wp_deeds'),
					),
					array(
						'name'  => 'background_color',
						'type'  => 'color',
						'label' => __('Background Color', 'wp_deeds'),
					),
					array(
						'name'  => 'url',
						'type'  => 'textbox',
						'label' => __('Button URL', 'wp_deeds'),
					),
				)
			),

			'list' => array(
				'title' => 'List',
				'code'  => '[list][li icon="" color=""]Item 1[/li][li icon="icon-ok" color=""]Item 2[/li][li icon="icon-remove" color=""]Item 3[/li][/list]',
			),

			'icon' => array(
				'title'   => 'Icon',
				'code'    => '[icon][/icon]',
				'attributes' => array(
					array(
						'name'  => 'size',
						'type'  => 'select',
						'label' => __('Size', 'wp_deeds'),
						'items' => array(
							array(
								'value' => 'small',
								'label' => 'small'
							),
							array(
								'value' => 'medium',
								'label' => 'medium'
							),
							array(
								'value' => 'large',
								'label' => 'large'
							),
						),
					),
					array(
						'name'  => 'name',
						'type'  => 'fontawesome',
						'label' => __('Icon name', 'wp_deeds'),
					),
				)
			),

			'pricing_table' => array(
				'title' => 'Pricing Table',
				'code'  => '[pricing_table][/pricing_table]',
			),

			'pricing_column' => array(
				'title'   => 'Pricing Column',
				'code'    => '[pricing_column][/pricing_column]',
				'attributes' => array(
					array(
						'name'  => 'color_accent',
						'type'  => 'select',
						'label' => __('Color Accent', 'wp_deeds'),
						'items' => array(
							array(
								'value' => 'small',
								'label' => 'small'
							),
							array(
								'value' => 'medium',
								'label' => 'medium'
							),
							array(
								'value' => 'large',
								'label' => 'large'
							),
						),
					),
					array(
						'name'  => 'name',
						'type'  => 'fontawesome',
						'label' => __('Icon name', 'wp_deeds'),
					),
				)
			),

		),
	),

	'Media Embeds' => array(
		'elements' => array(

			'youtube' => array(
				'title'   => 'Youtube',
				'code'    => '[youtube][/youtube]',
				'attributes' => array(
					array(
						'name'  => 'id',
						'label' => __('ID', 'wp_deeds'),
						'type'  => 'textbox'
					),
					array(
						'name'  => 'width',
						'label' => __('Width', 'wp_deeds'),
						'type'  => 'textbox'
					),
					array(
						'name'  => 'height',
						'label' => __('Height', 'wp_deeds'),
						'type'  => 'textbox'
					),
				)
			),
			'vimeo' => array(
				'title'   => 'Vimeo',
				'code'    => '[vimeo][/vimeo]',
				'attributes' => array(
					array(
						'name'  => 'id',
						'label' => __('ID', 'wp_deeds'),
						'type'  => 'textbox'
					),
					array(
						'name'  => 'width',
						'label' => __('Width', 'wp_deeds'),
						'type'  => 'textbox'
					),
					array(
						'name'  => 'height',
						'label' => __('Height', 'wp_deeds'),
						'type'  => 'textbox'
					),
				)
			),
			'soundcloud' => array(
				'title'   => 'Soundcloud',
				'code'    => '[soundcloud][/soundcloud]',
				'attributes' => array(
					array(
						'name'  => 'url',
						'label' => __('URL', 'wp_deeds'),
						'type'  => 'textbox'
					),
					array(
						'name'  => 'width',
						'label' => __('Width', 'wp_deeds'),
						'type'  => 'textbox'
					),
					array(
						'name'  => 'height',
						'label' => __('Height', 'wp_deeds'),
						'type'  => 'textbox'
					),
					array(
						'name'  => 'color',
						'label' => __('Height', 'wp_deeds'),
						'type'  => 'color'
					),
					array(
						'name'  => 'auto_play',
						'label' => __('Autoplay', 'wp_deeds'),
						'type'  => 'toggle'
					),
					array(
						'name'  => 'show_comments',
						'label' => __('Show Comments', 'wp_deeds'),
						'type'  => 'toggle'
					),
				)
			),

		)
	)

);

/**
 * EOF
 */