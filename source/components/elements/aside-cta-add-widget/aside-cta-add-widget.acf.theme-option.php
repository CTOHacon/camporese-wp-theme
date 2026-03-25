<?php

$fields = require __DIR__ . '/aside-cta-add-widget.acf.fields.php';

acf_add_options_sub_page([
    'page_title'  => 'Aside CTA Add Widget',
    'menu_title'  => 'Aside CTA Add Widget',
    'parent_slug' => 'block-defaults',
    'menu_slug'   => 'block-defaults-aside-cta-add-widget',
]);

acf_add_local_field_group([
    'key'    => 'group_block_defaults_aside_cta_add_widget',
    'title'  => 'Block Defaults - Aside CTA Add Widget',
    'fields' => array_merge(
        [
            [
                'key'     => 'field_aside_cta_add_widget_preview',
                'label'   => 'Block Appearance Example',
                'name'    => '',
                'type'    => 'message',
                'message' => '<img src="' . get_template_directory_uri() . '/source/components/elements/aside-cta-add-widget/image.png" alt="Aside CTA Add Widget" style="max-width:100%;height:auto;border-radius:6px;" />',
            ],
        ],
        $fields
    ),
    'location' => [
        [['param' => 'options_page', 'operator' => '==', 'value' => 'block-defaults-aside-cta-add-widget']],
    ],
]);
