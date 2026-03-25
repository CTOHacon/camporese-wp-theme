<?php
/**
 * PreheaderBadge
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $tagname Wrapper element tag (span|div)
 *     @type string $theme   Color theme modifier (green)
 *     @type string $slot    HTML content
 * }
 */
function component_preheader_badge($htmlAttributes = [], $props = [])
{
    $props = [
        'tagname' => $props['tagname'] ?? 'span',
        'theme'   => $props['theme'] ?? 'green',
        'slot'    => $props['slot'] ?? null,
    ];

    render_component_template('preheader-badge', 'source/components/singleton/preheader-badge/preheader-badge.php', $htmlAttributes, $props);
}
