<?php

/**
 * SortByDropdown
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type array  $options       List of sort options [{title, value}]
 *     @type string $current_sort  Currently active sort value
 *     @type string $trigger_label Computed: current sort title
 * }
 */
function component_sort_by_dropdown($htmlAttributes = [], $props = [])
{
    $current_sort = $props['current_sort'] ?: 'newest';

    $options = [
        ['title' => 'Newest',  'value' => 'newest'],
        ['title' => 'Oldest',  'value' => 'oldest'],
    ];

    // Build links preserving current URL params
    $current_url = remove_query_arg('sort');
    foreach ($options as &$option) {
        $option['link'] = $option['value'] === 'newest'
            ? $current_url
            : add_query_arg('sort', $option['value'], $current_url);
    }
    unset($option);

    // Determine trigger label
    $active = array_filter($options, fn($o) => $o['value'] === $current_sort);
    $trigger_label = $active ? reset($active)['title'] : 'Sort By';

    $props = [
        'options'       => $options,
        'current_sort'  => $current_sort,
        'trigger_label' => $trigger_label,
    ];

    render_component_template('sort-by-dropdown', 'source/components/elements/sort-by-dropdown/sort-by-dropdown.php', $htmlAttributes, $props);
}
