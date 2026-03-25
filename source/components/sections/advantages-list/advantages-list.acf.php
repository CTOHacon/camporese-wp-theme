<?php

$fields = require __DIR__ . '/advantages-list.acf.fields.php';

createACFBlock(
    [
        'name'          => 'advantages-list',
        'title'         => 'Advantages List',
        'category'      => 'theme-blocks',
        'icon'          => 'list-view',
        'mode'          => 'preview',
        'supports'      => ['align' => false],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'advantages-list/*.png')),
    ],
    [
        ['key' => 'field_tab_advantages_list_content', 'label' => 'Content', 'type' => 'tab'],
        [
            'key'     => 'field_advantages_list_info',
            'name'    => '',
            'label'   => '',
            'type'    => 'message',
            'message' => 'Default content is pulled from <a href="' . admin_url('admin.php?page=block-defaults-advantages-list') . '" target="_blank">Advantages List</a> settings. Add values below to override.',
        ],
        ...$fields,
        ['key' => 'field_tab_advantages_list_settings', 'label' => 'Settings', 'type' => 'tab'],
        get_acf_margin_select_field(),
    ],
    function ($fields, $context) {
        $items = ($fields['advantages_list_items'] ?? null) ?: [];

        component_advantages_list(
            ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
            ['items' => $items]
        );
    }
);
