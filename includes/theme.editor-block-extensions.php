<?php

add_action('enqueue_block_editor_assets', function () {
    wp_enqueue_script(
        'camporese-editor-block-extensions',
        get_template_directory_uri() . '/source/scripts/editor-block-extensions.js',
        ['wp-blocks', 'wp-element', 'wp-compose', 'wp-block-editor', 'wp-components', 'wp-hooks'],
        filemtime(get_template_directory() . '/source/scripts/editor-block-extensions.js'),
        true
    );

    $marginChoices = ['' => 'Initial'] + get_acf_utility_choices('mb', false);
    $options = [];
    foreach ($marginChoices as $value => $label) {
        $options[] = ['value' => $value, 'label' => $label];
    }
    wp_localize_script('camporese-editor-block-extensions', 'camporeseBlockExtensions', [
        'marginOptions' => $options,
    ]);
});

add_filter('render_block', function (string $blockContent, array $block) {
    if (!in_array($block['blockName'], ['core/paragraph', 'core/heading', 'core/separator'])) {
        return $blockContent;
    }

    $classes = [];

    if (!empty($block['attrs']['hasAccentClass'])) {
        $classes[] = '_is-accent';
    }
    if (!empty($block['attrs']['hasOpacityClass'])) {
        $classes[] = '_has-opacity';
    }
    if (!empty($block['attrs']['marginBottom'])) {
        $classes[] = sanitize_html_class($block['attrs']['marginBottom']);
    }

    if (empty($classes)) {
        return $blockContent;
    }

    $classString = implode(' ', $classes);

    // Inject classes into the first HTML tag
    $blockContent = preg_replace(
        '/^(<(?:p|h[1-6]|hr)\b([^>]*)\bclass=")/i',
        '$1' . $classString . ' ',
        $blockContent,
        1,
        $count
    );

    // If no class attribute exists, add one
    if ($count === 0) {
        $blockContent = preg_replace(
            '/^(<(?:p|h[1-6]|hr)\b)/i',
            '$1 class="' . $classString . '"',
            $blockContent,
            1
        );
    }

    return $blockContent;
}, 10, 2);
