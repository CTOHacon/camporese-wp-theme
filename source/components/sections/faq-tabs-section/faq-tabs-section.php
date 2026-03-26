<?php /** FaqTabsSection */ ?>

<section <?= $htmlAttributesString(['class' => 'faq-tabs-section lib-container']) ?>>
    <?php if (count($tabs) > 1) : ?>
        <div class="faq-tabs-section__controls" role="tablist">
            <?php foreach ($tabs as $index => $tab) : ?>
                <button <?= assembleHtmlAttributes([
                    'class'          => [
                        'faq-tabs-section__control-button',
                        '_active' => $index === 0
                    ],
                    'type'            => 'button',
                    'role'            => 'tab',
                    'id'              => "faq-tab-{$index}",
                    'aria-selected'   => $index === 0 ? 'true' : 'false',
                    'aria-controls'   => "faq-panel-{$index}",
                    'data-tab-index'  => $index,
                ]) ?>>
                    <?= $tab['label'] ?? '' ?>
                </button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="faq-tabs-section__panels">
        <?php foreach ($tabs as $index => $tab) : ?>
            <div <?= assembleHtmlAttributes([
                'class'            => [
                    'faq-tabs-section__panel',
                    '_active' => $index === 0
                ],
                'role'             => 'tabpanel',
                'id'               => "faq-panel-{$index}",
                'aria-labelledby'  => "faq-tab-{$index}",
                'data-tab-panel'   => $index,
            ]) ?>>
                <?php component_faq_list(
                    ['class' => 'faq-tabs-section__faq-list'],
                    ['items' => ($tab['items'] ?? null) ?: []]
                ); ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>