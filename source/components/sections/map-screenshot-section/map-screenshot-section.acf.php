<?php

$fields = require __DIR__ . '/map-screenshot-section.acf.fields.php';

createACFBlock(
    [
        'name'          => 'map-screenshot-section',
        'title'         => 'Map Screenshot Section',
        'category'      => 'theme-blocks',
        'icon'          => 'location-alt',
        'mode'          => 'preview',
        'supports'      => ['align' => false],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'map-screenshot-section/*.png')),
    ],
    [
        ['key' => 'field_tab_map_screenshot_section_content', 'label' => 'Content', 'type' => 'tab'],
        [
            'key'     => 'field_map_screenshot_section_info',
            'name'    => '',
            'label'   => '',
            'type'    => 'message',
            'message' => 'Default content is pulled from <a href="' . admin_url('admin.php?page=block-defaults-map-screenshot-section') . '" target="_blank">Map Screenshot Section</a> settings. Add values below to override.',
        ],
        ...$fields,
        ['key' => 'field_tab_map_screenshot_section_layouting', 'label' => 'Layouting', 'type' => 'tab'],
        get_acf_margin_select_field(),
    ],
    function ($fields, $context) {
        component_map_screenshot_section(
            ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
            [
                'image' => $fields['map_screenshot_section_image'] ?? null,
            ]
        );
    }
);
