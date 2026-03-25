<?php /** MapScreenshotSection */ ?>

<section <?= $htmlAttributesString(['class' => 'map-screenshot-section']) ?>>
    <div class="map-screenshot-section__container lib-container-large">
        <?php if ($image): ?>
            <?php component_image(['class' => 'map-screenshot-section__image'], ['reference' => $image]); ?>
        <?php endif; ?>
    </div>
</section>
