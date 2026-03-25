<?php
/**
 * MapScreenshotSection
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type int $image Image attachment ID
 * }
 */
function component_map_screenshot_section($htmlAttributes = [], $props = [])
{
    $props = [
        'image' => ($props['image'] ?? null) ?: get_field('map_screenshot_section_image', 'option') ?: null,
    ];

    render_component_template('map-screenshot-section', 'source/components/sections/map-screenshot-section/map-screenshot-section.php', $htmlAttributes, $props);
}
