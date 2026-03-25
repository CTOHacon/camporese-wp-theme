<?php
/**
 * TechnicalPageHero
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $title           Hidden h1 title (SEO)
 *     @type int    $image           Image attachment ID
 *     @type string $secondary_title Secondary heading
 *     @type string $text            Description text
 *     @type string $button_url      Button link URL
 *     @type string $button_text     Button link text
 * }
 */
function component_technical_page_hero($htmlAttributes = [], $props = [])
{
    $props = [
        'title'           => $props['title'] ?? null,
        'image'           => $props['image'] ?? null,
        'secondary_title' => $props['secondary_title'] ?? null,
        'text'            => $props['text'] ?? null,
        'button_url'      => $props['button_url'] ?? null,
        'button_text'     => $props['button_text'] ?? null,
    ];

    render_component_template('technical-page-hero', 'source/components/sections/technical-page-hero/technical-page-hero.php', $htmlAttributes, $props);
}
