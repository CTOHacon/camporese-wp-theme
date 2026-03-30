<?php

createACFBlock(
	[
		'name'          => 'page-hero',
		'title'         => 'Page Hero',
		'category'      => 'theme-blocks',
		'icon'          => 'cover-image',
		'mode'          => 'preview',
		'supports'      => [
			'align' => false,
		],
		'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'page-hero/*.png')),
	],
	[
		// ==========================================
		// ===== Content =====
		// ==========================================
		[
			'key'   => 'field_ph_tab_content',
			'label' => 'Content',
			'type'  => 'tab',
		],

		// --- Title ---
		get_acf_heading_tag_field([
			'key'           => 'field_ph_title_tag',
			'name'          => 'title_tag',
			'label'         => 'Title Tag',
			'default_value' => 'h1',
			'wrapper'       => ['width' => 30],
		]),
		[
			'key'          => 'field_ph_title',
			'name'         => 'title',
			'label'        => 'Title Line 1',
			'type'         => 'text',
			'instructions' => 'Main title line (white). E.g. "Serious Injuries."',
		],
		[
			'key'          => 'field_ph_title_line_2',
			'name'         => 'title_line_2',
			'label'        => 'Title Line 2',
			'type'         => 'text',
			'instructions' => 'Secondary title line (muted). E.g. "Serious Representation."',
		],

		// --- Slogan ---
		[
			'key'          => 'field_ph_slogan',
			'name'         => 'slogan',
			'label'        => 'Slogan',
			'type'         => 'text',
			'instructions' => 'Uppercase text below title.',
		],

		// --- Text ---
		[
			'key'   => 'field_ph_text',
			'name'  => 'text',
			'label' => 'Text',
			'type'         => 'textarea',
			'rows'         => 4,
			'instructions' => 'Recommended to use 3 lines of text.',
		],

		// ==========================================
		// ===== Features =====
		// ==========================================
		[
			'key'   => 'field_ph_tab_features',
			'label' => 'Features',
			'type'  => 'tab',
		],

		// --- Rating Bar ---
		[
			'key'           => 'field_ph_show_rating_bar',
			'name'          => 'show_rating_bar',
			'label'         => 'Enable Rating Bar',
			'type'          => 'true_false',
			'default_value' => 0,
			'ui'            => 1,
			'instructions'  => 'Rating data is configured in <a href="' . admin_url('admin.php?page=reviews') . '" target="_blank">Reviews</a> settings.',
		],

		// --- Contact Buttons ---
		[
			'key'           => 'field_ph_show_contact_buttons',
			'name'          => 'show_contact_buttons',
			'label'         => 'Enable Contact Buttons',
			'type'          => 'true_false',
			'default_value' => 1,
			'ui'            => 1,
		],

		// --- Logos List ---
		[
			'key'           => 'field_ph_show_logos_list',
			'name'          => 'show_logos_list',
			'label'         => 'Enable Logos List',
			'type'          => 'true_false',
			'default_value' => 0,
			'ui'            => 1,
			'instructions'  => 'Uses platforms from <a href="' . admin_url('admin.php?page=reviews') . '" target="_blank">Reviews</a> settings.',
		],

		// --- Metrics ---
		[
			'key'           => 'field_ph_show_metrics',
			'name'          => 'show_metrics',
			'label'         => 'Enable Metrics Row',
			'type'          => 'true_false',
			'default_value' => 0,
			'ui'            => 1,
			'instructions'  => 'Global metrics are configured in <a href="' . admin_url('admin.php?page=block-defaults-metrics-row') . '" target="_blank">Metrics Row</a> block defaults.',
		],
		[
			'key'               => 'field_ph_local_metrics',
			'name'              => 'local_metrics',
			'label'             => 'Local Metrics',
			'type'              => 'repeater',
			'layout'            => 'row',
			'button_label'      => 'Add Metric',
			'instructions'      => 'Override global metrics. Leave empty to use global.',
			'conditional_logic' => [
				[[
					'field'    => 'field_ph_show_metrics',
					'operator' => '==',
					'value'    => '1'
				]],
			],
			'sub_fields'        => [
				[
					'key'     => 'field_ph_lm_value',
					'name'    => 'value',
					'label'   => 'Value',
					'type'    => 'text',
					'wrapper' => ['width' => 50]
				],
				[
					'key'   => 'field_ph_lm_description',
					'name'  => 'description',
					'label' => 'Description',
					'type'  => 'text'
				],
			],
		],

		// --- Breadcrumbs ---
		[
			'key'           => 'field_ph_show_breadcrumbs',
			'name'          => 'show_breadcrumbs',
			'label'         => 'Enable Breadcrumbs',
			'type'          => 'true_false',
			'default_value' => 1,
			'ui'            => 1,
		],

		// ==========================================
		// ===== Image =====
		// ==========================================
		[
			'key'   => 'field_ph_tab_image',
			'label' => 'Image',
			'type'  => 'tab',
		],
		[
			'key'           => 'field_ph_image',
			'name'          => 'image',
			'label'         => 'Hero Image',
			'type'          => 'image',
			'return_format' => 'id',
		],
		[
			'key'               => 'field_ph_image_display',
			'name'              => 'image_display',
			'label'             => 'Image Display Mode',
			'type'              => 'select',
			'choices'           => [
				'small' => 'Small (inside container)',
				'large' => 'Large (full-height absolute)',
			],
			'default_value'     => 'small',
			'conditional_logic' => [
				[[
					'field'    => 'field_ph_image',
					'operator' => '!=empty',
				]],
			],
		],

		// ==========================================
		// ===== Background =====
		// ==========================================
		[
			'key'   => 'field_ph_tab_background',
			'label' => 'Background',
			'type'  => 'tab',
		],
		[
			'key'           => 'field_ph_background_image',
			'name'          => 'background_image',
			'label'         => 'Background Image',
			'type'          => 'image',
			'return_format' => 'id',
		],
		[
			'key'          => 'field_ph_bg_bottom_overlap',
			'name'         => 'bg_bottom_overlap',
			'label'        => 'Background Bottom Overlap Shift',
			'type'         => 'text',
			'instructions' => 'Value in REM. Applied as CSS variable --page-hero-bg-bottom-overlap.',
			'wrapper'      => ['width' => 50],
		],

		// ==========================================
		// ===== Layouting =====
		// ==========================================
		[
			'key'   => 'field_ph_tab_layouting',
			'label' => 'Layouting',
			'type'  => 'tab',
		],
		get_acf_margin_select_field(),
	],
	function ($fields, $context) {
		$local_metrics     = ($fields['local_metrics'] ?? null) ?: [];
		$use_local_metrics = !empty($local_metrics);

		component_page_hero(
			[
				'class' => [
					$fields['margin_bottom'] ?? null,
					$context['block']['className'] ?? null,
				],
			],
			[
				'title'                => $fields['title'] ?? null,
				'title_line_2'         => $fields['title_line_2'] ?? null,
				'title_tag'            => $fields['title_tag'] ?? 'h1',
				'slogan'               => $fields['slogan'] ?? null,
				'text'                 => $fields['text'] ?? null,
				'show_rating_bar'      => $fields['show_rating_bar'] ?? false,
				'show_contact_buttons' => $fields['show_contact_buttons'] ?? true,
				'show_logos_list'      => $fields['show_logos_list'] ?? false,
				'show_metrics'         => $fields['show_metrics'] ?? false,
				'use_local_metrics'    => $use_local_metrics,
				'local_metrics'        => $local_metrics,
				'show_breadcrumbs'     => $fields['show_breadcrumbs'] ?? true,
				'background_image'     => $fields['background_image'] ?? null,
				'bg_bottom_overlap'    => $fields['bg_bottom_overlap'] ?? null,
				'image'                => $fields['image'] ?? null,
				'image_display'        => $fields['image_display'] ?? 'small',
			]
		);
	}
);
