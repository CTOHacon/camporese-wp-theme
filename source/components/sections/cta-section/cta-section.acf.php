<?php

$fields = require __DIR__ . '/cta-section.acf.fields.php';

createACFBlock(
    [
        'name'          => 'cta-section',
        'title'         => 'CTA Section',
        'category'      => 'theme-blocks',
        'icon'          => 'megaphone',
        'mode'          => 'preview',
        'supports'      => ['align' => false],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'cta-section/*.png')),
    ],
    array_merge(
        [
            ['key' => 'field_tab_cta_section_content', 'label' => 'Content', 'type' => 'tab'],
            [
                'key'     => 'field_cta_section_info',
                'name'    => '',
                'label'   => '',
                'type'    => 'message',
                'message' => 'Default content is pulled from <a href="' . admin_url('admin.php?page=block-defaults-cta-section') . '" target="_blank">CTA Section</a> settings. Add values below to override.',
            ],
        ],
        $fields,
        [
            ['key' => 'field_tab_cta_section_layouting', 'label' => 'Layouting', 'type' => 'tab'],
            get_acf_margin_select_field(),
        ]
    ),
    function ($fields, $context) {
        $button = ($fields['cta_section_button'] ?? null) ?: [];

        component_cta_section(
            ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
            [
                'image'            => $fields['cta_section_image'] ?? null,
                'image_label'      => $fields['cta_section_image_label'] ?? null,
                'background_image' => $fields['cta_section_background_image'] ?? null,
                'title'            => $fields['cta_section_title'] ?? null,
                'description'      => $fields['cta_section_description'] ?? null,
                'button_url'       => $button['url'] ?? null,
                'button_title'     => $button['title'] ?? null,
                'button_target'    => $button['target'] ?? null,
            ]
        );
    }
);
