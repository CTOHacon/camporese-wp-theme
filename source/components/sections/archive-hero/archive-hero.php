<?php /** ArchiveHero */ ?>

<section <?= $htmlAttributesString(['class' => 'archive-hero']) ?>>
    <?php if ($show_breadcrumbs) : ?>
        <?php component_breadcrumbs(['class' => 'archive-hero__breadcrumbs lib-container'], [
            'use_fancy_style' => true,
        ]) ?>
    <?php endif; ?>

    <div class="archive-hero__inner-wrapper lib-container">
        <?php if ($pretitle): ?>
            <p class="archive-hero__pretitle"><?= $pretitle ?></p>
        <?php endif; ?>

        <?php if ($title): ?>
            <<?= $title_tag ?> class="archive-hero__title"><?= $title ?></<?= $title_tag ?>>
        <?php endif; ?>

        <?php if ($text): ?>
            <p class="archive-hero__text"><?= $text ?></p>
        <?php endif; ?>
    </div>
</section>
