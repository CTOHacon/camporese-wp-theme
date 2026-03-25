<?php

$fields = require __DIR__ . '/aside-reviews-widget.acf.fields.php';

acf_add_options_sub_page([
	'page_title'  => 'Aside Reviews Widget',
	'menu_title'  => 'Aside Reviews Widget',
	'parent_slug' => 'block-defaults',
	'menu_slug'   => 'block-defaults-aside-reviews-widget',
]);

acf_add_local_field_group([
	'key'    => 'group_block_defaults_aside_reviews_widget',
	'title'  => 'Block Defaults - Aside Reviews Widget',
	'fields' => array_merge(
		[
			[
				'key'     => 'field_aside_reviews_widget_preview',
				'label'   => 'Block Appearance Example',
				'name'    => '',
				'type'    => 'message',
				'message' => '<img src="' . get_template_directory_uri() . '/source/components/elements/aside-reviews-widget/image.png" alt="Aside Reviews Widget" style="max-width:100%;height:auto;border-radius:6px;" />',
			],
		],
		$fields
	),
	'location' => [
		[['param' => 'options_page', 'operator' => '==', 'value' => 'block-defaults-aside-reviews-widget']],
	],
]);
