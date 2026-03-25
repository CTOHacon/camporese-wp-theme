<?php

return [
    // Form configuration
    [
        'key'           => 'field_contact_section_form_title',
        'label'         => 'Form Title',
        'name'          => 'contact_section_form_title',
        'type'          => 'text',
        'default_value' => 'Get In Touch With Us',
    ],
    [
        'key'           => 'field_contact_section_form_text',
        'label'         => 'Form Text',
        'name'          => 'contact_section_form_text',
        'type'          => 'textarea',
        'default_value' => 'Use Our Convenient Contact Form To Reach Out With Questions, Feedback, Or Collaboration Inquiries.',
    ],
    [
        'key'           => 'field_contact_section_form_legal_note',
        'label'         => 'Legal Note',
        'name'          => 'contact_section_form_legal_note',
        'type'          => 'textarea',
        'instructions'  => 'HTML allowed. Displayed below the phone button.',
        'default_value' => 'Lorem Ipsum Dolor Set Amet <a href="/privacy-policy">Privacy Policy</a> And <a href="/terms-of-use">Terms Of Use</a>',
    ],
    [
        'key'           => 'field_contact_section_decoration_image',
        'label'         => 'Form Decoration Image',
        'name'          => 'contact_section_decoration_image',
        'type'          => 'image',
        'return_format' => 'id',
        'instructions'  => 'Side decoration image shown inside the contact form.',
    ],
    // Contact info section
    [
        'key'           => 'field_contact_section_info_title',
        'label'         => 'Contact Info Title',
        'name'          => 'contact_section_info_title',
        'type'          => 'text',
        'default_value' => 'Or Call Or Mail Us',
    ],
    [
        'key'           => 'field_contact_section_info_text',
        'label'         => 'Contact Info Text',
        'name'          => 'contact_section_info_text',
        'type'          => 'textarea',
        'default_value' => 'Reach Out To Us For Inquiries, Support, Or Partnership Opportunities, We\'re Here To Assist.',
    ],
];
