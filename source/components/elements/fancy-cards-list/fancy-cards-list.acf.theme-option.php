<?php

$fields = require __DIR__ . '/fancy-cards-list.acf.fields.php';

acf_add_options_sub_page([
    'page_title'  => 'Fancy Cards List',
    'menu_title'  => 'Fancy Cards List',
    'parent_slug' => 'block-defaults',
    'menu_slug'   => 'block-defaults-fancy-cards-list',
]);

acf_add_local_field_group([
    'key'    => 'group_block_defaults_fancy_cards_list',
    'title'  => 'Block Defaults - Fancy Cards List',
    'fields' => array_merge(
        [
            [
                'key'     => 'field_fancy_cards_list_preview',
                'label'   => 'Block Appearance Example',
                'name'    => '',
                'type'    => 'message',
                'message' => '<img src="' . get_template_directory_uri() . '/source/components/elements/fancy-cards-list/image.png" alt="Fancy Cards List" style="max-width:100%;height:auto;border-radius:6px;" />',
            ],
        ],
        $fields
    ),
    'location' => [
        [['param' => 'options_page', 'operator' => '==', 'value' => 'block-defaults-fancy-cards-list']],
    ],
]);
