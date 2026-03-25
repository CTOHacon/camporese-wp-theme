<?php /** HighlightedContent */ ?>

<div <?= $htmlAttributesString(['class' => 'highlighted-content']) ?>>
    <?php if ($slot) : ?>
        <div class="highlighted-content__content"><?= $slot ?></div>
    <?php endif; ?>
</div>
