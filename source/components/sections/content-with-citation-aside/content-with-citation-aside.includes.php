<?php
/**
 * ContentWithCitationAside
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type int|null    $citation_image Citation image ID (falls back to global)
 *     @type string|null $citation_quote Citation quote HTML (falls back to global)
 *     @type string      $slot           Inner blocks HTML content
 * }
 */
function component_content_with_citation_aside($htmlAttributes = [], $props = [])
{
    $props = [
        'citation_image' => $props['citation_image'] ?? null,
        'citation_quote' => $props['citation_quote'] ?? null,
        'slot'           => $props['slot'] ?? '',
    ];

    render_component_template('content-with-citation-aside', 'source/components/sections/content-with-citation-aside/content-with-citation-aside.php', $htmlAttributes, $props);
}
