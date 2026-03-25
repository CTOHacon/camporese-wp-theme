<?php /** CtaSectionBar */ ?>

<aside <?= $htmlAttributesString(['class' => 'cta-section-bar']) ?>>
    <div class="cta-section-bar__main">
        <?php if ($title): ?>
            <h3 class="cta-section-bar__title"><?= $title ?></h3>
        <?php endif; ?>

        <?php if ($text): ?>
            <p class="cta-section-bar__text"><?= $text ?></p>
        <?php endif; ?>
    </div>

    <?php if ($button_url): ?>
        <?php component_button(
            [
                'class'  => 'cta-section-bar__button',
                'href'   => $button_url,
                'target' => $button_target,
            ],
            [
                'type' => 'solid-dark',
                'slot' => $button_title,
            ]
        ); ?>
    <?php endif; ?>
</aside>
