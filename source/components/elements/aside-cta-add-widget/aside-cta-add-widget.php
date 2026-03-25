<?php /** AsideCtaAddWidget */ ?>

<aside <?= $htmlAttributesString(['class' => 'aside-cta-add-widget']) ?>>
    <div class="aside-cta-add-widget__main">
        <?php if ($image): ?>
            <?php component_image(['class' => 'aside-cta-add-widget__image'], ['reference' => $image]); ?>
        <?php endif; ?>

        <div class="aside-cta-add-widget__halo-gradient-shadow"></div>

        <?php if ($slogan): ?>
            <p class="aside-cta-add-widget__slogan"><?= $slogan ?></p>
        <?php endif; ?>

        <div class="aside-cta-add-widget__main-wrapper">
            <?php if ($title): ?>
                <h3 class="aside-cta-add-widget__title"><?= $title ?></h3>
            <?php endif; ?>

            <?php if ($phone_href): ?>
                <a <?= assembleHtmlAttributes([
                    'class' => 'aside-cta-add-widget__phone',
                    'href'  => $phone_href,
                ]) ?>>
                    <?php if ($phone_label): ?>
                        <span class="aside-cta-add-widget__phone-label"><?= $phone_label ?></span>
                    <?php endif; ?>

                    <?php component_svg_icon(['class' => 'aside-cta-add-widget__phone-icon'], ['name' => 'phone']); ?>

                    <?php if ($phone_value): ?>
                        <span class="aside-cta-add-widget__phone-value"><?= $phone_value ?></span>
                    <?php endif; ?>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($bottom_badge_text): ?>
        <div class="aside-cta-add-widget__bottom-badge"><?= $bottom_badge_text ?></div>
    <?php endif; ?>
</aside>
