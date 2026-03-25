<?php
/**
 * PracticeAreasSection
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $title     Section title
 *     @type string $title_tag Heading tag (h2|h3)
 *     @type string $text      Section description
 *     @type array  $items     Service area cards [{title, text, link_url, link_title, link_target, image, background_image}]
 * }
 */
function component_practice_areas_section($htmlAttributes = [], $props = [])
{
    $global_title = get_field('pas_title', 'option') ?: null;
    $global_text  = get_field('pas_text', 'option') ?: null;
    $global_items = get_field('pas_items', 'option') ?: [];

    $items = ($props['items'] ?? null) ?: $global_items;

    // Flatten link sub-fields if not already flattened (global defaults have raw ACF structure)
    foreach ($items as &$item) {
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
        'title'     => ($props['title'] ?? null) ?: $global_title,
        'title_tag' => $props['title_tag'] ?? 'h2',
        'text'      => ($props['text'] ?? null) ?: $global_text,
        'items'     => $items,
    ];

    render_component_template('practice-areas-section', 'source/components/sections/practice-areas-section/practice-areas-section.php', $htmlAttributes, $props);
}
