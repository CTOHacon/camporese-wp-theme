<?php

return [
	[
		'key'          => 'field_metrics_row_items',
		'name'         => 'metrics_row_items',
		'label'        => 'Metrics',
		'type'         => 'repeater',
		'layout'       => 'block',
		'button_label' => 'Add Metric',
		'sub_fields'   => [
			[
				'key'     => 'field_metrics_row_item_value',
				'name'    => 'value',
				'label'   => 'Value',
				'type'    => 'text',
				'wrapper' => ['width' => 50],
			],
			[
				'key'   => 'field_metrics_row_item_description',
				'name'  => 'description',
				'label' => 'Description',
				'type'  => 'text',
			],
		],
	],
];
