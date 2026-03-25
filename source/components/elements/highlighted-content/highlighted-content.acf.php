<?php

createACFBlock(
    [
        'name'          => 'highlighted-content',
        'title'         => 'Highlighted Content',
        'category'      => 'theme-blocks',
        'icon'          => 'editor-quote',
        'mode'          => 'preview',
        'supports'      => [
            'align' => false,
            'jsx'   => true
        ],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'highlighted-content/*.png')),
    ],
    [
        get_acf_margin_select_field(),
    ],
    function ($fields, $context) {
        $content = $context['is_preview'] ? '<InnerBlocks />' : do_blocks($context['content']);

        component_highlighted_content(
            ['class' => [
                $fields['margin_bottom'] ?? null,
                $context['block']['className'] ?? null,
            ]],
            ['slot' => $content]
        );
    }
);
