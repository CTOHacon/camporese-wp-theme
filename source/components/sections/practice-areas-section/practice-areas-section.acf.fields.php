<?php

return [
    [
        'key'   => 'field_pas_title',
        'name'  => 'pas_title',
        'label' => 'Title',
        'type'  => 'text'
    ],
    get_acf_heading_tag_field([
        'key'           => 'field_pas_title_tag',
        'name'          => 'pas_title_tag',
        'label'         => 'Title Tag',
        'default_value' => 'h2',
        'wrapper'       => ['width' => 50],
    ]),
    [
        'key'   => 'field_pas_text',
        'name'  => 'pas_text',
        'label' => 'Description',
        'type'  => 'textarea'
    ],
    [
        'key'          => 'field_pas_items',
        'name'         => 'pas_items',
        'label'        => 'Practice Areas',
        'type'         => 'repeater',
        'layout'       => 'block',
        'button_label' => 'Add Practice Area',
        'sub_fields'   => [
            [
                'key'   => 'field_pas_item_title',
                'name'  => 'title',
                'label' => 'Title',
                'type'  => 'text'
            ],
            [
                'key'   => 'field_pas_item_text',
                'name'  => 'text',
                'label'        => 'Description',
                'type'         => 'textarea',
                'instructions' => 'Recommended to use 3–4 lines of text.',
            ],
            [
                'key'   => 'field_pas_item_link',
                'name'  => 'link',
                'label' => 'Link',
                'type'  => 'link'
            ],
            [
                'key'           => 'field_pas_item_image',
                'name'          => 'image',
                'label'         => 'Service Image',
                'type'          => 'image',
                'return_format' => 'id'
            ],
        ],
    ],
];
