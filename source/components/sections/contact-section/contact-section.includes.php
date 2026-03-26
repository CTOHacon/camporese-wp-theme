<?php

/**
 * ContactSection
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $form_title      Form title (overrides global contact form title)
 *     @type string $form_text       Form description text (overrides global)
 *     @type string $form_legal_note Legal note HTML (overrides global)
 *     @type int    $map_image       Map image attachment ID (overrides global contacts map image)
 * }
 */
function component_contact_section($htmlAttributes = [], $props = [])
{
    // Block defaults
    $bd_form_title      = get_field('contact_section_form_title', 'option');
    $bd_form_text       = get_field('contact_section_form_text', 'option');
    $bd_form_legal_note = get_field('contact_section_form_legal_note', 'option');
    $bd_map_image       = get_field('contact_section_map_image', 'option');

    // Global contact form settings (theme-parts.contact-forms.php)
    $global_form = get_field('field_contact_form', 'option') ?: [];

    // Global contacts map image
    $global_map_image = get_field('field_map_image', 'option');

    $props = [
        'form_title'      => ($props['form_title'] ?? null) ?: $bd_form_title ?: $global_form['title'] ?? null,
        'form_text'       => ($props['form_text'] ?? null) ?: $bd_form_text ?: $global_form['text'] ?? null,
        'form_legal_note' => ($props['form_legal_note'] ?? null) ?: $bd_form_legal_note ?: $global_form['legal_note'] ?? null,
        'map_image'       => ($props['map_image'] ?? null) ?: $bd_map_image ?: $global_map_image ?: null,
    ];

    render_component_template('contact-section', 'source/components/sections/contact-section/contact-section.php', $htmlAttributes, $props);
}
