<?php /** Simple Link Button */ ?>

<?php
$href = $htmlAttributes['href'] ?? null;
$slot ??= '';

$isLink = !empty($href);
$tag = $isLink ? 'a' : 'span';
?>

<<?= $tag ?> <?= $htmlAttributesString([
    'class' => 'simple-link-button',
    'href'  => $isLink ? $href : null,
]) ?>>
    <span class="simple-link-button__text"><?= $slot ?></span>
</<?= $tag ?>>
