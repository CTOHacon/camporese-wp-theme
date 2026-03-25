<?php

/**
 * PageTypographyContentBase — shared layout renderer.
 * Not a standalone component — called from concrete implementations
 * (page-typography-content, blog-page-typography-content).
 *
 * @param array $props {
 *     @type string   $pre_title     Pre-title text
 *     @type string   $pre_title_tag Pre-title HTML tag
 *     @type string   $title         Title text
 *     @type string   $title_tag     Title HTML tag
 *     @type int      $image         Image attachment ID
 *     @type string   $slot          Main content HTML
 *     @type callable $sidebar_slot  Closure that outputs sidebar content
 * }
 */
function render_page_typography_content_base($props = [])
{
    $pre_title     = $props['pre_title'] ?? null;
    $pre_title_tag = $props['pre_title_tag'] ?? 'p';
    $title         = $props['title'] ?? null;
    $title_tag     = $props['title_tag'] ?? 'h1';
    $image         = $props['image'] ?? null;
    $slot          = $props['slot'] ?? null;
    $sidebar_slot  = $props['sidebar_slot'] ?? null;

    include __DIR__ . '/page-typography-content-base.php';
}
