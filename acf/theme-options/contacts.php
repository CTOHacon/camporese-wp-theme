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
    ],
    'location' => [
        [[
            'param'    => 'options_page',
            'operator' => '==',
            'value'    => 'contacts'
        ]],
    ],
]);