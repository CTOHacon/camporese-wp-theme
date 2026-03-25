<?php
/**
 * FaqSection
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $head_title Section head title
 *     @type string $head_text  Section head text
 *     @type array  $items      FAQ items [{title, answer}]
 * }
 */
function component_faq_section($htmlAttributes = [], $props = [])
{
    $global_items = get_field('faq_section_items', 'option') ?: [];

    $props = [
        'head_title' => $props['head_title'] ?: get_field('faq_section_head_title', 'option'),
        'head_text'  => $props['head_text']  ?: get_field('faq_section_head_text', 'option'),
        'items'      => $props['items'] ?: $global_items,
    ];

    render_component_template('faq-section', 'source/components/sections/faq-section/faq-section.php', $htmlAttributes, $props);
}
