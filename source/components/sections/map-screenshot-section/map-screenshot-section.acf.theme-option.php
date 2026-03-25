<?php

$fields = require __DIR__ . '/map-screenshot-section.acf.fields.php';

acf_add_options_sub_page([
    'page_title'  => 'Map Screenshot Section',
    'menu_title'  => 'Map Screenshot Section',
    'parent_slug' => 'block-defaults',
    'menu_slug'   => 'block-defaults-map-screenshot-section',
]);

acf_add_local_field_group([
    'key'    => 'group_block_defaults_map_screenshot_section',
    'title'  => 'Block Defaults - Map Screenshot Section',
    'fields' => array_merge(
        [
            [
                'key'     => 'field_map_screenshot_section_preview',
                'label'   => 'Block Appearance Example',
                'name'    => '',
                'type'    => 'message',
                'message' => '<img src="' . get_template_directory_uri() . '/source/components/sections/map-screenshot-section/image.png" alt="Map Screenshot Section" style="max-width:100%;height:auto;border-radius:6px;" />',
            ],
        ],
        $fields
    ),
    'location' => [
        [['param' => 'options_page', 'operator' => '==', 'value' => 'block-defaults-map-screenshot-section']],
    ],
]);
