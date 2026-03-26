<?php /** CitationSidebarWidget */ ?>

<div <?= $htmlAttributesString(['class' => 'citation-sidebar-widget']) ?>>
    <?php if ($image): ?>
        <div class="citation-sidebar-widget__image-wrapper">
            <?php component_image(['class' => 'citation-sidebar-widget__image'], ['reference' => $image]); ?>
        </div>
    <?php endif; ?>

    <div class="citation-sidebar-widget__content">
        <span class="citation-sidebar-widget__quote-mark">&ldquo;</span>

        <?php if ($quote): ?>
            <div class="citation-sidebar-widget__quote"><?= $quote ?></div>
        <?php endif; ?>
    </div>
</div>
