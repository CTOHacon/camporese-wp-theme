<?php
/**
 * ContentBlock
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $aside_position  Aside position (left|right)
 *     @type string $main_align      Main content vertical alignment (top|middle|bottom)
 *     @type string $aside_type      Aside content type (image|before_after)
 *     @type int    $image           Image attachment ID (when aside_type=image)
 *     @type array  $before_after    Before/after items [{before_image, after_image}]
 *     @type string $slot            HTML content (InnerBlocks)
 * }
 */
function component_content_block($htmlAttributes = [], $props = [])
{
    $props = [
        'aside_position' => $props['aside_position'] ?? 'right',
        'main_align'     => $props['main_align'] ?? 'top',
        'aside_type'     => $props['aside_type'] ?? 'image',
        'image'          => $props['image'] ?? null,
        'before_after'   => $props['before_after'] ?? [],
        'slot'           => $props['slot'] ?? null,
    ];

    render_component_template('content-block', 'source/components/sections/content-block/content-block.php', $htmlAttributes, $props);
}
