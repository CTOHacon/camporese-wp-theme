<?php

return [
    [
        'key'          => 'field_fancy_cards_list_items',
        'label'        => 'Items',
        'name'         => 'fancy_cards_list_items',
        'type'         => 'repeater',
        'layout'       => 'block',
        'min'          => 0,
        'max'          => 0,
        'button_label' => 'Add Card',
        'sub_fields'   => [
            [
                'key'   => 'field_fancy_cards_list_items_title',
                'label' => 'Title',
                'name'  => 'title',
                'type'  => 'text',
            ],
            [
                'key'  => 'field_fancy_cards_list_items_text',
                'label' => 'Text',
                'name'  => 'text',
                'type'         => 'textarea',
                'rows'         => 3,
                'instructions' => 'Recommended to use 3 lines of text.',
            ],
        ],
    ],
];
