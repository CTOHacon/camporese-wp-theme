<?php

$fields = require __DIR__ . '/about-section.acf.fields.php';

acf_add_options_sub_page([
	'page_title'  => 'About Section',
	'menu_title'  => 'About Section',
	'parent_slug' => 'block-defaults',
	'menu_slug'   => 'block-defaults-about-section',
]);

acf_add_local_field_group([
	'key'    => 'group_block_defaults_about_section',
	'title'  => 'Block Defaults - About Section',
	'fields' => array_merge(
		[
			[
				'key'     => 'field_about_section_preview',
				'label'   => 'Block Appearance Example',
				'name'    => '',
				'type'    => 'message',
				'message' => '<img src="' . get_template_directory_uri() . '/source/components/sections/about-section/image.png" alt="About Section" style="max-width:100%;height:auto;border-radius:6px;" />',
			],
		],
		$fields
	),
	'location' => [
		[['param' => 'options_page', 'operator' => '==', 'value' => 'block-defaults-about-section']],
	],
]);
