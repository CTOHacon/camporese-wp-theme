<?php
/**
 * FaqList
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type array $items FAQ items [{title, answer}]
 * }
 */
function component_faq_list($htmlAttributes = [], $props = [])
{
    $props = [
        'items' => $props['items'] ?: get_field('faq_list_items', 'option') ?: [],
    ];

    if (empty($props['items'])) return;

    render_component_template('faq-list', 'source/components/elements/faq-list/faq-list.php', $htmlAttributes, $props);
}
