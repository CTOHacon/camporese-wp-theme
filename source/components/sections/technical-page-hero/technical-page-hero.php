<?php /** TechnicalPageHero */ ?>

<section <?= $htmlAttributesString(['class' => 'technical-page-hero']) ?>>
    <?php if ($image) : ?>
        <div class="technical-page-hero__image-wrapper">
            <?= component_image(['class' => 'technical-page-hero__image'], [
                'reference' => $image,
                'size'      => 'full'
            ]) ?>
        </div>
    <?php endif; ?>

    <div class="technical-page-hero__content">
        <div class="technical-page-hero__heading-group">
            <?php if ($heading) : ?>
                <h1 class="technical-page-hero__heading"><?= $heading ?></h1>
            <?php endif; ?>

            <?php if ($subtitle) : ?>
                <p class="technical-page-hero__subtitle"><?= $subtitle ?></p>
            <?php endif; ?>
        </div>

        <div class="technical-page-hero__body">
            <?php if ($text) : ?>
                <div class="technical-page-hero__text-wrapper">
                    <p class="technical-page-hero__text"><?= $text ?></p>
                </div>
            <?php endif; ?>

            <?php if ($button_url) : ?>
                <?= component_button(
                    [
                        'class' => 'technical-page-hero__button',
                        'href'  => $button_url
                    ],
                    [
                        'type' => 'solid-bordered-accent-transparent',
                        'slot' => $button_text
                    ]
                ) ?>
            <?php endif; ?>
        </div>
    </div>
</section>
