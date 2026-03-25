<?php

$fields = require __DIR__ . '/contact-section.acf.fields.php';

acf_add_options_sub_page([
    'page_title'  => 'Contact Section',
    'menu_title'  => 'Contact Section',
    'parent_slug' => 'block-defaults',
    'menu_slug'   => 'block-defaults-contact-section',
]);

acf_add_local_field_group([
    'key'    => 'group_block_defaults_contact_section',
    'title'  => 'Block Defaults - Contact Section',
    'fields' => array_merge(
        [
            [
                'key'     => 'field_contact_section_preview',
                'label'   => 'Block Appearance Example',
                'name'    => '',
                'type'    => 'message',
                'message' => '<img src="' . get_template_directory_uri() . '/source/components/contact-section/image.png" alt="Contact Section" style="max-width:100%;height:auto;border-radius:6px;" />',
            ],
        ],
        $fields
    ),
    'location' => [
        [['param' => 'options_page', 'operator' => '==', 'value' => 'block-defaults-contact-section']],
    ],
]);
