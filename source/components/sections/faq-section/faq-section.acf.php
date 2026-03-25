<?php

$fields = require __DIR__ . '/faq-section.acf.fields.php';

createACFBlock(
    [
        'name'          => 'faq-section',
        'title'         => 'FAQ Section',
        'category'      => 'theme-blocks',
        'icon'          => 'editor-help',
        'mode'          => 'preview',
        'supports'      => ['align' => false, 'anchor' => true],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'faq-section/*.png')),
    ],
    [
        ['key' => 'field_tab_faq_section_content', 'label' => 'Content', 'type' => 'tab'],
        [
            'key'     => 'field_faq_section_info',
            'name'    => '',
            'label'   => '',
            'type'    => 'message',
            'message' => 'Default content is pulled from <a href="' . admin_url('admin.php?page=block-defaults-faq-section') . '" target="_blank">FAQ Section</a> settings. Add values below to override.',
        ],
        ...$fields,
        ['key' => 'field_tab_faq_section_settings', 'label' => 'Settings', 'type' => 'tab'],
        get_acf_margin_select_field(),
    ],
    function ($fields, $context) {
        $items = ($fields['faq_section_items'] ?? null) ?: [];

        component_faq_section(
            ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
            [
                'head_title' => $fields['faq_section_head_title'] ?? null,
                'head_text'  => $fields['faq_section_head_text'] ?? null,
                'items'      => $items,
            ]
        );
    }
);
