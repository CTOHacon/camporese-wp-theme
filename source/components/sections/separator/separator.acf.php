<?php

createACFBlock(
    [
        'name'          => 'separator',
        'title'         => 'Separator',
        'category'      => 'theme-blocks',
        'icon'          => 'minus',
        'mode'          => 'preview',
        'supports'      => ['align' => false],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'separator/*.png')),
    ],
    [
        ['key' => 'field_tab_separator_layouting', 'label' => 'Layouting', 'type' => 'tab'],
        get_acf_size_select_field([
            'key'   => 'field_separator_padding_top',
            'name'  => 'padding_top',
            'label' => 'Padding Top',
            'sizes' => ['1', '1-5', '2', '2-5', '3', '3-5', '4', '4-5', '5', '5-5', '6', '6-5', '8'],
        ]),
        get_acf_size_select_field([
            'key'   => 'field_separator_padding_bottom',
            'name'  => 'padding_bottom',
            'label' => 'Padding Bottom',
            'sizes' => ['1', '1-5', '2', '2-5', '3', '3-5', '4', '4-5', '5', '5-5', '6', '6-5', '8'],
        ]),
        get_acf_margin_select_field(),
    ],
    function ($fields, $context) {
        component_separator(
            ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
            [
                'padding_top'    => $fields['padding_top'] ?? null,
                'padding_bottom' => $fields['padding_bottom'] ?? null,
            ]
        );
    }
);
