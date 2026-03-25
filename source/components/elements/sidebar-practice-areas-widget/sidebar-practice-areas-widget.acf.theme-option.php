<?php

$fields = require __DIR__ . '/sidebar-practice-areas-widget.acf.fields.php';

acf_add_options_sub_page([
    'page_title'  => 'Sidebar Practice Areas Widget',
    'menu_title'  => 'Sidebar Practice Areas Widget',
    'parent_slug' => 'block-defaults',
    'menu_slug'   => 'block-defaults-sidebar-practice-areas-widget',
]);

acf_add_local_field_group([
    'key'    => 'group_block_defaults_sidebar_practice_areas_widget',
    'title'  => 'Block Defaults - Sidebar Practice Areas Widget',
    'fields' => array_merge(
        [
            [
                'key'     => 'field_spaw_preview',
                'label'   => 'Block Appearance Example',
                'name'    => '',
                'type'    => 'message',
                'message' => '<img src="' . get_template_directory_uri() . '/source/components/elements/sidebar-practice-areas-widget/image.png" alt="Sidebar Practice Areas Widget" style="max-width:100%;height:auto;border-radius:6px;" />',
            ],
        ],
        $fields
    ),
    'location' => [
        [['param' => 'options_page', 'operator' => '==', 'value' => 'block-defaults-sidebar-practice-areas-widget']],
    ],
]);
