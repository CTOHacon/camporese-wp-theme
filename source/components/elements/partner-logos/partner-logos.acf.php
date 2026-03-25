<?php

createACFBlock(
	[
		'name'          => 'partner-logos',
		'title'         => 'Partner Logos',
		'category'      => 'theme-blocks',
		'icon'          => 'awards',
		'mode'          => 'preview',
		'supports'      => ['align' => false],
		'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'partner-logos/*.png')),
	],
	[
		['key' => 'field_tab_partner_logos_content', 'label' => 'Content', 'type' => 'tab'],
		[
			'key'          => 'field_partner_logos_items',
			'label'        => 'Logos',
			'name'         => 'partner_logos_items',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Add Logo',
			'instructions' => 'Leave empty to use logos from Reviews Settings → Proved By Platforms.',
			'sub_fields'   => [
				[
					'key'           => 'field_partner_logos_item_logo_dark',
					'label'         => 'Logo',
					'name'          => 'logo_dark',
					'type'          => 'image',
					'return_format' => 'id',
				],
				[
					'key'   => 'field_partner_logos_item_link',
					'label' => 'Link',
					'name'  => 'link',
					'type'  => 'text',
				],
			],
		],
		['key' => 'field_tab_partner_logos_layouting', 'label' => 'Layouting', 'type' => 'tab'],
		get_acf_margin_select_field(),
	],
	function ($fields, $context) {
		component_partner_logos(
			['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
			$fields
		);
	}
);
