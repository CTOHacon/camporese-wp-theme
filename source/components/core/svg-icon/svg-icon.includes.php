<?php
/**
 * SvgIcon
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $name Icon name
 * }
 */

global $svg_icon_icons_url;
$svg_icon_icons_base_path = '/source/components/core/svg-icon/icons.svg';
$svg_icon_icons_url       = get_template_directory_uri() . $svg_icon_icons_base_path . '?v=' . filemtime(get_template_directory() . $svg_icon_icons_base_path);

/**
 * SvgIcon
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $name Icon name
 *     @type string $icon_file_url URL to the SVG icons file. Defaults to the theme's svg-icon/icons.svg
 * }
 */
function component_svg_icon($htmlAttributes = [], $props = [])
{
    if (!isset($props['icon_file_url'])) {
        global $svg_icon_icons_url;
        $props['icon_file_url'] = $svg_icon_icons_url;
    }

    render_component_template('svg-icon', 'source/components/core/svg-icon/svg-icon.php',
        $htmlAttributes,
        $props,
    );
}