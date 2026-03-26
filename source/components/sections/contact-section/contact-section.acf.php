<?php

$fields = require __DIR__ . '/contact-section.acf.fields.php';

createACFBlock(
    [
        'name'          => 'contact-section',
        'title'         => 'Contact Section',
        'category'      => 'theme-blocks',
        'icon'          => 'email',
        'mode'          => 'preview',
        'supports'      => ['align' => false],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'contact-section/*.png')),
    ],
    [
        ['key' => 'field_tab_contact_section_content', 'label' => 'Content', 'type' => 'tab'],
        [
            'key'     => 'field_contact_section_info',
            'name'    => '',
            'label'   => '',
            'type'    => 'message',
            'message' => 'Default content is pulled from <a href="' . admin_url('admin.php?page=block-defaults-contact-section') . '" target="_blank">Contact Section</a> settings and <a href="' . admin_url('admin.php?page=theme-parts-contact-forms') . '" target="_blank">Contact Forms</a> global settings. Add values below to override.',
        ],
        ...$fields,
        ['key' => 'field_tab_contact_section_layouting', 'label' => 'Layouting', 'type' => 'tab'],
        get_acf_margin_select_field(),
    ],
    function ($fields, $context) {
        component_contact_section(
            ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
            [
                'form_title'      => $fields['contact_section_form_title'] ?? null,
                'form_text'       => $fields['contact_section_form_text'] ?? null,
                'form_legal_note' => $fields['contact_section_form_legal_note'] ?? null,
                'map_image'       => $fields['contact_section_map_image'] ?? null,
            ]
        );
    }
);
