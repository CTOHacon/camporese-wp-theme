<?php

return [
    [
        'key'           => 'field_citation_sidebar_widget_image',
        'name'          => 'citation_sidebar_widget_image',
        'label'         => 'Background Image',
        'type'          => 'image',
        'return_format' => 'id',
    ],
    [
        'key'          => 'field_citation_sidebar_widget_quote',
        'name'         => 'citation_sidebar_widget_quote',
        'label'        => 'Quote',
        'type'         => 'wysiwyg',
        'tabs'         => 'visual',
        'toolbar'      => 'basic',
        'media_upload' => 0,
        'instructions' => 'Use <em>italic</em> to highlight key phrases in the accent color.',
    ],
];
