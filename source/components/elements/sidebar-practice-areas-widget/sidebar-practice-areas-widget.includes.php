<?php
/**
 * SidebarPracticeAreasWidget
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type array $items Practice area items [{title, link_url, link_title, link_target, image}]
 * }
 */
function component_sidebar_practice_areas_widget($htmlAttributes = [], $props = [])
{
    $global_items = get_field('spaw_items', 'option') ?: [];

    // Flatten link sub-fields if not already flattened
    foreach ($global_items as &$item) {
        if (isset($item['link']) && is_array($item['link'])) {
            $link = $item['link'];
            $item['link_url']    = $link['url']    ?? null;
            $item['link_title']  = $link['title']  ?? null;
            $item['link_target'] = $link['target'] ?? null;
            unset($item['link']);
        }
    }
    unset($item);

    $props = [
        'items' => ($props['items'] ?? null) ?: $global_items,
    ];

    render_component_template('sidebar-practice-areas-widget', 'source/components/elements/sidebar-practice-areas-widget/sidebar-practice-areas-widget.php', $htmlAttributes, $props);
}
