<?php

$fields = require __DIR__ . '/practice-areas-section.acf.fields.php';

createACFBlock(
    [
        'name'          => 'practice-areas-section',
        'title'         => 'Practice Areas Section',
        'category'      => 'theme-blocks',
        'icon'          => 'admin-site',
        'mode'          => 'preview',
        'supports'      => ['align' => false],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'practice-areas-section/*.png')),
    ],
    [
        ['key' => 'field_tab_pas_content', 'label' => 'Content', 'type' => 'tab'],
        [
            'key'     => 'field_pas_info',
            'name'    => '',
            'label'   => '',
            'type'    => 'message',
            'message' => 'Default content is pulled from <a href="' . admin_url('admin.php?page=block-defaults-practice-areas-section') . '" target="_blank">Practice Areas Section</a> settings. Add values below to override.',
        ],
        ...$fields,
        ['key' => 'field_tab_pas_layouting', 'label' => 'Layouting', 'type' => 'tab'],
        get_acf_margin_select_field(),
    ],
    function ($fields, $context) {
        $items = ($fields['pas_items'] ?? null) ?: [];
        foreach ($items as &$item) {
            $link = $item['link'] ?? [];
            $item['link_url']    = $link['url']    ?? null;
            $item['link_title']  = $link['title']  ?? null;
            $item['link_target'] = $link['target'] ?? null;
            unset($item['link']);
        }
        unset($item);

        component_practice_areas_section(
            ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
            [
                'title'     => $fields['pas_title'] ?? null,
                'title_tag' => $fields['pas_title_tag'] ?? 'h2',
                'text'      => $fields['pas_text'] ?? null,
                'items'     => $items,
            ]
        );
    }
);
