<?php
/**
 * Separator
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $padding_top    Top padding size key
 *     @type string $padding_bottom Bottom padding size key
 * }
 */
function component_separator($htmlAttributes = [], $props = [])
{
    $props = [
        'padding_top'    => $props['padding_top'] ?? null,
        'padding_bottom' => $props['padding_bottom'] ?? null,
    ];

    render_component_template('separator', 'source/components/sections/separator/separator.php', $htmlAttributes, $props);
}
