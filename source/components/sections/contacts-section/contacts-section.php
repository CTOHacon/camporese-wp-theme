<?php /** ContactsSection */ ?>

<section <?= $htmlAttributesString(['class' => 'contacts-section lib-container']) ?>>

    <?php if (!empty($cards) && is_array($cards)) : ?>
        <div class="contacts-section__cards">
            <?php foreach ($cards as $card) : ?>
                <div class="contacts-section__card">
                    <?php if (!empty($card['label'])) : ?>
                        <p class="contacts-section__card-label"><?= $card['label'] ?></p>
                    <?php endif; ?>

                    <?php if (!empty($card['value'])) : ?>
                        <div class="contacts-section__card-value">
                            <?php if (!empty($card['link'])) : ?>
                                <a <?= assembleHtmlAttributes([
                                    'class'  => 'contacts-section__card-link',
                                    'href'   => $card['link'],
                                    'target' => $card['link_target'] ?? null,
                                ]) ?>><?= $card['value'] ?></a>
                            <?php else : ?>
                                <p><?= $card['value'] ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <span class="contacts-section__card-separator"></span>

                    <?php if (!empty($card['description'])) : ?>
                        <p class="contacts-section__card-description"><?= $card['description'] ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</section>