<?php
/**
 * AsideCtaAddWidget
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type int    $image             Background image attachment ID
 *     @type string $title             Title text
 *     @type string $slogan            Slogan HTML (supports i, strong, span)
 *     @type string $phone_label       Label before phone number
 *     @type string $bottom_badge_text Bottom badge text
 * }
 */
function component_aside_cta_add_widget($htmlAttributes = [], $props = [])
{
    $global = [
        'image'             => get_field('aside_cta_add_widget_image', 'option'),
        'title'             => get_field('aside_cta_add_widget_title', 'option'),
        'slogan'            => get_field('aside_cta_add_widget_slogan', 'option'),
        'phone_label'       => get_field('aside_cta_add_widget_phone_label', 'option'),
        'bottom_badge_text' => get_field('aside_cta_add_widget_bottom_badge_text', 'option'),
    ];

    $phone_value = get_field('field_phone', 'option');
    $phone_href  = $phone_value ? 'tel:' . preg_replace('/[^0-9+]/', '', $phone_value) : null;

    $props = [
        'image'             => ($props['image'] ?? null) ?: $global['image'],
        'title'             => ($props['title'] ?? null) ?: $global['title'],
        'slogan'            => ($props['slogan'] ?? null) ?: $global['slogan'],
        'phone_label'       => ($props['phone_label'] ?? null) ?: $global['phone_label'] ?: 'Call Now',
        'phone_value'       => $phone_value,
        'phone_href'        => $phone_href,
        'bottom_badge_text' => ($props['bottom_badge_text'] ?? null) ?: $global['bottom_badge_text'],
    ];

    render_component_template('aside-cta-add-widget', 'source/components/elements/aside-cta-add-widget/aside-cta-add-widget.php', $htmlAttributes, $props);
}
