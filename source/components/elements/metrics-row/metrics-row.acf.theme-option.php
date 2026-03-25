<?php

$fields = require __DIR__ . '/metrics-row.acf.fields.php';

acf_add_options_sub_page([
	'page_title'  => 'Metrics Row',
	'menu_title'  => 'Metrics Row',
	'parent_slug' => 'block-defaults',
	'menu_slug'   => 'block-defaults-metrics-row',
]);

acf_add_local_field_group([
	'key'    => 'group_block_defaults_metrics_row',
	'title'  => 'Block Defaults - Metrics Row',
	'fields' => array_merge(
		[
			[
				'key'     => 'field_metrics_row_preview',
				'label'   => 'Block Appearance Example',
				'name'    => '',
				'type'    => 'message',
				'message' => '<img src="' . get_template_directory_uri() . '/source/components/elements/metrics-row/image.png" alt="Metrics Row" style="max-width:100%;height:auto;border-radius:6px;" />',
			],
		],
		$fields
	),
	'location' => [
		[['param' => 'options_page', 'operator' => '==', 'value' => 'block-defaults-metrics-row']],
	],
]);
