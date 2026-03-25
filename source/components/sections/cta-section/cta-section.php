<?php /** CtaSection */ ?>

<section <?= $htmlAttributesString(['class' => 'cta-section lib-container-large']) ?>>
    <div class="cta-section__image-wrapper">
        <?php if ($image): ?>
            <?php component_image(['class' => 'cta-section__image'], ['reference' => $image]); ?>
        <?php endif; ?>

        <?php if ($image_label): ?>
            <span class="cta-section__image-label"><?= $image_label ?></span>
        <?php endif; ?>
    </div>

    <div class="cta-section__main-wrapper">
        <?php if ($background_image): ?>
            <?php component_image(['class' => 'cta-section__background-image'], ['reference' => $background_image]); ?>
        <?php endif; ?>

        <div class="cta-section__main-content">
            <?php if ($title): ?>
                <h3 class="cta-section__title"><?= $title ?></h3>
            <?php endif; ?>

            <?php if ($description): ?>
                <p class="cta-section__description"><?= $description ?></p>
            <?php endif; ?>

            <div class="cta-section__actions">
                <?php if ($button_url): ?>
                    <?php component_button(
                        [
                            'class'  => 'cta-section__button',
                            'href'   => $button_url,
                            'target' => $button_target,
                        ],
                        [
                            'type' => 'solid-bordered-accent-transparent',
                            'slot' => $button_title,
                        ]
                    ); ?>
                <?php endif; ?>

                <?php component_phone_button(['class' => 'cta-section__phone']); ?>
            </div>
        </div>
    </div>
</section>
