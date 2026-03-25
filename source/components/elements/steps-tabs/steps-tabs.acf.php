<?php

createACFBlock(
    [
        'name'          => 'steps-tabs',
        'title'         => 'Steps Tabs',
        'category'      => 'theme-blocks',
        'icon'          => 'list-view',
        'mode'          => 'preview',
        'supports'      => ['align' => false],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'elements/steps-tabs/*.png')),
    ],
    [
        ['key' => 'field_tab_steps_tabs_content', 'label' => 'Content', 'type' => 'tab'],
        [
            'key'          => 'field_steps_tabs_items',
            'name'         => 'steps_tabs_items',
            'label'        => 'Tabs',
            'type'         => 'repeater',
            'layout'       => 'block',
            'button_label' => 'Add Tab',
            'sub_fields'   => [
                ['key' => 'field_steps_tabs_item_content', 'name' => 'content', 'label' => 'Content', 'type' => 'wysiwyg'],
            ],
        ],
        ['key' => 'field_tab_steps_tabs_layouting', 'label' => 'Layouting', 'type' => 'tab'],
        get_acf_margin_select_field(),
    ],
    function ($fields, $context) {
        component_steps_tabs(
            ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
            [
                'items' => ($fields['steps_tabs_items'] ?? null) ?: [],
            ]
        );
    }
);
