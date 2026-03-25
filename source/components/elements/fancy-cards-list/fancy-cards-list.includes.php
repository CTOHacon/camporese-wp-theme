<?php
/**
 * FancyCardsList
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type array $items Cards [{title, text}]
 * }
 */
function component_fancy_cards_list($htmlAttributes = [], $props = [])
{
    $props = [
        'items' => $props['items'] ?? [],
    ];

    render_component_template('fancy-cards-list', 'source/components/elements/fancy-cards-list/fancy-cards-list.php', $htmlAttributes, $props);
}
