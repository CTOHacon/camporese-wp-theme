<?php

acf_add_options_page([
	'page_title' => 'Reviews Settings',
	'menu_title' => 'Reviews',
	'menu_slug'  => 'reviews',
	'capability' => 'edit_theme_options',
	'icon_url'   => 'dashicons-star-filled',
	'redirect'   => false,
]);

acf_add_local_field_group([
	'key'      => 'group_reviews',
	'title'    => 'Reviews Settings',
	'fields'   => [
		// --- Company Rating Group ---
		[
			'key'        => 'field_rating',
			'label'      => 'Company Rating',
			'name'       => 'field_rating',
			'type'       => 'group',
			'layout'     => 'block',
			'sub_fields' => [
				[
					'key'           => 'field_rating_average',
					'label'         => 'Average Rating',
					'name'          => 'average',
					'type'          => 'number',
					'min'           => 0,
					'max'           => 5,
					'step'          => 0.1,
					'default_value' => 5,
					'wrapper'       => ['width' => 50],
				],
				[
					'key'           => 'field_rating_total_reviews',
					'label'         => 'Total Reviews',
					'name'          => 'total_reviews',
					'type'          => 'number',
					'min'           => 0,
					'default_value' => 0,
					'wrapper'       => ['width' => 50],
				],
				[
					'key'   => 'field_rating_all_reviews_link',
					'label' => 'All Reviews Link',
					'name'  => 'all_reviews_link',
					'type'  => 'link',
				],
			],
		],

		// --- Proved By Platforms ---
		[
			'key'          => 'field_proved_by_platforms',
			'label'        => 'Proved By Platforms',
			'name'         => 'proved_by_platforms',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Add Platform',
			'sub_fields'   => [
				[
					'key'           => 'field_proved_by_platform_logo_light',
					'label'         => 'Light Logo Variation',
					'name'          => 'logo_light',
					'type'          => 'image',
					'return_format' => 'id',
					'instructions'  => 'Logo for dark backgrounds (white/light colored)',
				],
				[
					'key'           => 'field_proved_by_platform_logo_dark',
					'label'         => 'Dark Logo Variation',
					'name'          => 'logo_dark',
					'type'          => 'image',
					'return_format' => 'id',
					'instructions'  => 'Logo for light backgrounds (dark colored)',
				],
				[
					'key'   => 'field_proved_by_platform_link',
					'label' => 'Link',
					'name'  => 'link',
					'type'  => 'text',
				],
			],
		],

		// --- Reviews Group ---
		[
			'key'          => 'field_reviews',
			'label'        => 'Reviews',
			'name'         => 'field_reviews',
			'type'         => 'repeater',
			'layout'       => 'row',
			'button_label' => 'Add Review',
			'sub_fields'   => [
				[
					'key'        => 'field_review_author',
					'label'      => 'Author',
					'name'       => 'author',
					'type'       => 'group',
					'layout'     => 'row',
					'sub_fields' => [
						[
							'key'           => 'field_review_author_image',
							'label'         => 'Image',
							'name'          => 'image',
							'type'          => 'image',
							'return_format' => 'array',
						],
						[
							'key'   => 'field_review_author_name',
							'label' => 'Name',
							'name'  => 'name',
							'type'  => 'text',
						],
					],
				],
				[
					'key'   => 'field_review_title',
					'label' => 'Title',
					'name'  => 'title',
					'type'  => 'text',
				],
				[
					'key'   => 'field_review_text',
					'label' => 'Review Text',
					'name'  => 'text',
					'type'  => 'textarea',
					'rows'  => 4,
				],
				[
					'key'            => 'field_review_date',
					'label'          => 'Date',
					'name'           => 'date',
					'type'           => 'date_picker',
					'display_format' => 'M j, Y',
					'return_format'  => 'Y-m-d',
				],
			],
		],
	],
	'location' => [
		[[
			'param'    => 'options_page',
			'operator' => '==',
			'value'    => 'reviews'
		]],
	],
]);