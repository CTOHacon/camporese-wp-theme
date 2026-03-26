<?php

/**
 * PageTypographyContent
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $pre_title     Pre-title text
 *     @type string $pre_title_tag Pre-title HTML tag
 *     @type string $title         Title text
 *     @type string $title_tag     Title HTML tag
 *     @type int    $image         Image attachment ID
 *     @type string $slot          HTML content from InnerBlocks
 * }
 */
function component_page_typography_content($htmlAttributes = [], $props = [])
{
    $props = [
        'pre_title'          => $props['pre_title'] ?? null,
        'pre_title_tag'      => $props['pre_title_tag'] ?? 'p',
        'title'              => $props['title'] ?? null,
        'title_tag'          => $props['title_tag'] ?? 'h1',
        'image'              => $props['image'] ?? null,
        'slot'               => $props['slot'] ?? null,
        'enable_breadcrumbs' => $props['enable_breadcrumbs'] ?? false,
    ];

    render_component_template('page-typography-content', 'source/components/sections/page-typography-content/page-typography-content.php', $htmlAttributes, $props);
}
