<?php
// simple-faq-section.acf.fields.php

return [
    [
        'key'   => 'field_simple_faq_section_title',
        'name'  => 'simple_faq_section_title',
        'label' => 'Title',
        'type'  => 'text',
    ],
    [
        'key'   => 'field_simple_faq_section_text',
        'name'  => 'simple_faq_section_text',
        'label' => 'Text',
        'type'  => 'textarea',
        'rows'  => 3,
    ],
    [
        'key'          => 'field_simple_faq_section_items',
        'name'         => 'simple_faq_section_items',
        'label'        => 'FAQ Items',
        'type'         => 'repeater',
        'layout'       => 'block',
        'button_label' => 'Add FAQ Item',
        'sub_fields'   => [
            [
                'key'   => 'field_simple_faq_section_item_title',
                'name'  => 'title',
                'label' => 'Question',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_simple_faq_section_item_answer',
                'name'  => 'answer',
                'label' => 'Answer',
                'type'  => 'textarea',
                'rows'  => 3,
            ],
        ],
    ],
];
