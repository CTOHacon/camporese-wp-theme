<?php

$fields = require __DIR__ . '/citation-sidebar-widget.acf.fields.php';

acf_add_options_sub_page([
    'page_title'  => 'Citation Sidebar Widget',
    'menu_title'  => 'Citation Sidebar Widget',
    'parent_slug' => 'block-defaults',
    'menu_slug'   => 'block-defaults-citation-sidebar-widget',
]);

acf_add_local_field_group([
    'key'    => 'group_block_defaults_citation_sidebar_widget',
    'title'  => 'Block Defaults - Citation Sidebar Widget',
    'fields' => array_merge(
        [
            [
                'key'     => 'field_citation_sidebar_widget_preview',
                'label'   => 'Block Appearance Example',
                'name'    => '',
                'type'    => 'message',
                'message' => '<img src="' . get_template_directory_uri() . '/source/components/elements/citation-sidebar-widget/image.png" alt="Citation Sidebar Widget" style="max-width:100%;height:auto;border-radius:6px;" />',
            ],
        ],
        $fields
    ),
    'location' => [
        [['param' => 'options_page', 'operator' => '==', 'value' => 'block-defaults-citation-sidebar-widget']],
    ],
]);
