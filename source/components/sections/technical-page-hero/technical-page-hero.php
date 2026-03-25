<?php /** TechnicalPageHero */ ?>

<section <?= $htmlAttributesString(['class' => 'technical-page-hero']) ?>>
    <?php if ($title) : ?>
        <h1 class="technical-page-hero__title"><?= $title ?></h1>
    <?php endif; ?>

    <?php if ($image) : ?>
        <?= component_image(['class' => 'technical-page-hero__image'], [
            'reference' => $image,
            'size'      => 'full'
        ]) ?>
    <?php endif; ?>

    <?php if ($secondary_title) : ?>
        <h2 class="technical-page-hero__secondary-title"><?= $secondary_title ?></h2>
    <?php endif; ?>

    <?php if ($text) : ?>
        <p class="technical-page-hero__text"><?= $text ?></p>
    <?php endif; ?>

    <?php if ($button_url) : ?>
        <?= component_button(
            [
                'class' => 'technical-page-hero__button',
                'href'  => $button_url
            ],
            [
                'type' => 'solid-dark-blue',
                'slot' => $button_text
            ]
        ) ?>
    <?php endif; ?>
</section>