<?php

acf_add_options_sub_page([
    'page_title'  => 'Contact Forms',
    'menu_title'  => 'Contact Forms',
    'parent_slug' => 'theme-parts',
    'menu_slug'   => 'theme-parts-contact-forms',
]);
acf_add_local_field_group([
    'key'      => 'group_theme_parts_contact_forms',
    'title'    => 'Theme Parts - Contact Forms',
    'fields'   => [
        [
            'key'        => 'field_contact_form',
            'label'      => 'Contact Form',
            'name'       => 'field_contact_form',
            'type'       => 'group',
            'layout'     => 'block',
            'sub_fields' => [
                [
                    'key'           => 'field_cf_title',
                    'label'         => 'Title',
                    'name'          => 'title',
                    'type'          => 'text',
                    'default_value' => 'Get In Touch With Us',
                ],
                [
                    'key'           => 'field_cf_text',
                    'label'         => 'Text',
                    'name'          => 'text',
                    'type'          => 'textarea',
                    'default_value' => 'Use Our Convenient Contact Form To Reach Out With Questions, Feedback, Or Collaboration Inquiries.',
                ],
                [
                    'key'           => 'field_cf_legal_note',
                    'label'         => 'Legal Note',
                    'name'          => 'legal_note',
                    'type'          => 'textarea',
                    'default_value' => 'Lorem Ipsum Dolor Set Amet <a href="/privacy-policy">Privacy Policy</a> And <a href="/terms-of-use">Terms Of Use</a>',
                    'instructions'  => 'HTML allowed. Displayed below the phone button.',
                ],
            ],
        ],
        [
            'key'        => 'field_contact_form_services',
            'label'      => 'Services',
            'name'       => 'field_contact_form_services',
            'type'       => 'repeater',
            'layout'     => 'table',
            'min'        => 0,
            'max'        => 0,
            'instructions' => 'Options for the "Service Needed" dropdown in the contact form.',
            'sub_fields' => [
                [
                    'key'   => 'field_contact_form_service_label',
                    'label' => 'Service',
                    'name'  => 'label',
                    'type'  => 'text',
                ],
            ],
        ],
        [
            'key'           => 'field_fancy_form_decoration_image',
            'label'         => 'Fancy Form Decoration Image',
            'name'          => 'field_fancy_form_decoration_image',
            'type'          => 'image',
            'return_format' => 'id',
            'instructions'  => 'Side decoration image for the fancy contact form variant.',
        ],
    ],
    'location' => [
        [
            [
                'param'    => 'options_page',
                'operator' => '==',
                'value'    => 'theme-parts-contact-forms'
            ],
        ],
    ],
]);
