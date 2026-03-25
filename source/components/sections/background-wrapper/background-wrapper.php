<?php /** BackgroundWrapper */ ?>

<?php
$styles = implode('; ', array_filter([
    $padding_top ? "padding-top: var(--size-{$padding_top})" : null,
    $padding_bottom ? "padding-bottom: var(--size-{$padding_bottom})" : null,
]));
?>

<div <?= $htmlAttributesString([
    'class' => ['background-wrapper', $bg_color, $bg_layout],
    'style' => $styles ?: null,
]) ?>>
    <?php if ($slot): ?>
        <?= $slot ?>
    <?php endif; ?>
</div>
