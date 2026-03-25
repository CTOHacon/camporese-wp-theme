<?php

/**
 * HighlightedContent
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $slot HTML content (InnerBlocks)
 * }
 */
function component_highlighted_content($htmlAttributes = [], $props = [])
{
    $props = [
        'slot' => $props['slot'] ?? null,
    ];

    render_component_template('highlighted-content', 'source/components/elements/highlighted-content/highlighted-content.php', $htmlAttributes, $props);
}
