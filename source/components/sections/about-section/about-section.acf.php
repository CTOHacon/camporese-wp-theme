<?php

$fields = require __DIR__ . '/about-section.acf.fields.php';

createACFBlock(
	[
		'name'          => 'about-section',
		'title'         => 'About Section',
		'category'      => 'theme-blocks',
		'icon'          => 'id-alt',
		'mode'          => 'preview',
		'supports'      => ['align' => false],
		'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'about-section/*.png')),
	],
	[
		['key' => 'field_tab_about_section_content', 'label' => 'Content', 'type' => 'tab'],
		[
			'key'     => 'field_about_section_info',
			'name'    => '',
			'label'   => '',
			'type'    => 'message',
			'message' => 'Default content is pulled from <a href="' . admin_url('admin.php?page=block-defaults-about-section') . '" target="_blank">About Section</a> settings. Add values below to override.',
		],
		...$fields,
		['key' => 'field_tab_about_section_layouting', 'label' => 'Layouting', 'type' => 'tab'],
		get_acf_margin_select_field(),
	],
	function ($fields, $context) {
		// Flatten link field
		$link = $fields['about_section_link'] ?: [];
		$fields['about_section_link_url']    = $link['url'] ?? null;
		$fields['about_section_link_title']  = $link['title'] ?? null;
		$fields['about_section_link_target'] = $link['target'] ?? null;
		unset($fields['about_section_link']);

		component_about_section(
			['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
			$fields
		);
	}
);
