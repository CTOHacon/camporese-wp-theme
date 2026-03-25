<?php

use Hacon\ThemeCore\Handlers\FormAjaxHandler\FormAjaxHandler;

add_action('init', function () {
    $handler = new FormAjaxHandler('regular_contact_regular_submit');

    $handler
        ->addField('first_name', ['required'])
        ->addField('last_name', ['required'])
        ->addField('email', [
            'required',
            'email'
        ])
        ->addField('phone', [
            'required',
            'tel'
        ])
        ->addField('service', [])
        ->addField('message', [])
        ->setFormTitle(function (array $fields) {
            return "{$fields['first_name']} {$fields['last_name']} Message";
        });

    $emails     = [];
    $acf_emails = get_field('field_contact_form_emails', 'option');
    if (is_array($acf_emails)) {
        foreach ($acf_emails as $email) {
            if (!empty($email['email'])) {
                $emails[] = $email['email'];
            }
        }
    }
    $handler->setReceiverEmails($emails);

    $thank_you_page = get_field('field_thank_you_page_link', 'option');
    if (!empty($thank_you_page)) {
        $handler->setRedirect($thank_you_page);
    }

    $handler->init();
});

/**
 * ContactFormRegular
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $title      Form title
 *     @type string $text       Form description text
 *     @type string $legal_note Legal note HTML (displayed unescaped)
 *     @type array  $services   Array of service options for the dropdown
 * }
 */
function component_contact_form_regular($htmlAttributes = [], $props = [])
{
    $global = get_field('field_contact_form', 'option') ?: [];

    $services_raw = get_field('field_contact_form_services', 'option') ?: [];
    $services     = [];
    if (is_array($services_raw)) {
        foreach ($services_raw as $row) {
            if (!empty($row['label'])) {
                $services[$row['label']] = $row['label'];
            }
        }
    }

    $props = [
        'title'      => $props['title'] ?? $global['title'] ?? null,
        'text'       => $props['text'] ?? $global['text'] ?? null,
        'legal_note' => $props['legal_note'] ?? $global['legal_note'] ?? null,
        'services'   => $props['services'] ?? $services,
    ];

    render_component_template('contact-form-regular', 'source/components/elements/contact-form-regular/contact-form-regular.php', $htmlAttributes, $props);
}
