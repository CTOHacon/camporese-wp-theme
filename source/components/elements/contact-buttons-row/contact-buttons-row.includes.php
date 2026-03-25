<?php
/**
 * ContactButtonsRow
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $button_text   Button label text
 *     @type string $button_url    Button link URL
 *     @type string $phone_label   Phone button label
 *     @type string $phone         Phone number
 * }
 */
function component_contact_buttons_row($htmlAttributes = [], $props = [])
{
    $props = [
        'button_text' => $props['button_text'] ?? 'Ask A Question',
        'button_url'  => $props['button_url'] ?? '#contact-modal',
        'phone_label' => $props['phone_label'] ?? 'Or Just Call',
        'phone'       => $props['phone'] ?? get_field('field_phone', 'option'),
    ];

    render_component_template('contact-buttons-row', 'source/components/elements/contact-buttons-row/contact-buttons-row.php', $htmlAttributes, $props);
}
