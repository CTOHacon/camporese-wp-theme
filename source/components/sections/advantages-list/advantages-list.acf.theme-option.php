<?php

$fields = require __DIR__ . '/advantages-list.acf.fields.php';

acf_add_options_sub_page([
    'page_title'  => 'Advantages List',
    'menu_title'  => 'Advantages List',
    'parent_slug' => 'block-defaults',
    'menu_slug'   => 'block-defaults-advantages-list',
]);

acf_add_local_field_group([
    'key'    => 'group_block_defaults_advantages_list',
    'title'  => 'Block Defaults - Advantages List',
    'fields' => array_merge(
        [
            [
                'key'     => 'field_advantages_list_preview',
                'label'   => 'Block Appearance Example',
                'name'    => '',
                'type'    => 'message',
                'message' => '<img src="' . get_template_directory_uri() . '/source/components/advantages-list/image.png" alt="Advantages List" style="max-width:100%;height:auto;border-radius:6px;" />',
            ],
        ],
        $fields
    ),
    'location' => [
        [['param' => 'options_page', 'operator' => '==', 'value' => 'block-defaults-advantages-list']],
    ],
]);
