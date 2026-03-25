<?php

$fields = require get_template_directory() . '/source/components/sections/technical-page-hero/technical-page-hero.acf.fields.php';

acf_add_options_sub_page([
    'page_title'  => '404 Page',
    'menu_title'  => '404 Page',
    'parent_slug' => 'theme-parts',
    'menu_slug'   => 'theme-parts-404',
]);

acf_add_local_field_group([
    'key'      => 'group_theme_parts_404',
    'title'    => 'Theme Parts - 404 Page',
    'fields'   => $fields,
    'location' => [
        [[
            'param'    => 'options_page',
            'operator' => '==',
            'value'    => 'theme-parts-404'
        ]],
    ],
]);
