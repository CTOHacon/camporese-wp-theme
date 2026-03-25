<?php /** ContactSection */ ?>

<section <?= $htmlAttributesString(['class' => 'contact-section lib-container']) ?>>

    <div class="contact-section__contact-form">
        <?php component_contact_form_fancy(
            ['class' => 'contact-section__form'],
            [
                'title'            => $form_title,
                'text'             => $form_text,
                'legal_note'       => $form_legal_note,
                'decoration_image' => $decoration_image,
            ]
        ); ?>
    </div>

    <div class="contact-section__contact-info">

        <div class="contact-section__contact-info-head">
            <?php if ($info_title): ?>
                <h2 class="contact-section__title"><?= $info_title ?></h2>
            <?php endif; ?>

            <?php if ($info_text): ?>
                <p class="contact-section__text"><?= $info_text ?></p>
            <?php endif; ?>
        </div>

        <?php if ($map_image): ?>
            <div class="contact-section__map-wrapper">
                <?php component_image(
                    ['class' => 'contact-section__map-image'],
                    ['reference' => $map_image]
                ); ?>
            </div>
        <?php endif; ?>

        <div class="contact-section__contacts">

            <?php if ($email): ?>
                <a <?= assembleHtmlAttributes([
                    'class' => 'contact-section__contact-link',
                    'href'  => 'mailto:' . $email,
                ]) ?>>
                    <span class="contact-section__icon-wrapper">
                        <?php component_svg_icon(
                            ['class' => 'contact-section__icon'],
                            ['name' => 'mail']
                        ); ?>
                    </span>
                    <span class="contact-section__contact-text"><?= $email ?></span>
                </a>
            <?php endif; ?>

            <?php if ($address): ?>
                <?php if ($maps_link): ?>
                    <a <?= assembleHtmlAttributes([
                        'class'  => 'contact-section__contact-link',
                        'href'   => esc_url($maps_link),
                        'target' => '_blank',
                        'rel'    => 'noopener noreferrer',
                    ]) ?>>
                <?php else: ?>
                    <span class="contact-section__contact-link">
                <?php endif; ?>

                        <span class="contact-section__icon-wrapper">
                            <?php component_svg_icon(
                                ['class' => 'contact-section__icon'],
                                ['name' => 'location']
                            ); ?>
                        </span>
                        <span class="contact-section__contact-text"><?= $address ?></span>

                <?php if ($maps_link): ?>
                    </a>
                <?php else: ?>
                    </span>
                <?php endif; ?>
            <?php endif; ?>

        </div>

    </div>

</section>
