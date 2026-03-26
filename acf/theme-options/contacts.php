<?php

acf_add_options_page([
    'page_title' => 'Contacts',
    'menu_title' => 'Contacts',
    'menu_slug'  => 'contacts',
    'capability' => 'edit_theme_options',
    'icon_url'   => 'dashicons-phone',
    'redirect'   => false,
]);
acf_add_local_field_group([
    'key'      => 'group_contacts',
    'title'    => 'Contacts',
    'fields'   => [
        [
            'key'           => 'field_email',
            'label'         => 'Email',
            'name'          => 'field_email',
            'type'          => 'text',
            'default_value' => 'mail@example.com',
        ],
        [
            'key'           => 'field_phone',
            'label'         => 'Phone',
            'name'          => 'field_phone',
            'type'          => 'text',
            'default_value' => '(000) 000-0000',
        ],
        [
            'key'   => 'field_address',
            'label' => 'Address',
            'name'  => 'field_address',
            'type'  => 'text',
        ],
        [
            'key'          => 'field_maps_link',
            'label'        => 'Maps Link',
            'name'         => 'field_maps_link',
            'type'         => 'url',
            'instructions' => 'Google Maps URL for the address link. If empty, address renders as plain text.',
        ],
        [
            'key'           => 'field_map_image',
            'label'         => 'Map Image',
            'name'          => 'field_map_image',
            'type'          => 'image',
            'return_format' => 'id',
            'instructions'  => 'Map/location image displayed in the contact section.',
        ],
        [
            'key'   => 'field_phone_description',
            'label' => 'Phone Description',
            'name'  => 'field_phone_description',
            'type'  => 'textarea',
            'rows'  => 2,
            'instructions' => 'Short description text displayed below the phone number in the contacts section.',
        ],
        [
            'key'   => 'field_address_description',
            'label' => 'Address Description',
            'name'  => 'field_address_description',
            'type'  => 'textarea',
            'rows'  => 2,
            'instructions' => 'Short description text displayed below the address in the contacts section.',
        ],
        [
            'key'   => 'field_email_description',
            'label' => 'Email Description',
            'name'  => 'field_email_description',
            'type'  => 'textarea',
            'rows'  => 2,
            'instructions' => 'Short description text displayed below the email in the contacts section.',
        ],
    ],
    'location' => [
        [[
            'param'    => 'options_page',
            'operator' => '==',
            'value'    => 'contacts'
        ]],
    ],
]);