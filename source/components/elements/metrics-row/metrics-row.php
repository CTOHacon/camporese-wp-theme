<?php /** MetricsRow */ ?>

<?php if (!empty($items) && is_array($items)): ?>
    <ul <?= $htmlAttributesString(['class' => 'metrics-row']) ?>>
        <?php foreach ($items as $item): ?>
            <li class="metrics-row__item">
                <?php if (!empty($item['value'])): ?>
                    <p class="metrics-row__value"><?= $item['value'] ?></p>
                <?php endif; ?>

                <?php if (!empty($item['description'])): ?>
                    <p class="metrics-row__description"><?= $item['description'] ?></p>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
