<?php /** SimpleFaqSection */ ?>

<section <?= $htmlAttributesString(['class' => 'simple-faq-section lib-container']) ?>>
    <?php if ($title || $text) : ?>
        <div class="simple-faq-section__head">
            <?php if ($title) : ?>
                <h2 class="simple-faq-section__title"><?= $title ?></h2>
            <?php endif; ?>

            <?php if ($text) : ?>
                <p class="simple-faq-section__text"><?= $text ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php component_faq_list(['class' => 'simple-faq-section__list'], ['items' => $items]); ?>
</section>