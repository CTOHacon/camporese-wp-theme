<?php

createACFBlock(
	[
		'name'          => 'preheader-badge',
		'title'         => 'Preheader Badge',
		'category'      => 'theme-blocks',
		'icon'          => 'tag',
		'mode'          => 'preview',
		'parent'        => [
			'acf/content-block'
		],
		'supports'      => [
			'align' => false,
		],
		'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'preheader-badge/*.png')),
	],
	[
		[
			'key'           => 'field_phb_tagname',
			'name'          => 'tagname',
			'label'         => 'Tag Name',
			'type'          => 'select',
			'choices'       => [
				'span' => 'Span',
				'div'  => 'Div',
			],
			'default_value' => 'span',
			'wrapper'       => ['width' => 30],
		],
		[
			'key'           => 'field_phb_theme',
			'name'          => 'theme',
			'label'         => 'Theme',
			'type'          => 'select',
			'choices'       => [
				'green' => 'Green',
			],
			'default_value' => 'green',
			'wrapper'       => ['width' => 30],
		],
		[
			'key'   => 'field_phb_slot',
			'name'  => 'slot',
			'label' => 'Content',
			'type'  => 'text',
		],
	],
	function ($fields, $context) {
		component_preheader_badge(
			[
				'class' => [
					$context['block']['className'] ?? null,
				],
			],
			$fields
		);
	}
);
