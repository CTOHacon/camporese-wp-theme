<?php
/**
 * AdvantagesList
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type array $items List items [{icon, title, text}]
 * }
 */
function component_advantages_list($htmlAttributes = [], $props = [])
{
    $global_items = get_field('advantages_list_items', 'option') ?: [];

    $props = [
        'items' => $props['items'] ?: $global_items,
    ];

    render_component_template('advantages-list', 'source/components/sections/advantages-list/advantages-list.php', $htmlAttributes, $props);
}
