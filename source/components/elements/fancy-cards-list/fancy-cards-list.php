<?php /** FancyCardsList */ ?>

<?php if (!empty($items) && is_array($items)): ?>
    <ul <?= $htmlAttributesString(['class' => 'fancy-cards-list']) ?>>
        <?php foreach ($items as $item): ?>
            <li class="fancy-cards-list__item">
                <?php if (!empty($item['title'])): ?>
                    <h3 class="fancy-cards-list__item-title"><?= $item['title'] ?></h3>
                <?php endif; ?>
                <div class="fancy-cards-list__item-separator"></div>
                <?php if (!empty($item['text'])): ?>
                    <p class="fancy-cards-list__item-text"><?= $item['text'] ?></p>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
