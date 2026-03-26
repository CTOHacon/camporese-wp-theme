<?php

$fields = require __DIR__ . '/faq-tabs-section.acf.fields.php';

createACFBlock(
    [
        'name'          => 'faq-tabs-section',
        'title'         => 'FAQ Tabs Section',
        'category'      => 'theme-blocks',
        'icon'          => 'editor-help',
        'mode'          => 'preview',
        'supports'      => ['align' => false],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'sections/faq-tabs-section/*.png')),
    ],
    [
        ['key' => 'field_tab_faq_tabs_section_content', 'label' => 'Content', 'type' => 'tab'],
        [
            'key'     => 'field_faq_tabs_section_info',
            'name'    => '',
            'label'   => '',
            'type'    => 'message',
            'message' => 'Default content is pulled from <a href="' . admin_url('admin.php?page=block-defaults-faq-tabs-section') . '" target="_blank">FAQ Tabs Section</a> settings. Add values below to override.',
        ],
        ...$fields,
        ['key' => 'field_tab_faq_tabs_section_layouting', 'label' => 'Layouting', 'type' => 'tab'],
        get_acf_margin_select_field(),
    ],
    function ($fields, $context) {
        $tabs = ($fields['faq_tabs_section_tabs'] ?? null) ?: [];

        component_faq_tabs_section(
            ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
            [
                'tabs' => $tabs,
            ]
        );
    }
);
