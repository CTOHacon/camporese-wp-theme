<?php

// Connected in: includes/theme.editor-block-extensions.php

require_once __DIR__ . '/style-classes.render.php';

add_action('enqueue_block_editor_assets', function () {
    wp_enqueue_script(
        'camporese-style-classes',
        get_template_directory_uri() . '/source/editor-block-extensions/style-classes.js',
        ['wp-blocks', 'wp-element', 'wp-compose', 'wp-block-editor', 'wp-components', 'wp-hooks'],
        filemtime(get_template_directory() . '/source/editor-block-extensions/style-classes.js'),
        true
    );

    $marginChoices = ['' => 'Initial'] + get_acf_utility_choices('mb', false);
    $options = [];
    foreach ($marginChoices as $value => $label) {
        $options[] = ['value' => $value, 'label' => $label];
    }
    wp_localize_script('camporese-style-classes', 'camporeseBlockExtensions', [
        'marginOptions' => $options,
    ]);
});
