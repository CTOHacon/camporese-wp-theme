<?php
/**
 * PhoneButton
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $label Label text above the phone number
 *     @type string $phone Phone number to display and link to
 * }
 */
function component_phone_button($htmlAttributes = [], $props = [])
{
    $global_phone = get_field('field_phone', 'option') ?: null;

    $props = [
        'label' => $props['label'] ?? 'Or Just Call',
        'phone' => ($props['phone'] ?? null) ?: $global_phone,
    ];

    render_component_template('phone-button', 'source/components/elements/phone-button/phone-button.php', $htmlAttributes, $props);
}
