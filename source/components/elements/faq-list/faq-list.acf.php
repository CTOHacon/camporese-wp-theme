<?php

$fields = require __DIR__ . '/faq-list.acf.fields.php';

createACFBlock(
    [
        'name'          => 'faq-list',
        'title'         => 'FAQ List',
        'category'      => 'theme-blocks',
        'icon'          => 'editor-help',
        'mode'          => 'preview',
        'supports'      => ['align' => false, 'anchor' => true],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'faq-list/*.png')),
    ],
    [
        ['key' => 'field_tab_faq_list_content', 'label' => 'Content', 'type' => 'tab'],
        ...$fields,
        ['key' => 'field_tab_faq_list_settings', 'label' => 'Settings', 'type' => 'tab'],
        get_acf_margin_select_field(),
    ],
    function ($fields, $context) {
        component_faq_list(
            ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
            ['items' => $fields['faq_list_items'] ?? []]
        );
    }
);
