<?php /** PreheaderBadge */ ?>

<<?= $tagname ?> <?= $htmlAttributesString([
    'class' => ['preheader-badge', '_' . $theme]
]) ?>>
    <?php if ($slot): ?>
        <?= $slot ?>
    <?php endif; ?>
</<?= $tagname ?>>
