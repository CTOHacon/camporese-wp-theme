<?php

return [
    [
        'key'          => 'field_faq_tabs_section_tabs',
        'name'         => 'faq_tabs_section_tabs',
        'label'        => 'Tabs',
        'type'         => 'repeater',
        'layout'       => 'block',
        'button_label' => 'Add Tab',
        'sub_fields'   => [
            [
                'key'   => 'field_faq_tabs_section_tab_label',
                'name'  => 'label',
                'label' => 'Tab Label',
                'type'  => 'text',
            ],
            [
                'key'          => 'field_faq_tabs_section_tab_items',
                'name'         => 'items',
                'label'        => 'FAQ Items',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Add FAQ Item',
                'sub_fields'   => [
                    [
                        'key'   => 'field_faq_tabs_section_item_title',
                        'name'  => 'title',
                        'label' => 'Question',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_faq_tabs_section_item_answer',
                        'name'  => 'answer',
                        'label' => 'Answer',
                        'type'  => 'textarea',
                    ],
                ],
            ],
        ],
    ],
];
