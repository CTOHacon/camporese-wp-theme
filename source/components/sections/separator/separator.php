<?php /** Separator */ ?>

<?php
$styles = implode('; ', array_filter([
    $padding_top ? "padding-top: var(--size-{$padding_top})" : null,
    $padding_bottom ? "padding-bottom: var(--size-{$padding_bottom})" : null,
]));
?>

<div <?= $htmlAttributesString([
    'class' => 'separator',
    'style' => $styles ?: null,
]) ?>>
    <hr class="separator__line">
</div>
