<?php

return [
	[
		'key'   => 'field_aside_cases_slider_widget_title',
		'name'  => 'aside_cases_slider_widget_title',
		'label' => 'Title',
		'type'  => 'text',
	],
	[
		'key'   => 'field_aside_cases_slider_widget_subtitle',
		'name'  => 'aside_cases_slider_widget_subtitle',
		'label' => 'Subtitle',
		'type'  => 'text',
	],
	[
		'key'        => 'field_aside_cases_slider_widget_items',
		'name'       => 'aside_cases_slider_widget_items',
		'label'      => 'Slides',
		'type'       => 'repeater',
		'layout'     => 'block',
		'sub_fields' => [
			[
				'key'   => 'field_aside_cases_slider_widget_items_title',
				'name'  => 'title',
				'label' => 'Title',
				'type'  => 'text',
			],
			[
				'key'   => 'field_aside_cases_slider_widget_items_text',
				'name'  => 'text',
				'label' => 'Text',
				'type'  => 'textarea',
				'rows'  => 3,
			],
		],
	],
];
