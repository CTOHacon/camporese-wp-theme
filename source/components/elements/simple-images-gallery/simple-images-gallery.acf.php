<?php

createACFBlock(
    [
        'name'     => 'simple-images-gallery',
        'title'    => 'Simple Images Gallery',
        'category' => 'theme-blocks',
        'icon'     => 'format-gallery',
        'mode'     => 'preview',
        'supports' => ['align' => false],
    ],
    [
        [
            'key'           => 'field_simple_images_gallery_images',
            'name'          => 'images',
            'type'          => 'gallery',
            'return_format' => 'id'
        ],
        get_acf_margin_select_field(),
    ],
    function ($fields, $context) {
        component_simple_images_gallery(
            ['class' => [
                $fields['margin_bottom'] ?? null,
                $context['block']['className'] ?? null
            ]],
            $fields
        );
    }
);
