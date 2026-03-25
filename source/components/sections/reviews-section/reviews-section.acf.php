<?php

$fields = require __DIR__ . '/reviews-section.acf.fields.php';

createACFBlock(
	[
		'name'          => 'reviews-section',
		'title'         => 'Reviews Section',
		'category'      => 'theme-blocks',
		'icon'          => 'star-filled',
		'mode'          => 'preview',
		'supports'      => ['align' => false],
		'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'sections/reviews-section/*.png')),
	],
	[
		['key' => 'field_tab_reviews_section_content', 'label' => 'Content', 'type' => 'tab'],
		[
			'key'     => 'field_reviews_section_info',
			'name'    => '',
			'label'   => '',
			'type'    => 'message',
			'message' => 'Default content is pulled from <a href="' . admin_url('admin.php?page=block-defaults-reviews-section') . '" target="_blank">Reviews Section</a> settings. Reviews data comes from <a href="' . admin_url('admin.php?page=reviews') . '" target="_blank">Reviews</a> settings. Add values below to override.',
		],
		...$fields,
		['key' => 'field_tab_reviews_section_layouting', 'label' => 'Layouting', 'type' => 'tab'],
		get_acf_margin_select_field(),
	],
	function ($fields, $context) {
		component_reviews_section(
			['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
			[
				'title'           => $fields['reviews_section_title'] ?? null,
				'description'     => $fields['reviews_section_description'] ?? null,
				'rating_bar_title' => $fields['reviews_section_rating_bar_title'] ?? null,
			]
		);
	}
);
