<?php /** SecondaryServiceAreaCard */ ?>

<article <?= $htmlAttributesString(['class' => 'secondary-service-area-card']) ?>>
    <?php if ($link_url) : ?>
        <span class='secondary-service-area-card__arrow'>
            <?php
            component_svg_icon(['class' => 'secondary-service-area-card__arrow-icon'], ['name' => 'forward-arrow']);
            ?>
        </span>
    <?php endif; ?>

    <img src="<?= get_template_directory_uri() ?>/source/components/sections/practice-areas-section/secondary-service-area-card/pattern-dotted.png"
        alt="Pattern Dotted" class="secondary-service-area-card__overlay-image">

    <?php if ($image) : ?>
        <div class="secondary-service-area-card__image-wrapper">
            <?php component_image(['class' => 'secondary-service-area-card__image'], [
                'reference' => $image,
                'size'      => 'large'
            ]); ?>
        </div>
    <?php endif; ?>

    <div class="secondary-service-area-card__head">
        <?php if ($title) : ?>
            <h3 class="secondary-service-area-card__title"><?= $title ?></h3>
        <?php endif; ?>

        <?php if ($text) : ?>
            <p class="secondary-service-area-card__text"><?= $text ?></p>
        <?php endif; ?>
    </div>

    <a <?= assembleHtmlAttributes([
        'class'  => 'secondary-service-area-card__link',
        'href'   => $link_url,
        'target' => $link_target,
    ]) ?>>
        <span class="screen-reader-text"><?= $link_title ?: $title ?></span>
    </a>
</article>