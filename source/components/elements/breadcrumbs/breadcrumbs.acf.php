<?php
createACFBlock(
    [
        'name'          => 'breadcrumbs',
        'title'         => 'Breadcrumbs Block',
        'category'      => 'theme-blocks',
        'icon'          => 'admin-links',
        'mode'          => 'preview',
        'supports'      => [
            'align' => false,
        ],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'breadcrumbs/*.png'))
    ],
    [
        get_acf_margin_select_field(),
        [
            'key'           => 'field_breadcrumbs_theme',
            'label'         => 'Theme',
            'name'          => 'theme',
            'type'          => 'select',
            'choices'       => [
                ''      => 'Dark (default)',
                'light' => 'Light',
            ],
            'default_value' => '',
            'return_format' => 'value',
        ],
    ],
    function ($fields, $data) {
        component_breadcrumbs(
            [
                'class' => [
                    $fields['margin_bottom'] ?? null,
                    $data['block']['className'] ?? null,
                ],
            ],
            $fields
        );
    }
);