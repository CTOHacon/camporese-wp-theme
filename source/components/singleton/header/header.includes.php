<?php
/**
 * Header
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type array  $logo       Logo image array from ACF (id, url, alt)
 *     @type array  $nav_items  Navigation items [{link: {url, title, target}}]
 *     @type string $phone      Phone number string
 * }
 */
function component_header($htmlAttributes = [], $props = [])
{
    $props = [
        'logo'      => ($props['logo'] ?? null) ?: get_field('field_logo', 'option') ?: null,
        'nav_items' => ($props['nav_items'] ?? null) ?: get_field('field_header_menu', 'option') ?: [],
        'phone'     => ($props['phone'] ?? null) ?: get_field('field_phone', 'option') ?: null,
    ];

    render_component_template("header", "source/components/singleton/header/header.php",
        $htmlAttributes,
        $props
    );
}
