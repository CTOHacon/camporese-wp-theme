<?php /** ContactFormRegular */ ?>

<form <?= $htmlAttributesString(['class' => 'contact-form-regular']) ?>>
    <div class="contact-form-regular__head">
        <?php if ($title) : ?>
            <h2 class="contact-form-regular__title"><?= $title ?></h2>
        <?php endif; ?>

        <?php if ($text) : ?>
            <p class="contact-form-regular__text"><?= $text ?></p>
        <?php endif; ?>
    </div>

    <div class="contact-form-regular__fields">
        <div class="contact-form-regular__row">
            <?php component_form_field(
                ['class' => 'contact-form-regular__field'],
                [
                    'controlAttributes' => [
                        'name'        => 'first_name',
                        'required'    => true,
                        'placeholder' => 'First Name',
                    ],
                ]
            ); ?>

            <?php component_form_field(
                ['class' => 'contact-form-regular__field'],
                [
                    'controlAttributes' => [
                        'name'        => 'last_name',
                        'required'    => true,
                        'placeholder' => 'Last Name',
                    ],
                ]
            ); ?>
        </div>

        <div class="contact-form-regular__row">
            <?php component_form_field(
                ['class' => 'contact-form-regular__field'],
                [
                    'controlAttributes' => [
                        'name'        => 'email',
                        'type'        => 'email',
                        'required'    => true,
                        'placeholder' => 'Your Mail',
                    ],
                ]
            ); ?>

            <?php component_form_field(
                ['class' => 'contact-form-regular__field'],
                [
                    'controlAttributes' => [
                        'name'        => 'phone',
                        'type'        => 'tel',
                        'required'    => true,
                        'placeholder' => 'Your Phone',
                    ],
                ]
            ); ?>
        </div>

        <?php if (!empty($services)) : ?>
            <?php component_form_field(
                ['class' => 'contact-form-regular__field contact-form-regular__field--full'],
                [
                    'tag'     => 'select',
                    'options' => $services,
                    'controlAttributes' => [
                        'name'        => 'service',
                        'placeholder' => 'Service Needed',
                    ],
                ]
            ); ?>
        <?php endif; ?>

        <?php component_form_field(
            ['class' => 'contact-form-regular__field contact-form-regular__field--full'],
            [
                'tag' => 'textarea',
                'controlAttributes' => [
                    'name'        => 'message',
                    'placeholder' => 'Your Message',
                ],
            ]
        ); ?>
    </div>

    <div class="contact-form-regular__controls">
        <?php component_button(
            [
                'class' => 'contact-form-regular__submit-button',
                'type'  => 'submit',
            ],
            [
                'type'     => 'solid-dark',
                'iconName' => 'mail',
                'slot'     => 'Send',
            ]
        ); ?>

        <?php if ($legal_note) : ?>
            <div class="contact-form-regular__legal-note"><?= $legal_note ?></div>
        <?php endif; ?>
    </div>
</form>
