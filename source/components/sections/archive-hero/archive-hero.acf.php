<?php

createACFBlock(
    [
        'name'          => 'archive-hero',
        'title'         => 'Archive Hero',
        'category'      => 'theme-blocks',
        'icon'          => 'heading',
        'mode'          => 'preview',
        'supports'      => ['align' => false],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'archive-hero/*.png')),
    ],
    [
        // ==========================================
        // ===== Content =====
        // ==========================================
        [
            'key'   => 'field_tab_archive_hero_content',
            'label' => 'Content',
            'type'  => 'tab',
        ],
        [
            'key'   => 'field_archive_hero_pretitle',
            'name'  => 'archive_hero_pretitle',
            'label' => 'Pretitle',
            'type'  => 'text',
        ],
        get_acf_heading_tag_field([
            'key'           => 'field_archive_hero_title_tag',
            'name'          => 'archive_hero_title_tag',
            'label'         => 'Title Tag',
            'default_value' => 'h1',
            'wrapper'       => ['width' => 30],
        ]),
        [
            'key'   => 'field_archive_hero_title',
            'name'  => 'archive_hero_title',
            'label' => 'Title',
            'type'  => 'text',
        ],
        [
            'key'  => 'field_archive_hero_text',
            'name' => 'archive_hero_text',
            'label' => 'Text',
            'type'         => 'textarea',
            'rows'         => 3,
            'instructions' => 'Recommended to use 2 lines of text.',
        ],

        // ==========================================
        // ===== Features =====
        // ==========================================
        [
            'key'   => 'field_tab_archive_hero_features',
            'label' => 'Features',
            'type'  => 'tab',
        ],
        [
            'key'           => 'field_archive_hero_show_breadcrumbs',
            'name'          => 'archive_hero_show_breadcrumbs',
            'label'         => 'Enable Breadcrumbs',
            'type'          => 'true_false',
            'default_value' => 1,
            'ui'            => 1,
        ],

        // ==========================================
        // ===== Layouting =====
        // ==========================================
        [
            'key'   => 'field_tab_archive_hero_layouting',
            'label' => 'Layouting',
            'type'  => 'tab',
        ],
        get_acf_margin_select_field(),
    ],
    function ($fields, $context) {
        component_archive_hero(
            ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
            [
                'pretitle'         => $fields['archive_hero_pretitle'] ?? null,
                'title'            => $fields['archive_hero_title'] ?? null,
                'title_tag'        => $fields['archive_hero_title_tag'] ?? 'h1',
                'text'             => $fields['archive_hero_text'] ?? null,
                'show_breadcrumbs' => $fields['archive_hero_show_breadcrumbs'] ?? true,
            ]
        );
    }
);
