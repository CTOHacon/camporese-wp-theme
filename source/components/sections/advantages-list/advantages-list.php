<?php /** AdvantagesList */ ?>

<ul <?= $htmlAttributesString(['class' => 'advantages-list lib-container']) ?>>
    <?php if (!empty($items) && is_array($items)): ?>
        <?php foreach ($items as $item): ?>
            <li class="advantages-list__item">
                <?php if (!empty($item['icon'])): ?>
                    <?php component_image(['class' => 'advantages-list__item-icon'], ['reference' => $item['icon']]); ?>
                <?php endif; ?>
                <div class="advantages-list__item-main">
                    <?php if (!empty($item['title'])): ?>
                        <p class="advantages-list__item-title"><?= $item['title'] ?></p>
                    <?php endif; ?>
                    <?php if (!empty($item['text'])): ?>
                        <p class="advantages-list__item-text"><?= $item['text'] ?></p>
                    <?php endif; ?>
                </div>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>
