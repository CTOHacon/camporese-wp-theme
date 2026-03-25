<?php

createACFBlock(
    [
        'name'          => 'blockquote',
        'title'         => 'Blockquote',
        'category'      => 'theme-blocks',
        'icon'          => 'format-quote',
        'mode'          => 'preview',
        'supports'      => ['align' => false],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'blockquote/*.png')),
    ],
    [
        [
            'key'   => 'field_blockquote_title',
            'name'  => 'title',
            'label' => 'Title',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_blockquote_text',
            'name'  => 'text',
            'label' => 'Text',
            'type'  => 'textarea',
        ],
        get_acf_margin_select_field(),
    ],
    function ($fields, $context) {
        component_blockquote(
            ['class' => [
                $fields['margin_bottom'] ?? null,
                $context['block']['className'] ?? null
            ]],
            $fields
        );
    }
);
