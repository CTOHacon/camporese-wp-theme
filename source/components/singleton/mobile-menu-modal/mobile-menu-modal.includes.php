<?php
/**
 * MobileMenuModal
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type array  $nav_items   Header nav items [{link: {url, title, target}, submenu: [{link}]}]
 *     @type string $phone       Phone number
 * }
 */
function component_mobile_menu_modal($htmlAttributes = [], $props = [])
{
    $props = [
        'practice_areas_columns' => ($props['practice_areas_columns'] ?? null) ?: get_field('practice_areas_menu_columns', 'option') ?: [],
        'nav_items'              => ($props['nav_items'] ?? null) ?: get_field('field_header_menu', 'option') ?: [],
        'phone'                  => ($props['phone'] ?? null) ?: get_field('field_phone', 'option') ?: null,
    ];

    render_component_template('mobile-menu-modal', 'source/components/singleton/mobile-menu-modal/mobile-menu-modal.php', $htmlAttributes, $props);
}
