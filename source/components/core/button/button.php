<?php /** Button */ ?>

<?php
$href   = $htmlAttributes['href'] ?? null;
$slot ??= '';

$isLink         = !empty($href);
$isContactModal = $isLink && str_starts_with($href, '#contact-modal');

$iconName ??= null;

if ($iconName !== 'none') {
    if ($isContactModal) {
        $iconName = 'mail';
    }
} else {
    $iconName = null;
}
?>

<?php if ($isLink) : ?>
    <a <?= $htmlAttributesString([
        'class'          => [
            'button',
        ],
        'data-type-prop' => $type,
        'href'           => $href,
    ]) ?>>
        <span class="button__text">
            <?= $slot ?>
        </span>
        <?php if ($iconName) : ?>
            <?= component_svg_icon(['class' => 'button__icon'], ['name' => $iconName]) ?>
        <?php endif; ?>
    </a>
<?php else : ?>
    <button <?= $htmlAttributesString([
        'class'          => [
            'button',
        ],
        'data-type-prop' => $type,
    ]) ?>>
        <span class="button__text">
            <?= $slot ?>
        </span>
        <?php if ($iconName) : ?>
            <?= component_svg_icon(['class' => 'button__icon'], ['name' => $iconName]) ?>
        <?php endif; ?>
    </button>
<?php endif; ?>