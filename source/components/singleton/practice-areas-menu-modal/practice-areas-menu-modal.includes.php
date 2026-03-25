<?php
/**
 * PracticeAreasMenuModal
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type array $columns Menu columns [{title, image, links: [{link}]}]
 * }
 */
function component_practice_areas_menu_modal($htmlAttributes = [], $props = [])
{
    $props = [
        'columns' => ($props['columns'] ?? null) ?: get_field('practice_areas_menu_columns', 'option') ?: [],
    ];

    render_component_template('practice-areas-menu-modal', 'source/components/singleton/practice-areas-menu-modal/practice-areas-menu-modal.php', $htmlAttributes, $props);
}
