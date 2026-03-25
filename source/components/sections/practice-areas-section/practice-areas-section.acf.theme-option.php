<?php

$fields = require __DIR__ . '/practice-areas-section.acf.fields.php';

acf_add_options_sub_page([
    'page_title'  => 'Practice Areas Section',
    'menu_title'  => 'Practice Areas Section',
    'parent_slug' => 'block-defaults',
    'menu_slug'   => 'block-defaults-practice-areas-section',
]);

acf_add_local_field_group([
    'key'    => 'group_block_defaults_practice_areas_section',
    'title'  => 'Block Defaults - Practice Areas Section',
    'fields' => array_merge(
        [
            [
                'key'     => 'field_pas_preview',
                'label'   => 'Block Appearance Example',
                'name'    => '',
                'type'    => 'message',
                'message' => '<img src="' . get_template_directory_uri() . '/source/components/sections/practice-areas-section/image.png" alt="Practice Areas Section" style="max-width:100%;height:auto;border-radius:6px;" />',
            ],
        ],
        $fields
    ),
    'location' => [
        [['param' => 'options_page', 'operator' => '==', 'value' => 'block-defaults-practice-areas-section']],
    ],
]);
