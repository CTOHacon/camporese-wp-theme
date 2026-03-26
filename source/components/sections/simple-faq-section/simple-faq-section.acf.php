<?php

$fields = require __DIR__ . '/simple-faq-section.acf.fields.php';

createACFBlock(
    [
        'name'          => 'simple-faq-section',
        'title'         => 'Simple FAQ Section',
        'category'      => 'theme-blocks',
        'icon'          => 'editor-help',
        'mode'          => 'preview',
        'supports'      => ['align' => false],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'simple-faq-section/*.png')),
    ],
    [
        ['key' => 'field_tab_simple_faq_section_content', 'label' => 'Content', 'type' => 'tab'],
        [
            'key'     => 'field_simple_faq_section_info',
            'name'    => '',
            'label'   => '',
            'type'    => 'message',
            'message' => 'Default content is pulled from <a href="' . admin_url('admin.php?page=block-defaults-simple-faq-section') . '" target="_blank">Simple FAQ Section</a> settings. Add values below to override.',
        ],
        ...$fields,
        ['key' => 'field_tab_simple_faq_section_layouting', 'label' => 'Layouting', 'type' => 'tab'],
        get_acf_margin_select_field(),
    ],
    function ($fields, $context) {
        $items = ($fields['simple_faq_section_items'] ?? null) ?: [];

        component_simple_faq_section(
            ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
            [
                'title' => $fields['simple_faq_section_title'] ?? null,
                'text'  => $fields['simple_faq_section_text'] ?? null,
                'items' => $items,
            ]
        );
    }
);
