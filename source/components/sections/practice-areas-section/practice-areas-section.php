<?php /** PracticeAreasSection */ ?>

<section <?= $htmlAttributesString(['class' => [
    'practice-areas-section',
    'lib-container'
]]) ?>>
    <?php if ($title || $text) : ?>
        <div class="practice-areas-section__head">
            <?php if ($title) : ?>
                <<?= $title_tag ?> class="practice-areas-section__title"><?= $title ?></<?= $title_tag ?>>
            <?php endif; ?>

            <?php if ($text) : ?>
                <p class="practice-areas-section__text"><?= $text ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($items) && is_array($items)) : ?>
        <div class="practice-areas-section__grid">
            <?php foreach ($items as $index => $item) : ?>
                <?php
                $card_props = [
                    'title'            => $item['title'] ?? null,
                    'text'             => $item['text'] ?? null,
                    'link_url'         => $item['link_url'] ?? null,
                    'link_title'       => $item['link_title'] ?? null,
                    'link_target'      => $item['link_target'] ?? null,
                    'image'            => $item['image'] ?? null,
                    'background_image' => $item['background_image'] ?? null,
                ];

                if ($index === 0) :
                    component_primary_service_area_card(
                        ['class' => 'practice-areas-section__card'],
                        $card_props
                    );
                else :
                    component_secondary_service_area_card(
                        ['class' => 'practice-areas-section__card'],
                        $card_props
                    );
                endif;
                ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>