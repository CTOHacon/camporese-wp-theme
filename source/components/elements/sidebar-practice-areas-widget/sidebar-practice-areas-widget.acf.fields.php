<?php

return [
    [
        'key'          => 'field_spaw_items',
        'name'         => 'spaw_items',
        'label'        => 'Practice Areas',
        'type'         => 'repeater',
        'layout'       => 'block',
        'button_label' => 'Add Practice Area',
        'sub_fields'   => [
            [
                'key'   => 'field_spaw_item_title',
                'name'  => 'title',
                'label' => 'Title',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_spaw_item_link',
                'name'  => 'link',
                'label' => 'Link',
                'type'  => 'link',
            ],
            [
                'key'           => 'field_spaw_item_image',
                'name'          => 'image',
                'label'         => 'Image',
                'type'          => 'image',
                'return_format' => 'id',
            ],
        ],
    ],
];
