<?php

$fields = require __DIR__ . '/technical-page-hero.acf.fields.php';

createACFBlock(
    [
        'name'          => 'technical-page-hero',
        'title'         => 'Technical Page Hero',
        'category'      => 'theme-blocks',
        'icon'          => 'admin-site',
        'mode'          => 'preview',
        'supports'      => ['align' => false],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'technical-page-hero/*.png')),
    ],
    [
        [
            'key'   => 'field_tab_technical_page_hero_content',
            'label' => 'Content',
            'type'  => 'tab'
        ],
        ...$fields,
        [
            'key'   => 'field_tab_technical_page_hero_settings',
            'label' => 'Settings',
            'type'  => 'tab'
        ],
        get_acf_margin_select_field(),
    ],
    function ($fields, $context) {
        $link                  = $fields['technical_page_hero_button'] ?? [];
        $fields['button_url']  = $link['url'] ?? null;
        $fields['button_text'] = $link['title'] ?? null;

        component_technical_page_hero(
            ['class' => [
                $fields['margin_bottom'] ?? null,
                $context['block']['className'] ?? null
            ]],
            [
                'image'       => $fields['technical_page_hero_image'] ?? null,
                'heading'     => $fields['technical_page_hero_secondary_title'] ?? null,
                'subtitle'    => $fields['technical_page_hero_subtitle'] ?? null,
                'text'        => $fields['technical_page_hero_text'] ?? null,
                'button_url'  => $fields['button_url'],
                'button_text' => $fields['button_text'],
            ]
        );
    }
);
