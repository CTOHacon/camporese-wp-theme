<?php

createACFBlock(
    [
        'name'          => 'contacts-section',
        'title'         => 'Contacts Section',
        'category'      => 'theme-blocks',
        'icon'          => 'phone',
        'mode'          => 'preview',
        'supports'      => ['align' => false],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'contacts-section/*.png')),
    ],
    [
        ['key' => 'field_tab_contacts_section_content', 'label' => 'Content', 'type' => 'tab'],
        [
            'key'     => 'field_contacts_section_info',
            'name'    => '',
            'label'   => '',
            'type'    => 'message',
            'message' => 'Contact details are pulled from <a href="' . admin_url('admin.php?page=contacts') . '" target="_blank">Contacts</a> global settings.',
        ],
        [
            'key'          => 'field_contacts_section_phone_description',
            'label'        => 'Phone Description',
            'name'         => 'contacts_section_phone_description',
            'type'         => 'textarea',
            'rows'         => 2,
            'instructions' => 'Override global phone description. Recommended to use 3 lines of text.',
        ],
        [
            'key'          => 'field_contacts_section_address_description',
            'label'        => 'Address Description',
            'name'         => 'contacts_section_address_description',
            'type'         => 'textarea',
            'rows'         => 2,
            'instructions' => 'Override global address description. Recommended to use 3 lines of text.',
        ],
        [
            'key'          => 'field_contacts_section_email_description',
            'label'        => 'Email Description',
            'name'         => 'contacts_section_email_description',
            'type'         => 'textarea',
            'rows'         => 2,
            'instructions' => 'Override global email description. Recommended to use 3 lines of text.',
        ],
        ['key' => 'field_tab_contacts_section_layouting', 'label' => 'Layouting', 'type' => 'tab'],
        get_acf_margin_select_field(),
    ],
    function ($fields, $context) {
        component_contacts_section(
            ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
            [
                'phone_description'   => $fields['contacts_section_phone_description'] ?? null,
                'address_description' => $fields['contacts_section_address_description'] ?? null,
                'email_description'   => $fields['contacts_section_email_description'] ?? null,
            ]
        );
    }
);
