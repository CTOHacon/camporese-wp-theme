<?php
/**
 * CtaSectionBar
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $title          Title text
 *     @type string $text           Body text
 *     @type string $button_url     Button URL
 *     @type string $button_title   Button label text
 *     @type string $button_target  Button link target
 * }
 */
function component_cta_section_bar($htmlAttributes = [], $props = [])
{
    $global_button = get_field('cta_section_bar_button', 'option') ?: [];

    $props = [
        'title'         => ($props['title'] ?? null) ?: get_field('cta_section_bar_title', 'option') ?: null,
        'text'          => ($props['text'] ?? null) ?: get_field('cta_section_bar_text', 'option') ?: null,
        'button_url'    => ($props['button_url'] ?? null) ?: $global_button['url'] ?? null,
        'button_title'  => ($props['button_title'] ?? null) ?: $global_button['title'] ?? null,
        'button_target' => ($props['button_target'] ?? null) ?: $global_button['target'] ?? null,
    ];

    render_component_template('cta-section-bar', 'source/components/sections/cta-section-bar/cta-section-bar.php', $htmlAttributes, $props);
}
