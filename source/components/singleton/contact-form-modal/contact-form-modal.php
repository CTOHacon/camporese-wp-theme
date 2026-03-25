<?php /** ContactFormModal */ ?>

<div <?= $htmlAttributesString([
    'class'       => 'contact-form-modal',
    'id'          => 'contact-form-modal',
    'role'        => 'dialog',
    'aria-modal'  => 'true',
    'aria-label'  => 'Contact Form',
    'aria-hidden' => 'true',
]) ?>>
    <div class="contact-form-modal__backdrop"></div>

    <div class="contact-form-modal__content">
        <button class="contact-form-modal__close" type="button" aria-label="Close modal">
            <span class="contact-form-modal__close-icon" aria-hidden="true">&times;</span>
        </button>

        <?= component_contact_form_regular([], []) ?>
    </div>
</div>
