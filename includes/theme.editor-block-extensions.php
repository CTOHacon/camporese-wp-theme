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
        'marginOptions'           => $options,
        'relevantContentPrefixes' => apply_filters('camporese/relevant_content_prefixes', ['acf/']),
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

// === Relevant Content System ===
// Automatically registers a "Needs Relevant Content" toggle on each
// Block Defaults options page that has a matching ACF block.

add_action('acf/init', function () {
    $prefixes = apply_filters('camporese/relevant_content_prefixes', ['acf/']);
    $blockTypes = acf_get_block_types();

    foreach ($blockTypes as $fullName => $blockType) {
        $matchesPrefix = false;
        foreach ($prefixes as $prefix) {
            if (str_starts_with($fullName, $prefix)) {
                $matchesPrefix = true;
                break;
            }
        }
        if (!$matchesPrefix) continue;

        $shortName = $blockType['name'];
        $optionPageSlug = 'block-defaults-' . $shortName;

        if (!acf_get_options_page($optionPageSlug)) continue;

        $fieldName = 'relevant_content_' . str_replace('-', '_', $shortName);

        acf_add_local_field_group([
            'key'    => 'group_' . $fieldName,
            'title'  => 'Relevant Content',
            'fields' => [
                [
                    'key'           => 'field_' . $fieldName,
                    'name'          => $fieldName,
                    'label'         => 'Needs Relevant Content',
                    'type'          => 'true_false',
                    'default_value' => 0,
                    'ui'            => 1,
                ],
            ],
            'location' => [
                [['param' => 'options_page', 'operator' => '==', 'value' => $optionPageSlug]],
            ],
        ]);
    }
}, 20);

add_filter('render_block', function (string $blockContent, array $block) {
    $prefixes = apply_filters('camporese/relevant_content_prefixes', ['acf/']);

    $blockName = $block['blockName'] ?? '';
    $matchesPrefix = false;
    foreach ($prefixes as $prefix) {
        if (str_starts_with($blockName, $prefix)) {
            $matchesPrefix = true;
            break;
        }
    }
    if (!$matchesPrefix) return $blockContent;

    $status = $block['attrs']['relevantContentStatus'] ?? '';
    $needsClass = false;

    if ($status === 'needs-content') {
        $needsClass = true;
    } elseif ($status === '' || $status === null) {
        $shortName = substr($blockName, strpos($blockName, '/') + 1);
        $fieldName = 'relevant_content_' . str_replace('-', '_', $shortName);
        $needsClass = (bool) get_field($fieldName, 'option');
    }
    // 'filled' — $needsClass stays false

    if (!$needsClass) return $blockContent;

    $class = '_needs-relevant-content';

    $blockContent = preg_replace(
        '/(^\s*<\w+\b[^>]*\bclass=")/is',
        '$1' . $class . ' ',
        $blockContent,
        1,
        $count
    );

    if ($count === 0) {
        $blockContent = preg_replace(
            '/(^\s*<\w+\b)/is',
            '$1 class="' . $class . '"',
            $blockContent,
            1
        );
    }

    return $blockContent;
}, 10, 2);
