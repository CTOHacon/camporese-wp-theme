<?php

createACFBlock(
    [
        'name'          => 'background-wrapper',
        'title'         => 'Background Wrapper',
        'category'      => 'theme-blocks',
        'icon'          => 'cover-image',
        'mode'          => 'preview',
        'supports'      => [
            'align' => false,
            'jsx'   => true,
        ],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'background-wrapper/*.png')),
    ],
    [
        [
            'key'   => 'field_tab_bg_wrapper_content',
            'label' => 'Content',
            'type'  => 'tab',
        ],
        [
            'key'           => 'field_bg_wrapper_bg_color',
            'name'          => 'bg_color',
            'label'         => 'Background Color',
            'type'          => 'select',
            'choices'       => [
                '_white' => 'White',
                '_grey'  => 'Grey',
            ],
            'default_value' => '_white',
        ],
        [
            'key'           => 'field_bg_wrapper_bg_layout',
            'name'          => 'bg_layout',
            'label'         => 'Background Layout',
            'type'          => 'select',
            'choices'       => [
                '_full'      => 'Full Width',
                '_container' => 'Container',
            ],
            'default_value' => '_full',
        ],

        [
            'key'   => 'field_tab_bg_wrapper_settings',
            'label' => 'Settings',
            'type'  => 'tab',
        ],
        get_acf_size_select_field([
            'key'   => 'field_bg_wrapper_padding_top',
            'name'  => 'padding_top',
            'label' => 'Padding Top',
            'sizes' => ['1', '17px', '1-25', '1-5', '1-75', '2', '2-25', '2-5', '3', '3-5', '4', '4-5', '5', '5-5', '6', '6-5'],
        ]),
        get_acf_size_select_field([
            'key'   => 'field_bg_wrapper_padding_bottom',
            'name'  => 'padding_bottom',
            'label' => 'Padding Bottom',
            'sizes' => ['1', '17px', '1-25', '1-5', '1-75', '2', '2-25', '2-5', '3', '3-5', '4', '4-5', '5', '5-5', '6', '6-5'],
        ]),
        get_acf_margin_select_field(),
    ],
    function ($fields, $context) {
        $content = $context['is_preview'] ? '<InnerBlocks />' : do_blocks($context['content']);

        component_background_wrapper(
            ['class' => [
                $fields['margin_bottom'] ?? null,
                $context['block']['className'] ?? null,
            ]],
            [
                'bg_color'       => $fields['bg_color'] ?? '_white',
                'bg_layout'      => $fields['bg_layout'] ?? '_full',
                'padding_top'    => $fields['padding_top'] ?? null,
                'padding_bottom' => $fields['padding_bottom'] ?? null,
                'slot'           => $content,
            ]
        );
    }
);
