<?php /** PageTypographyContentBase layout partial */ ?>

<?php if ($enable_breadcrumbs) : ?>
    <?php component_breadcrumbs(['class' => 'lib-container pt-1 mb-2'], ['use_fancy_style' => true]); ?>
<?php endif; ?>

<div class="lib-container">
    <?php if ($pre_title) : ?>
        <<?= $pre_title_tag ?> class="page-typography-content-base__pre-title"><?= $pre_title ?></<?= $pre_title_tag ?>>
    <?php endif; ?>

    <?php if ($title) : ?>
        <<?= $title_tag ?> class="page-typography-content-base__title"><?= $title ?></<?= $title_tag ?>>
    <?php endif; ?>

    <?php if ($image) : ?>
        <div class="page-typography-content-base__image-wrapper">
            <?php component_image(['class' => 'page-typography-content-base__image'], ['reference' => $image]); ?>
        </div>
    <?php endif; ?>

    <div class="page-typography-content-base__sidebar-layout">
        <div class="page-typography-content-base__main lib-typography-wrapper">
            <?php if ($slot) : ?>
                <?= $slot ?>
            <?php endif; ?>
        </div>

        <aside class="page-typography-content-base__aside">
            <div class="page-typography-content-base__aside-content">
                <?php if (is_callable($sidebar_slot)) : ?>
                    <?php $sidebar_slot(); ?>
                <?php endif; ?>
            </div>
        </aside>
    </div>
</div>