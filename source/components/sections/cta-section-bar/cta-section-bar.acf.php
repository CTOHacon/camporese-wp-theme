<?php

$fields = require __DIR__ . '/cta-section-bar.acf.fields.php';

createACFBlock(
    [
        'name'          => 'cta-section-bar',
        'title'         => 'CTA Section Bar',
        'category'      => 'theme-blocks',
        'icon'          => 'megaphone',
        'mode'          => 'preview',
        'supports'      => ['align' => false],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'cta-section-bar/*.png')),
    ],
    array_merge(
        [
            ['key' => 'field_tab_cta_section_bar_content', 'label' => 'Content', 'type' => 'tab'],
            [
                'key'     => 'field_cta_section_bar_info',
                'name'    => '',
                'label'   => '',
                'type'    => 'message',
                'message' => 'Default content is pulled from <a href="' . admin_url('admin.php?page=block-defaults-cta-section-bar') . '" target="_blank">CTA Section Bar</a> settings. Add values below to override.',
            ],
        ],
        $fields,
        [
            ['key' => 'field_tab_cta_section_bar_settings', 'label' => 'Settings', 'type' => 'tab'],
            get_acf_margin_select_field(),
        ]
    ),
    function ($fields, $context) {
        $button = ($fields['cta_section_bar_button'] ?? null) ?: [];

        component_cta_section_bar(
            ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
            [
                'title'         => $fields['cta_section_bar_title'] ?? null,
                'text'          => $fields['cta_section_bar_text'] ?? null,
                'button_url'    => $button['url'] ?? null,
                'button_title'  => $button['title'] ?? null,
                'button_target' => $button['target'] ?? null,
            ]
        );
    }
);
