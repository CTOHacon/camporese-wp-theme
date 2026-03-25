<?php /** PhoneButton */ ?>

<?php if ($phone) : ?>
    <a <?= $htmlAttributesString([
        'class' => 'phone-button',
        'href'  => 'tel:' . preg_replace('/[^+\d]/', '', $phone),
    ]) ?>>
        <?php if ($label) : ?>
            <span class="phone-button__label"><?= $label ?></span>
        <?php endif; ?>

        <span class="phone-button__value">
            <?= component_svg_icon(['class' => 'phone-button__icon'], ['name' => 'phone-outline']) ?>
            <span class="phone-button__number"><?= $phone ?></span>
        </span>
    </a>
<?php endif; ?>