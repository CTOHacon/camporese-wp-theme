<?php

$fields = require __DIR__ . '/cta-section-bar.acf.fields.php';

acf_add_options_sub_page([
    'page_title'  => 'CTA Section Bar',
    'menu_title'  => 'CTA Section Bar',
    'parent_slug' => 'block-defaults',
    'menu_slug'   => 'block-defaults-cta-section-bar',
]);

acf_add_local_field_group([
    'key'    => 'group_block_defaults_cta_section_bar',
    'title'  => 'Block Defaults - CTA Section Bar',
    'fields' => array_merge(
        [
            [
                'key'     => 'field_cta_section_bar_preview',
                'label'   => 'Block Appearance Example',
                'name'    => '',
                'type'    => 'message',
                'message' => '<img src="' . get_template_directory_uri() . '/source/components/sections/cta-section-bar/image.png" alt="CTA Section Bar" style="max-width:100%;height:auto;border-radius:6px;" />',
            ],
        ],
        $fields
    ),
    'location' => [
        [['param' => 'options_page', 'operator' => '==', 'value' => 'block-defaults-cta-section-bar']],
    ],
]);
