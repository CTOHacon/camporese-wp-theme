<?php
/**
 * Button
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $type Button type modifier ([solid-dark|solid-bordered-accent-transparent])
 * }
 */
function component_button($htmlAttributes = [], $props = [])
{
    render_component_template('button', 'source/components/core/button/button.php', $htmlAttributes, $props);
}