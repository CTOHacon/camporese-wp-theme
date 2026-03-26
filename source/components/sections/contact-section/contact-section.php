<?php /** ContactSection */ ?>

<section <?= $htmlAttributesString(['class' => 'contact-section lib-container']) ?>>

    <div class="contact-section__form-col">
        <?php component_contact_form_regular(
            ['class' => 'contact-section__form'],
            [
                'title'      => $form_title,
                'text'       => $form_text,
                'legal_note' => $form_legal_note,
            ]
        ); ?>
    </div>

    <?php if ($map_image) : ?>
        <div class="contact-section__map-col">
            <div class="contact-section__map-wrapper">
                <?php component_image(
                    ['class' => 'contact-section__map-image'],
                    ['reference' => $map_image]
                ); ?>
            </div>
        </div>
    <?php endif; ?>

</section>