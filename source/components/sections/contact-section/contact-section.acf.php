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
    array_merge(
        [['key' => 'field_tab_contact_section_content', 'label' => 'Content', 'type' => 'tab']],
        $fields,
        [['key' => 'field_tab_contact_section_settings', 'label' => 'Settings', 'type' => 'tab']],
        [get_acf_margin_select_field()]
    ),
    function ($fields, $context) {
        component_contact_section(
            ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
            [
                'form_title'         => $fields['contact_section_form_title'] ?? null,
                'form_text'          => $fields['contact_section_form_text'] ?? null,
                'form_legal_note'    => $fields['contact_section_form_legal_note'] ?? null,
                'decoration_image'   => $fields['contact_section_decoration_image'] ?? null,
                'info_title'         => $fields['contact_section_info_title'] ?? null,
                'info_text'          => $fields['contact_section_info_text'] ?? null,
            ]
        );
    }
);
