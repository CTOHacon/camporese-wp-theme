<?php
acf_add_options_sub_page([
    'page_title'  => 'Contact Forms',
    'menu_title'  => 'Contact Forms',
    'parent_slug' => 'contacts',
    'menu_slug'   => 'contacts-contact-forms',
]);

acf_add_local_field_group([
    'key'      => 'group_contacts_contact_forms',
    'title'    => 'Contacts - Contact Forms',
    'fields'   => [
        [
            'key'          => 'field_telegram_bot_key',
            'label'        => 'Telegram Bot Key',
            'name'         => 'field_telegram_bot_key',
            'type'         => 'text',
            'instructions' => 'Enter the Telegram bot key for sending messages.',
            'wrapper'      => ['width' => 50],
        ],
        [
            'key'          => 'field_telegram_chat_id',
            'label'        => 'Telegram Chat ID',
            'name'         => 'field_telegram_chat_id',
            'type'         => 'text',
            'instructions' => 'Enter the Telegram chat ID for sending messages.',
            'wrapper'      => ['width' => 50],
        ],
        [
            'key'        => 'field_contact_form_emails',
            'label'      => 'Email Addresses for Form Submissions',
            'name'       => 'field_contact_form_emails',
            'type'       => 'repeater',
            'layout'     => 'table',
            'sub_fields' => [
                [
                    'key'          => 'field_contact_email',
                    'label'        => 'Email Address',
                    'name'         => 'email',
                    'type'         => 'text',
                    'instructions' => 'Enter an email address to receive form submissions.',
                ],
            ],
        ],
        [
            'key'          => 'field_thank_you_page_link',
            'label'        => 'Thank You Page Link',
            'name'         => 'field_thank_you_page_link',
            'type'         => 'text',
            'instructions' => 'Enter the link to the page that the user will be redirected to after submitting the form.',
        ],
    ],
    'location' => [
        [[
            'param'    => 'options_page',
            'operator' => '==',
            'value'    => 'contacts-contact-forms'
        ]],
    ],
]);