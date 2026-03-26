<?php
/**
 * TechnicalPageHero
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type int    $image           Image attachment ID
 *     @type string $heading         Main heading
 *     @type string $subtitle        Subtitle text
 *     @type string $text            Description text
 *     @type string $button_url      Button link URL
 *     @type string $button_text     Button link text
 * }
 */
function component_technical_page_hero($htmlAttributes = [], $props = [])
{
    $props = [
        'image'       => $props['image'] ?? null,
        'heading'     => $props['heading'] ?? null,
        'subtitle'    => $props['subtitle'] ?? null,
        'text'        => $props['text'] ?? null,
        'button_url'  => $props['button_url'] ?? null,
        'button_text' => $props['button_text'] ?? null,
    ];

    render_component_template('technical-page-hero', 'source/components/sections/technical-page-hero/technical-page-hero.php', $htmlAttributes, $props);
}
