<?php

acf_add_options_sub_page([
    'page_title'  => 'Practice Areas Menu',
    'menu_title'  => 'Practice Areas Menu',
    'parent_slug' => 'theme-parts',
    'menu_slug'   => 'theme-parts-practice-areas-menu',
]);

acf_add_local_field_group([
    'key'    => 'group_theme_parts_practice_areas_menu',
    'title'  => 'Theme Parts - Practice Areas Menu',
    'fields' => [
        [
            'key'          => 'field_practice_areas_menu_columns',
            'label'        => 'Menu Columns',
            'name'         => 'practice_areas_menu_columns',
            'type'         => 'repeater',
            'layout'       => 'block',
            'button_label' => 'Add Column',
            'sub_fields'   => [
                [
                    'key'     => 'field_pam_column_title',
                    'label'   => 'Title',
                    'name'    => 'title',
                    'type'    => 'text',
                    'wrapper' => ['width' => 50],
                ],
                [
                    'key'           => 'field_pam_column_image',
                    'label'         => 'Image',
                    'name'          => 'image',
                    'type'          => 'image',
                    'return_format' => 'id',
                    'wrapper'       => ['width' => 50],
                ],
                [
                    'key'          => 'field_pam_column_links',
                    'label'        => 'Links',
                    'name'         => 'links',
                    'type'         => 'repeater',
                    'layout'       => 'table',
                    'button_label' => 'Add Link',
                    'sub_fields'   => [
                        [
                            'key'   => 'field_pam_column_link',
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
                'value'    => 'theme-parts-practice-areas-menu',
            ],
        ],
    ],
]);
