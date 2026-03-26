<?php

/**
 * ContactsSection
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $phone              Phone number
 *     @type string $phone_description  Phone card description
 *     @type string $email              Email address
 *     @type string $email_description  Email card description
 *     @type string $address            Street address
 *     @type string $address_description Address card description
 *     @type string $maps_link          Google Maps URL for address
 * }
 */
function component_contacts_section($htmlAttributes = [], $props = [])
{
    $phone             = ($props['phone'] ?? null) ?: get_field('field_phone', 'option') ?: null;
    $email             = ($props['email'] ?? null) ?: get_field('field_email', 'option') ?: null;
    $address           = ($props['address'] ?? null) ?: get_field('field_address', 'option') ?: null;
    $maps_link         = ($props['maps_link'] ?? null) ?: get_field('field_maps_link', 'option') ?: null;
    $phone_description   = ($props['phone_description'] ?? null) ?: get_field('field_phone_description', 'option') ?: null;
    $address_description = ($props['address_description'] ?? null) ?: get_field('field_address_description', 'option') ?: null;
    $email_description   = ($props['email_description'] ?? null) ?: get_field('field_email_description', 'option') ?: null;

    $cards = [];

    if ($phone) {
        $cards[] = [
            'label'       => 'Phone:',
            'value'       => $phone,
            'link'        => 'tel:' . preg_replace('/[^+\d]/', '', $phone),
            'description' => $phone_description,
        ];
    }

    if ($address) {
        $cards[] = [
            'label'       => 'Address:',
            'value'       => $address,
            'link'        => $maps_link,
            'link_target' => $maps_link ? '_blank' : null,
            'description' => $address_description,
        ];
    }

    if ($email) {
        $cards[] = [
            'label'       => 'Email:',
            'value'       => $email,
            'link'        => 'mailto:' . $email,
            'description' => $email_description,
        ];
    }

    $props = [
        'cards' => $cards,
    ];

    render_component_template('contacts-section', 'source/components/sections/contacts-section/contacts-section.php', $htmlAttributes, $props);
}
