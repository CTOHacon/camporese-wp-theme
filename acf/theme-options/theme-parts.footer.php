<?php
acf_add_options_sub_page([
    'page_title'  => 'Footer',
    'menu_title'  => 'Footer',
    'parent_slug' => 'theme-parts',
    'menu_slug'   => 'theme-parts-footer',
]);
acf_add_local_field_group([
    'key'      => 'group_theme_parts_footer',
    'title'    => 'Theme Parts - Footer',
    'fields'   => [
        [
            'key'       => 'field_footer_tab_general',
            'label'     => 'General',
            'name'      => '',
            'type'      => 'tab',
            'placement' => 'top',
        ],
        [
            'key'           => 'field_footer_logo',
            'label'         => 'Footer Logo',
            'name'          => 'field_footer_logo',
            'type'          => 'image',
            'return_format' => 'array',
        ],
        [
            'key'          => 'field_footer_about_text',
            'label'        => 'About Text',
            'name'         => 'field_footer_about_text',
            'type'         => 'textarea',
            'rows'         => 4,
            'instructions' => 'Short description shown in the footer.',
        ],
        [
            'key'       => 'field_footer_tab_menu',
            'label'     => 'Menu',
            'name'      => '',
            'type'      => 'tab',
            'placement' => 'top',
        ],
        [
            'key'          => 'field_footer_company_menu',
            'label'        => 'Company Menu',
            'name'         => 'field_footer_company_menu',
            'type'         => 'repeater',
            'layout'       => 'table',
            'button_label' => 'Add Menu Item',
            'sub_fields'   => [
                [
                    'key'   => 'field_footer_company_menu_item_link',
                    'label' => 'Link',
                    'name'  => 'link',
                    'type'  => 'link',
                ],
            ],
        ],
        [
            'key'          => 'field_footer_practice_areas_title',
            'label'        => 'Practice Areas Title',
            'name'         => 'field_footer_practice_areas_title',
            'type'         => 'text',
            'default_value' => 'Practise areas',
        ],
        [
            'key'          => 'field_footer_practice_areas_columns',
            'label'        => 'Practice Areas Columns',
            'name'         => 'field_footer_practice_areas_columns',
            'type'         => 'repeater',
            'layout'       => 'block',
            'button_label' => 'Add Column',
            'instructions' => 'Each row represents a column of links displayed under Practice Areas.',
            'sub_fields'   => [
                [
                    'key'          => 'field_footer_practice_areas_column_links',
                    'label'        => 'Links',
                    'name'         => 'links',
                    'type'         => 'repeater',
                    'layout'       => 'table',
                    'button_label' => 'Add Link',
                    'sub_fields'   => [
                        [
                            'key'   => 'field_footer_practice_areas_link',
                            'label' => 'Link',
                            'name'  => 'link',
                            'type'  => 'link',
                        ],
                    ],
                ],
            ],
        ],
        [
            'key'       => 'field_footer_tab_legal',
            'label'     => 'Legal',
            'name'      => '',
            'type'      => 'tab',
            'placement' => 'top',
        ],
        [
            'key'          => 'field_footer_privacy_link',
            'label'        => 'Privacy Policy Link',
            'name'         => 'field_footer_privacy_link',
            'type'         => 'link',
            'instructions' => 'Link shown before the copyright text.',
        ],
        [
            'key'           => 'field_footer_copyright_text',
            'label'         => 'Copyright Text',
            'name'          => 'field_footer_copyright_text',
            'type'          => 'text',
            'default_value' => 'Copyright © 2008',
            'instructions'  => 'Text shown after the privacy link (e.g. "Copyright © 2008").',
        ],
    ],
    'location' => [
        [
            [
                'param'    => 'options_page',
                'operator' => '==',
                'value'    => 'theme-parts-footer'
            ],
        ],
    ],
]);
