<?php
/**
 * SimpleFaqSection
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $title Section title
 *     @type string $text  Section description text
 *     @type array  $items FAQ items [{title, answer}]
 * }
 */
function component_simple_faq_section($htmlAttributes = [], $props = [])
{
    $global_title = get_field('simple_faq_section_title', 'option') ?: null;
    $global_text  = get_field('simple_faq_section_text', 'option') ?: null;
    $global_items = get_field('simple_faq_section_items', 'option') ?: [];

    $props = [
        'title' => ($props['title'] ?? null) ?: $global_title,
        'text'  => ($props['text'] ?? null) ?: $global_text,
        'items' => ($props['items'] ?? null) ?: $global_items,
    ];

    render_component_template('simple-faq-section', 'source/components/sections/simple-faq-section/simple-faq-section.php', $htmlAttributes, $props);
}
