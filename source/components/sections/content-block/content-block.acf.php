<?php

createACFBlock(
    [
        'name'          => 'content-block',
        'title'         => 'Content Block',
        'category'      => 'theme-blocks',
        'icon'          => 'media-document',
        'mode'          => 'preview',
        'supports'      => [
            'align'  => false,
            'anchor' => true,
            'jsx'    => true,
            'mode'   => true,
        ],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'content-block/*.png')),
    ],
    [
        // --- Aside tab ---
        [
            'key'   => 'field_cb_tab_aside',
            'label' => 'Aside',
            'type'  => 'tab'
        ],
        [
            'key'           => 'field_cb_aside_type',
            'name'          => 'aside_type',
            'label'         => 'Aside Type',
            'type'          => 'select',
            'choices'       => [
                'image'        => 'Single Image',
                'before_after' => 'Before / After',
            ],
            'default_value' => 'image',
        ],
        [
            'key'               => 'field_cb_image',
            'name'              => 'image',
            'label'             => 'Image',
            'type'              => 'image',
            'return_format'     => 'id',
            'conditional_logic' => [
                [[
                    'field'    => 'field_cb_aside_type',
                    'operator' => '==',
                    'value'    => 'image'
                ]],
            ],
        ],
        [
            'key'               => 'field_cb_before_after',
            'name'              => 'before_after',
            'label'             => 'Before / After Items',
            'type'              => 'repeater',
            'layout'            => 'block',
            'button_label'      => 'Add Before/After',
            'conditional_logic' => [
                [[
                    'field'    => 'field_cb_aside_type',
                    'operator' => '==',
                    'value'    => 'before_after'
                ]],
            ],
            'sub_fields'        => [
                [
                    'key'           => 'field_cb_ba_before_image',
                    'name'          => 'before_image',
                    'label'         => 'Before Image',
                    'type'          => 'image',
                    'return_format' => 'id',
                    'wrapper'       => ['width' => 50]
                ],
                [
                    'key'           => 'field_cb_ba_after_image',
                    'name'          => 'after_image',
                    'label'         => 'After Image',
                    'type'          => 'image',
                    'return_format' => 'id',
                    'wrapper'       => ['width' => 50]
                ],
            ],
        ],

        // --- Configuration tab ---
        [
            'key'   => 'field_cb_tab_settings',
            'label' => 'Configuration',
            'type'  => 'tab'
        ],
        [
            'key'           => 'field_cb_aside_position',
            'name'          => 'aside_position',
            'label'         => 'Aside Position',
            'type'          => 'select',
            'choices'       => [
                'right' => 'Right',
                'left'  => 'Left',
            ],
            'default_value' => 'right',
            'wrapper'       => ['width' => 33],
        ],
        [
            'key'           => 'field_cb_main_align',
            'name'          => 'main_align',
            'label'         => 'Main Align',
            'type'          => 'select',
            'choices'       => [
                'top'    => 'Top',
                'middle' => 'Middle',
                'bottom' => 'Bottom',
            ],
            'default_value' => 'top',
            'wrapper'       => ['width' => 33],
        ],
        get_acf_margin_select_field(['wrapper' => ['width' => 33]]),
    ],
    function ($fields, $context) {
        $allowedBlocks = wp_json_encode([
            'core/heading',
            'core/paragraph',
            'core/list',

            'acf/separator',
            'acf/steps-tabs',
            'acf/fancy-cards-list',
            'acf/faq-list',
            'acf/partner-logos',
            'acf/highlighted-content',
        ]);

        $content = $context['is_preview']
            ? '<InnerBlocks allowedBlocks="' . esc_attr($allowedBlocks) . '" />'
            : do_blocks($context['content']);

        component_content_block(
            ['class' => [
                $fields['margin_bottom'] ?? null,
                $context['block']['className'] ?? null
            ]],
            $fields + ['slot' => $content]
        );
    }
);
