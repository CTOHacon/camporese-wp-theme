<?php
// advantages-list.acf.fields.php

return [
    [
        'key'          => 'field_advantages_list_items',
        'name'         => 'advantages_list_items',
        'label'        => 'Items',
        'type'         => 'repeater',
        'layout'       => 'block',
        'button_label' => 'Add Item',
        'sub_fields'   => [
            [
                'key'           => 'field_advantages_list_item_icon',
                'name'          => 'icon',
                'label'         => 'Icon',
                'type'          => 'image',
                'return_format' => 'id',
            ],
            [
                'key'   => 'field_advantages_list_item_title',
                'name'  => 'title',
                'label' => 'Title',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_advantages_list_item_text',
                'name'  => 'text',
                'label' => 'Text',
                'type'  => 'textarea',
            ],
        ],
    ],
];
