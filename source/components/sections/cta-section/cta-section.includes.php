<?php
/**
 * CtaSection
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type int    $image            Image attachment ID
 *     @type string $image_label      Label overlay on the image
 *     @type int    $background_image Background image for content area
 *     @type string $title            Section title
 *     @type string $description      Section description
 *     @type string $button_url       Button URL
 *     @type string $button_title     Button label text
 *     @type string $button_target    Button link target
 * }
 */
function component_cta_section($htmlAttributes = [], $props = [])
{
    $global_button = get_field('cta_section_button', 'option') ?: [];

    $props = [
        'image'            => ($props['image'] ?? null) ?: get_field('cta_section_image', 'option') ?: null,
        'image_label'      => ($props['image_label'] ?? null) ?: get_field('cta_section_image_label', 'option') ?: null,
        'background_image' => ($props['background_image'] ?? null) ?: get_field('cta_section_background_image', 'option') ?: null,
        'title'            => ($props['title'] ?? null) ?: get_field('cta_section_title', 'option') ?: null,
        'description'      => ($props['description'] ?? null) ?: get_field('cta_section_description', 'option') ?: null,
        'button_url'       => ($props['button_url'] ?? null) ?: $global_button['url'] ?? null,
        'button_title'     => ($props['button_title'] ?? null) ?: $global_button['title'] ?? null,
        'button_target'    => ($props['button_target'] ?? null) ?: $global_button['target'] ?? null,
    ];

    render_component_template('cta-section', 'source/components/sections/cta-section/cta-section.php', $htmlAttributes, $props);
}
