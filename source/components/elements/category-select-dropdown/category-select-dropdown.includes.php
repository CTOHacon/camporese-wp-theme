<?php

/**
 * CategorySelectDropdown
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type array  $categories       List of categories [{title, link}]
 *     @type string $current_category Title of the currently active category (null if none)
 *     @type string $placeholder      Trigger label when no category is selected
 *     @type string $trigger_label    Computed: current category title or placeholder
 * }
 */
function component_category_select_dropdown($htmlAttributes = [], $props = [])
{
    $categories       = $props['categories'] ?? [];
    $current_category = $props['current_category'] ?? null;
    $placeholder      = ($props['placeholder'] ?? null) ?: 'All Categories';

    $trigger_label = $current_category ?: $placeholder;

    $props = [
        'categories'       => $categories,
        'current_category' => $current_category,
        'placeholder'      => $placeholder,
        'trigger_label'    => $trigger_label,
    ];

    render_component_template('category-select-dropdown', 'source/components/elements/category-select-dropdown/category-select-dropdown.php', $htmlAttributes, $props);
}
