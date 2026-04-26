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
    $global_items = get_field('fancy_cards_list_items', 'option') ?: [];

    $items = !empty($props['items']) ? $props['items'] : $global_items;
    $count = count($items);
    if ($count % 4 === 0) {
        $cols = 4;
    } elseif ($count % 3 === 0 || $count % 2 !== 0) {
        $cols = 3;
    } else {
        $cols = 2;
    }

    $htmlAttributes['style'] = '--cols: ' . $cols;

    $props = [
        'items' => $items,
    ];

    render_component_template('fancy-cards-list', 'source/components/elements/fancy-cards-list/fancy-cards-list.php', $htmlAttributes, $props);
}
