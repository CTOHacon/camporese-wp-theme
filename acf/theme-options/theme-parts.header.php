<?php

acf_add_options_sub_page([
    'page_title'  => 'Header',
    'menu_title'  => 'Header',
    'parent_slug' => 'theme-parts',
    'menu_slug'   => 'theme-parts-header',
]);
acf_add_local_field_group([
    'key'      => 'group_theme_parts_header',
    'title'    => 'Theme Parts - Header',
    'fields'   => [
        [
            'key'           => 'field_logo',
            'label'         => 'Logo',
            'name'          => 'field_logo',
            'type'          => 'image',
            'return_format' => 'array',
        ],
        [
            'key'          => 'field_header_menu',
            'label'        => 'Header Menu',
            'name'         => 'field_header_menu',
            'type'         => 'repeater',
            'layout'       => 'table',
            'button_label' => 'Add Menu Item',
            'sub_fields'   => [
                [
                    'key'   => 'field_header_menu_item_link',
                    'label' => 'Link',
                    'name'  => 'link',
                    'type'  => 'link',
                ],
                [
                    'key'          => 'field_header_menu_item_submenu',
                    'label'        => 'Submenu',
                    'name'         => 'submenu',
                    'type'         => 'repeater',
                    'layout'       => 'table',
                    'button_label' => 'Add Submenu Link',
                    'sub_fields'   => [
                        [
                            'key'   => 'field_header_submenu_link',
                            'label' => 'Link',
                            'name'  => 'link',
                            'type'  => 'link',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'location' => [
        [
            [
                'param'    => 'options_page',
                'operator' => '==',
                'value'    => 'theme-parts-header'
            ],
        ],
    ],
]);
