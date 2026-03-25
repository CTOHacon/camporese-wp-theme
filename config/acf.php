<?php
return [
    'sources' => [
        'acf/post-meta/*.php',
        'acf/term-meta/*.php',
        'acf/theme-options/*.php',
        'acf/user-meta/*.php',
        path_join(getThemeСonfig('components.base'), '**/*.acf.php')
    ]
];