<?php /** PrimaryServiceAreaCard */ ?>

<article <?= $htmlAttributesString(['class' => 'primary-service-area-card']) ?>>
    <?php if ($link_url) : ?>
        <a <?= assembleHtmlAttributes([
            'class'  => 'primary-service-area-card__link-overlay',
            'href'   => $link_url,
            'target' => $link_target,
        ]) ?>>
            <span class="screen-reader-text"><?= $link_title ?: $title ?></span>
        </a>
    <?php endif; ?>

    <img src="<?= get_template_directory_uri() ?>/source/components/sections/practice-areas-section/primary-service-area-card/pattern-dotted.png"
        alt="Pattern Dotted" class="primary-service-area-card__overlay-image">

    <?php if ($image) : ?>
        <div class="primary-service-area-card__image-wrapper">
            <?php component_image(['class' => 'primary-service-area-card__image'], [
                'reference' => $image,
                'size'      => 'large'
            ]); ?>
        </div>
    <?php endif; ?>

    <div class="primary-service-area-card__head">
        <?php if ($title) : ?>
            <h3 class="primary-service-area-card__title"><?= $title ?></h3>
        <?php endif; ?>

        <?php if ($text) : ?>
            <p class="primary-service-area-card__text"><?= $text ?></p>
        <?php endif; ?>
    </div>

    <?php if ($link_url) : ?>
        <div class="primary-service-area-card__link">
            <span class="primary-service-area-card__link-icon">
                <?php component_svg_icon(['class' => 'primary-service-area-card__link-icon-arrow'], ['name' => 'forward-arrow']); ?>
            </span>
            <?php if ($link_title) : ?>
                <span class="primary-service-area-card__link-text"><?= $link_title ?></span>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</article>