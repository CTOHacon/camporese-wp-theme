<?php

/**
 * Image
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type int        $reference Image attachment ID
 *     @type string     $size      Image size
 *     @type boolean    $lazy      Use lazy loading ('eager'|'lazy'), defaults to true (lazy)
 * }
 */
function component_image($htmlAttributes = [], $props = [])
{
    render_component_template('image', 'source/components/core/image/image.php',
        $htmlAttributes,
        $props,
    );
}