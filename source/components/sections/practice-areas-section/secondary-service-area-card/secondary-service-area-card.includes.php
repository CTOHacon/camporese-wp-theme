<?php
/**
 * SecondaryServiceAreaCard
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $title            Card title
 *     @type string $text             Card description
 *     @type string $link_url         Link URL
 *     @type string $link_title       Link accessible text
 *     @type string $link_target      Link target
 *     @type int    $image            Service image attachment ID
 * }
 */
function component_secondary_service_area_card($htmlAttributes = [], $props = [])
{
    $props = [
        'title'       => $props['title'] ?? null,
        'text'        => $props['text'] ?? null,
        'link_url'    => $props['link_url'] ?? null,
        'link_title'  => $props['link_title'] ?? null,
        'link_target' => $props['link_target'] ?? null,
        'image'       => $props['image'] ?? null,
    ];

    render_component_template('secondary-service-area-card', 'source/components/sections/practice-areas-section/secondary-service-area-card/secondary-service-area-card.php', $htmlAttributes, $props);
}
