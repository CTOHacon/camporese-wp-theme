<?php

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

    $blockContent = preg_replace(
        '/^(<(?:p|h[1-6]|hr)\b([^>]*)\bclass=")/i',
        '$1' . $classString . ' ',
        $blockContent,
        1,
        $count
    );

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
