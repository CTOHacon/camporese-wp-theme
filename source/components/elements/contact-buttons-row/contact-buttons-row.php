<?php /** ContactButtonsRow */ ?>

<div <?= $htmlAttributesString(['class' => 'contact-buttons-row']) ?>>
    <?php component_button(['class' => 'contact-buttons-row__button', 'href' => $button_url], [
        'type' => 'solid-bordered-accent-transparent',
        'slot' => $button_text,
    ]); ?>

    <?php component_phone_button(['class' => 'contact-buttons-row__phone'], [
        'label' => $phone_label,
        'phone' => $phone,
    ]); ?>
</div>
