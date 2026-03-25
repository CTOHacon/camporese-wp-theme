<?php
// faq-list.acf.fields.php

return [
    [
        'key'          => 'field_faq_list_items',
        'name'         => 'faq_list_items',
        'label'        => 'FAQ Items',
        'type'         => 'repeater',
        'layout'       => 'block',
        'button_label' => 'Add FAQ Item',
        'sub_fields'   => [
            [
                'key'   => 'field_faq_list_item_title',
                'name'  => 'title',
                'label' => 'Question',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_faq_list_item_answer',
                'name'  => 'answer',
                'label' => 'Answer',
                'type'  => 'textarea',
                'rows'  => 3,
            ],
        ],
    ],
];
