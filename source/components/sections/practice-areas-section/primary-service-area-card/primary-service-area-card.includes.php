<?php
/**
 * PrimaryServiceAreaCard
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $title            Card title
 *     @type string $text             Card description
 *     @type string $link_url         Link URL
 *     @type string $link_title       Link text (shown next to arrow)
 *     @type string $link_target      Link target
 *     @type int    $image            Service image attachment ID
 * }
 */
function component_primary_service_area_card($htmlAttributes = [], $props = [])
{
    $props = [
        'title'       => $props['title'] ?? null,
        'text'        => $props['text'] ?? null,
        'link_url'    => $props['link_url'] ?? null,
        'link_title'  => $props['link_title'] ?? 'More',
        'link_target' => $props['link_target'] ?? null,
        'image'       => $props['image'] ?? null,
    ];

    render_component_template('primary-service-area-card', 'source/components/sections/practice-areas-section/primary-service-area-card/primary-service-area-card.php', $htmlAttributes, $props);
}
