<?php

/**
 * SimpleImagesGallery
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type array $images Image IDs array
 * }
 */
function component_simple_images_gallery($htmlAttributes = [], $props = [])
{
    $props = [
        'images' => $props['images'] ?? null,
    ];

    render_component_template('simple-images-gallery', 'source/components/elements/simple-images-gallery/simple-images-gallery.php', $htmlAttributes, $props);
}
