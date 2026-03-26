<?php

$citationFields = require get_template_directory() . '/source/components/elements/citation-sidebar-widget/citation-sidebar-widget.acf.fields.php';

createACFBlock(
    [
        'name'     => 'content-with-citation-aside',
        'title'    => 'Content with Citation Aside',
        'category' => 'theme-blocks',
        'icon'     => 'columns',
        'mode'     => 'preview',
        'supports' => [
            'align'  => false,
            'anchor' => true,
            'jsx'    => true,
            'mode'   => true,
        ],
    ],
    array_merge(
        [
            [
                'key'   => 'field_cwca_tab_citation',
                'label' => 'Citation',
                'type'  => 'tab',
            ],
            [
                'key'     => 'field_cwca_citation_note',
                'label'   => '',
                'name'    => '',
                'type'    => 'message',
                'message' => 'Leave empty to use the global Citation Sidebar Widget defaults.',
            ],
        ],
        array_map(function ($field) {
            $field['key'] = 'field_cwca_' . $field['name'];
            return $field;
        }, $citationFields),
        [
            [
                'key'   => 'field_cwca_tab_settings',
                'label' => 'Settings',
                'type'  => 'tab',
            ],
            get_acf_margin_select_field(),
        ]
    ),
    function ($fields, $context) {
        $allowedBlocks = wp_json_encode([
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
        ]);

        $content = $context['is_preview']
            ? '<InnerBlocks allowedBlocks="' . esc_attr($allowedBlocks) . '" />'
            : do_blocks($context['content']);

        component_content_with_citation_aside(
            ['class' => [
                $fields['margin_bottom'] ?? null,
                $context['block']['className'] ?? null,
            ]],
            [
                'citation_image' => $fields['citation_sidebar_widget_image'] ?? null,
                'citation_quote' => $fields['citation_sidebar_widget_quote'] ?? null,
                'slot'           => $content,
            ]
        );
    }
);
