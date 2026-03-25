<?php
/**
 * Simple Link Button
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $slot Link text content
 * }
 */
function component_simple_link_button($htmlAttributes = [], $props = [])
{
    render_component_template('simple-link-button', 'source/components/elements/simple-link-button/simple-link-button.php', $htmlAttributes, $props);
}
