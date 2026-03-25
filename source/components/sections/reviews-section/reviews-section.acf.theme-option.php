<?php

$fields = require __DIR__ . '/reviews-section.acf.fields.php';

acf_add_options_sub_page([
	'page_title'  => 'Reviews Section',
	'menu_title'  => 'Reviews Section',
	'parent_slug' => 'block-defaults',
	'menu_slug'   => 'block-defaults-reviews-section',
]);

acf_add_local_field_group([
	'key'    => 'group_block_defaults_reviews_section',
	'title'  => 'Block Defaults - Reviews Section',
	'fields' => array_merge(
		[
			[
				'key'     => 'field_reviews_section_preview',
				'label'   => 'Block Appearance Example',
				'name'    => '',
				'type'    => 'message',
				'message' => '<img src="' . get_template_directory_uri() . '/source/components/sections/reviews-section/image.png" alt="Reviews Section" style="max-width:100%;height:auto;border-radius:6px;" />',
			],
		],
		$fields
	),
	'location' => [
		[['param' => 'options_page', 'operator' => '==', 'value' => 'block-defaults-reviews-section']],
	],
]);
