<?php
// faq-section.acf.fields.php

return [
    [
        'key'   => 'field_faq_section_head_title',
        'name'  => 'faq_section_head_title',
        'label' => 'Section Title',
        'type'  => 'text',
    ],
    [
        'key'  => 'field_faq_section_head_text',
        'name' => 'faq_section_head_text',
        'label' => 'Section Text',
        'type' => 'textarea',
        'rows' => 2,
    ],
    [
        'key'          => 'field_faq_section_items',
        'name'         => 'faq_section_items',
        'label'        => 'FAQ Items',
        'type'         => 'repeater',
        'layout'       => 'block',
        'button_label' => 'Add FAQ Item',
        'sub_fields'   => [
            [
                'key'   => 'field_faq_section_item_title',
                'name'  => 'title',
                'label' => 'Question',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_faq_section_item_answer',
                'name'  => 'answer',
                'label' => 'Answer',
                'type'  => 'textarea',
                'rows'  => 3,
            ],
        ],
    ],
];
