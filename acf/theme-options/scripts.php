<?php
acf_add_options_page([
    'page_title' => 'Scripts',
    'menu_title' => 'Scripts',
    'menu_slug'  => 'scripts',
    'capability' => 'edit_theme_options',
]);
acf_add_local_field_group([
    'key'      => 'group_scripts',
    'title'    => 'Scripts',
    'fields'   => [
        [
            'key'   => 'field_header_script',
            'label' => 'Header Script',
            'name'  => 'field_header_script',
            'type'  => 'textarea',
            'rows'  => 10,
        ],
        [
            'key'          => 'field_body_script',
            'label'        => 'Body Script',
            'name'         => 'field_body_script',
            'type'         => 'textarea',
            'rows'         => 10,
            'instructions' => 'Script added immediately after the opening <body> tag.',
        ],
        [
            'key'   => 'field_footer_script',
            'label' => 'Footer Script',
            'name'  => 'field_footer_script',
            'type'  => 'textarea',
            'rows'  => 10,
        ],
    ],
    'location' => [
        [[
            'param'    => 'options_page',
            'operator' => '==',
            'value'    => 'scripts'
        ]],
    ],
]);