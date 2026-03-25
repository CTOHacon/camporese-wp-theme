<?php /** Metrics List Widget */ ?>

<?php
$items ??= [];
$itemsCount = count($items);
?>

<?php if ($itemsCount > 0) : ?>
    <div <?= $htmlAttributesString([
        'class' => 'metrics-list-widget',
        'style' => '--c-items-quantity: ' . $itemsCount,
    ]) ?>>
        <dl class="metrics-list-widget__list">
            <?php foreach ($items as $item) : ?>
                <article class="metrics-list-widget__item">
                    <button class="metrics-list-widget__header" type="button" aria-expanded="false">
                        <hgroup class="metrics-list-widget__titles">
                            <dt class="metrics-list-widget__value"><?= $item['value'] ?? '' ?></dt>
                            <dd class="metrics-list-widget__label"><?= $item['label'] ?? '' ?></dd>
                        </hgroup>
                        <span class="metrics-list-widget__icon">
                            <?= component_svg_icon(['class' => 'metrics-list-widget__icon-plus'], ['name' => 'plus']) ?>
                        </span>
                    </button>
                    <aside class="metrics-list-widget__content" aria-hidden="true">
                        <p class="metrics-list-widget__description"><?= $item['description'] ?? '' ?></p>
                    </aside>
                    <span class="metrics-list-widget__separator"></span>
                </article>
            <?php endforeach; ?>
        </dl>
    </div>
<?php endif; ?>
