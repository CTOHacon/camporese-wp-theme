<?php
/**
 * BackgroundWrapper
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $bg_color       Background color (_white|_grey)
 *     @type string $bg_layout      Background layout (_full|_container)
 *     @type string $padding_top    Top padding size key
 *     @type string $padding_bottom Bottom padding size key
 *     @type string $slot           Inner blocks HTML content
 * }
 */
function component_background_wrapper($htmlAttributes = [], $props = [])
{
    $props = [
        'bg_color'       => $props['bg_color'] ?? '_white',
        'bg_layout'      => $props['bg_layout'] ?? '_full',
        'padding_top'    => $props['padding_top'] ?? null,
        'padding_bottom' => $props['padding_bottom'] ?? null,
        'slot'           => $props['slot'] ?? null,
    ];

    render_component_template('background-wrapper', 'source/components/sections/background-wrapper/background-wrapper.php', $htmlAttributes, $props);
}
