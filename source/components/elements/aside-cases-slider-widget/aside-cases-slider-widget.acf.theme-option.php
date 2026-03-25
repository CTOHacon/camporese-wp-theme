<?php

$fields = require __DIR__ . '/aside-cases-slider-widget.acf.fields.php';

acf_add_options_sub_page([
	'page_title'  => 'Aside Cases Slider Widget',
	'menu_title'  => 'Aside Cases Slider Widget',
	'parent_slug' => 'block-defaults',
	'menu_slug'   => 'block-defaults-aside-cases-slider-widget',
]);

acf_add_local_field_group([
	'key'    => 'group_block_defaults_aside_cases_slider_widget',
	'title'  => 'Block Defaults - Aside Cases Slider Widget',
	'fields' => array_merge(
		[
			[
				'key'     => 'field_aside_cases_slider_widget_preview',
				'label'   => 'Block Appearance Example',
				'name'    => '',
				'type'    => 'message',
				'message' => '<img src="' . get_template_directory_uri() . '/source/components/elements/aside-cases-slider-widget/image.png" alt="Aside Cases Slider Widget" style="max-width:100%;height:auto;border-radius:6px;" />',
			],
		],
		$fields
	),
	'location' => [
		[['param' => 'options_page', 'operator' => '==', 'value' => 'block-defaults-aside-cases-slider-widget']],
	],
]);
