<?php

return [
    [
        'key'           => 'field_contact_section_form_title',
        'label'         => 'Form Title',
        'name'          => 'contact_section_form_title',
        'type'          => 'text',
        'instructions'  => 'Leave empty to use global Contact Form title.',
    ],
    [
        'key'           => 'field_contact_section_form_text',
        'label'         => 'Form Text',
        'name'          => 'contact_section_form_text',
        'type'          => 'textarea',
        'instructions'  => 'Leave empty to use global Contact Form text.',
    ],
    [
        'key'           => 'field_contact_section_form_legal_note',
        'label'         => 'Legal Note',
        'name'          => 'contact_section_form_legal_note',
        'type'          => 'textarea',
        'instructions'  => 'HTML allowed. Leave empty to use global Contact Form legal note.',
    ],
    [
        'key'           => 'field_contact_section_map_image',
        'label'         => 'Map Image',
        'name'          => 'contact_section_map_image',
        'type'          => 'image',
        'return_format' => 'id',
        'instructions'  => 'Map image displayed on the right side. Falls back to global contacts map image.',
    ],
];
