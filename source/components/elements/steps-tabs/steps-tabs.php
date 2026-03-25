<?php /** StepsTabs */ ?>

<div <?= $htmlAttributesString(['class' => 'steps-tabs']) ?>>
    <?php if (!empty($items) && is_array($items)): ?>
        <div class="steps-tabs__controls">
            <?php foreach ($items as $index => $item): ?>
                <button <?= assembleHtmlAttributes([
                    'class'          => ['steps-tabs__control-item', '_active' => $index === 0],
                    'type'           => 'button',
                    'data-tab-index' => $index,
                ]) ?>>
                    <?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?>
                </button>
            <?php endforeach; ?>
        </div>

        <div class="steps-tabs__wrapper">
            <div class="steps-tabs__progress-track">
                <div class="steps-tabs__progress-fill"></div>
            </div>

            <?php foreach ($items as $index => $item): ?>
                <div <?= assembleHtmlAttributes([
                    'class' => ['steps-tabs__tab', '_active' => $index === 0],
                ]) ?>>
                    <?php if (!empty($item['content'])): ?>
                        <div class="steps-tabs__tab-content lib-typography-wrapper"><?= $item['content'] ?></div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
