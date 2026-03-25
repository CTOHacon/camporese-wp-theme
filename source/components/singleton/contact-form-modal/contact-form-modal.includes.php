<?php
/**
 * ContactFormModal
 * @param array $htmlAttributes Root attributes
 * @param array $props          (no user-configurable props)
 */
function component_contact_form_modal($htmlAttributes = [], $props = [])
{
    render_component_template('contact-form-modal', 'source/components/singleton/contact-form-modal/contact-form-modal.php', $htmlAttributes, $props);
}
