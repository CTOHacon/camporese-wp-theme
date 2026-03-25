<?php

acf_add_options_sub_page([
	'page_title'  => 'Hero Buttons',
	'menu_title'  => 'Hero Buttons',
	'parent_slug' => 'theme-parts',
	'menu_slug'   => 'theme-parts-hero-buttons',
]);

acf_add_local_field_group([
	'key'      => 'group_theme_parts_hero_buttons',
	'title'    => 'Theme Parts - Typical Hero Buttons',
	'fields'   => [
		[
			'key'          => 'field_typical_hero_buttons',
			'label'        => 'Typical Hero Buttons',
			'name'         => 'field_typical_hero_buttons',
			'type'         => 'repeater',
			'layout'       => 'row',
			'button_label' => 'Add Button',
			'instructions' => 'Default buttons used across hero sections. Can be overridden per page.',
			'sub_fields'   => [
				[
					'key'           => 'field_thb_theme',
					'name'          => 'theme',
					'label'         => 'Theme',
					'type'          => 'select',
					'choices'       => [
						'solid-blue'      => 'Solid Blue',
						'solid-dark-blue' => 'Solid Dark Blue',
					],
					'default_value' => 'solid-blue',
				],
				[
					'key'   => 'field_thb_text',
					'name'  => 'text',
					'label' => 'Text',
					'type'  => 'text',
				],
				[
					'key'   => 'field_thb_link',
					'name'  => 'link',
					'label' => 'Link',
					'type'  => 'text',
				],
			],
		],
	],
	'location' => [
		[
			[
				'param'    => 'options_page',
				'operator' => '==',
				'value'    => 'theme-parts-hero-buttons',
			],
		],
	],
]);
