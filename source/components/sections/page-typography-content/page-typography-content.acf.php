<?php

createACFBlock(
    [
        'name'           => 'page-typography-content',
        'title'          => 'Page Typography Content',
        'category'       => 'theme-blocks',
        'icon'           => 'admin-page',
        'mode'           => 'preview',
        'allowed_blocks' => [
            'core/heading',
            'core/paragraph',
            'core/list',
            'core/separator',

            'acf/separator',
            'acf/steps-tabs',
            'acf/fancy-cards-list',
            'acf/faq-list',
            'acf/partner-logos',
            'acf/highlighted-content',
            'acf/blockquote',

            'acf/simple-images-gallery',
        ],
        'supports'       => [
            'align' => false,
            'jsx'   => true
        ],
        'preview_image'  => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'page-typography-content/*.png')),
    ],
    [
        [
            'key'   => 'field_tab_ptc_content',
            'label' => 'Content',
            'type'  => 'tab'
        ],
        [
            'key'   => 'field_ptc_pre_title',
            'name'  => 'ptc_pre_title',
            'label' => 'Pre Title',
            'type'  => 'text'
        ],
        get_acf_heading_tag_field([
            'key'           => 'field_ptc_pre_title_tag',
            'name'          => 'ptc_pre_title_tag',
            'label'         => 'Pre Title Tag',
            'default_value' => 'p'
        ]),
        [
            'key'   => 'field_ptc_title',
            'name'  => 'ptc_title',
            'label' => 'Title',
            'type'  => 'text'
        ],
        get_acf_heading_tag_field([
            'key'           => 'field_ptc_title_tag',
            'name'          => 'ptc_title_tag',
            'label'         => 'Title Tag',
            'default_value' => 'h2'
        ]),
        [
            'key'           => 'field_ptc_image',
            'name'          => 'ptc_image',
            'label'         => 'Image',
            'type'          => 'image',
            'return_format' => 'id'
        ],
        [
            'key'   => 'field_tab_ptc_layouting',
            'label' => 'Layouting',
            'type'  => 'tab'
        ],
        [
            'key'           => 'field_ptc_enable_breadcrumbs',
            'name'          => 'ptc_enable_breadcrumbs',
            'label'         => 'Enable Breadcrumbs',
            'type'          => 'true_false',
            'default_value' => 0,
            'ui'            => 1,
        ],
        get_acf_margin_select_field(['default_value' => 'mb-1']),
    ],
    function ($fields, $context) {
        $content = $context['is_preview'] ? '<InnerBlocks />' : do_blocks($context['content']);

        component_page_typography_content(
            ['class' => [
                $fields['margin_bottom'] ?? null,
                $context['block']['className'] ?? null
            ]],
            [
                'pre_title'          => $fields['ptc_pre_title'] ?? null,
                'pre_title_tag'      => $fields['ptc_pre_title_tag'] ?? null,
                'title'              => $fields['ptc_title'] ?? null,
                'title_tag'          => $fields['ptc_title_tag'] ?? null,
                'image'              => $fields['ptc_image'] ?? null,
                'slot'               => $content,
                'enable_breadcrumbs' => !empty($fields['ptc_enable_breadcrumbs']),
            ]
        );
    }
);
