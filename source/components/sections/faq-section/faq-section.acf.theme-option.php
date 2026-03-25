<?php

$fields = require __DIR__ . '/faq-section.acf.fields.php';

acf_add_options_sub_page([
    'page_title'  => 'FAQ Section',
    'menu_title'  => 'FAQ Section',
    'parent_slug' => 'block-defaults',
    'menu_slug'   => 'block-defaults-faq-section',
]);

acf_add_local_field_group([
    'key'    => 'group_block_defaults_faq_section',
    'title'  => 'Block Defaults - FAQ Section',
    'fields' => array_merge(
        [
            [
                'key'     => 'field_faq_section_preview',
                'label'   => 'Block Appearance Example',
                'name'    => '',
                'type'    => 'message',
                'message' => '<img src="' . get_template_directory_uri() . '/source/components/faq-section/image.png" alt="FAQ Section" style="max-width:100%;height:auto;border-radius:6px;" />',
            ],
        ],
        $fields
    ),
    'location' => [
        [['param' => 'options_page', 'operator' => '==', 'value' => 'block-defaults-faq-section']],
    ],
]);
