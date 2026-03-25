<?php

$fields = require __DIR__ . '/metrics-row.acf.fields.php';

createACFBlock(
	[
		'name'     => 'metrics-row',
		'title'    => 'Metrics Row',
		'category' => 'theme-blocks',
		'icon'     => 'chart-bar',
		'mode'     => 'preview',
		'parent'   => [
			'acf/content-block',
			'acf/page-typography-content',
		],
		'supports' => [
			'align' => false,
		],
	],
	array_merge(
		[
			[
				'key'           => 'field_metrics_row_enabled',
				'name'          => 'metrics_row_enabled',
				'label'         => 'Enable Metrics Row',
				'type'          => 'true_false',
				'default_value' => 0,
				'ui'            => 1,
			],
			[
				'key'     => 'field_metrics_row_info',
				'name'    => '',
				'label'   => '',
				'type'    => 'message',
				'message' => 'Default content is pulled from <a href="' . admin_url('admin.php?page=block-defaults-metrics-row') . '" target="_blank">Metrics Row</a> settings. Add values below to override.',
				'conditional_logic' => [
					[['field' => 'field_metrics_row_enabled', 'operator' => '==', 'value' => '1']],
				],
			],
		],
		array_map(function ($field) {
			$field['conditional_logic'] = [
				[['field' => 'field_metrics_row_enabled', 'operator' => '==', 'value' => '1']],
			];
			return $field;
		}, $fields)
	),
	function ($fields, $context) {
		if (empty($fields['metrics_row_enabled'])) {
			return;
		}

		component_metrics_row(
			[
				'class' => [
					$context['block']['className'] ?? null,
				],
			],
			[
				'items' => $fields['metrics_row_items'] ?? null,
			]
		);
	}
);
