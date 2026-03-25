<?php

/**
 * ContactSection
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $form_title       Form title (overrides block default)
 *     @type string $form_text        Form description text (overrides block default)
 *     @type string $form_legal_note  Legal note HTML (overrides block default)
 *     @type int    $decoration_image Form decoration image attachment ID (overrides block default)
 *     @type string $info_title       Contact info section title (overrides block default)
 *     @type string $info_text        Contact info section text (overrides block default)
 *     @type string $email            Contact email (overrides contacts global)
 *     @type string $address          Contact address text (overrides contacts global)
 *     @type string $maps_link        Google Maps URL (overrides contacts global)
 *     @type int    $map_image        Map image attachment ID (overrides contacts global)
 * }
 */
function component_contact_section($htmlAttributes = [], $props = [])
{
    // Block defaults
    $global_form_title        = get_field('contact_section_form_title', 'option');
    $global_form_text         = get_field('contact_section_form_text', 'option');
    $global_form_legal_note   = get_field('contact_section_form_legal_note', 'option');
    $global_decoration_image  = get_field('contact_section_decoration_image', 'option');
    $global_info_title        = get_field('contact_section_info_title', 'option');
    $global_info_text         = get_field('contact_section_info_text', 'option');

    // Contacts global settings
    $global_email      = get_field('field_email', 'option');
    $global_address    = get_field('field_address', 'option');
    $global_maps_link  = get_field('field_maps_link', 'option');
    $global_map_image  = get_field('field_map_image', 'option');

    $props = [
        'form_title'       => $props['form_title'] ?: $global_form_title ?: null,
        'form_text'        => $props['form_text'] ?: $global_form_text ?: null,
        'form_legal_note'  => $props['form_legal_note'] ?: $global_form_legal_note ?: null,
        'decoration_image' => $props['decoration_image'] ?: $global_decoration_image ?: null,
        'info_title'       => $props['info_title'] ?: $global_info_title ?: null,
        'info_text'        => $props['info_text'] ?: $global_info_text ?: null,
        'email'            => $props['email'] ?? $global_email ?? null,
        'address'          => $props['address'] ?? $global_address ?? null,
        'maps_link'        => $props['maps_link'] ?? $global_maps_link ?? null,
        'map_image'        => $props['map_image'] ?? $global_map_image ?? null,
    ];

    render_component_template('contact-section', 'source/components/sections/contact-section/contact-section.php', $htmlAttributes, $props);
}
