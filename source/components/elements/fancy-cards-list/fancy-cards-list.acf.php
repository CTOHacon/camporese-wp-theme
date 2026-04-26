<?php

$fields = require __DIR__ . '/fancy-cards-list.acf.fields.php';

createACFBlock(
    [
        'name'          => 'fancy-cards-list',
        'title'         => 'Fancy Cards List',
        'category'      => 'theme-blocks',
        'icon'          => 'grid-view',
        'mode'          => 'preview',
        'supports'      => ['align' => false],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'fancy-cards-list/*.png')),
    ],
    [
        ['key' => 'field_tab_fancy_cards_list_content', 'label' => 'Content', 'type' => 'tab'],
        [
            'key'     => 'field_fancy_cards_list_info',
            'name'    => '',
            'label'   => '',
            'type'    => 'message',
            'message' => 'Default content is pulled from <a href="' . admin_url('admin.php?page=block-defaults-fancy-cards-list') . '" target="_blank">Fancy Cards List</a> settings. Add values below to override.',
        ],
        ...$fields,
        ['key' => 'field_tab_fancy_cards_list_layouting', 'label' => 'Layouting', 'type' => 'tab'],
        get_acf_margin_select_field(),
    ],
    function ($fields, $context) {
        component_fancy_cards_list(
            ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
            [
                'items' => ($fields['fancy_cards_list_items'] ?? null) ?: [],
            ]
        );
    }
);
