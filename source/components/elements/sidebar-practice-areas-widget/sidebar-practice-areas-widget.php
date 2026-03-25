<?php /** SidebarPracticeAreasWidget */ ?>

<div <?= $htmlAttributesString(['class' => 'sidebar-practice-areas-widget']) ?>>
    <?php if (!empty($items) && is_array($items)) : ?>
        <?php foreach ($items as $index => $item) :
            $title       = $item['title'] ?? null;
            $link_url    = $item['link_url'] ?? null;
            $link_title  = $item['link_title'] ?? null;
            $link_target = $item['link_target'] ?? null;
            $image       = $item['image'] ?? null;
        ?>
            <article class="sidebar-practice-areas-widget__card">
                <img src="<?= get_template_directory_uri() ?>/source/components/elements/sidebar-practice-areas-widget/assets/background.png"
                    alt="" class="sidebar-practice-areas-widget__pattern">

                <div class="sidebar-practice-areas-widget__head">
                    <?php if ($index === 0 && $link_url) : ?>
                        <span class="sidebar-practice-areas-widget__arrow">
                            <?php component_svg_icon(['class' => 'sidebar-practice-areas-widget__arrow-icon'], ['name' => 'forward-arrow']); ?>
                        </span>
                    <?php endif; ?>

                    <?php if ($title) : ?>
                        <h3 class="sidebar-practice-areas-widget__title"><?= $title ?></h3>
                    <?php endif; ?>
                </div>

                <?php if ($image) : ?>
                    <div class="sidebar-practice-areas-widget__image-wrapper">
                        <?php component_image(['class' => 'sidebar-practice-areas-widget__image'], [
                            'reference' => $image,
                            'size'      => 'medium',
                        ]); ?>
                    </div>
                <?php endif; ?>

                <?php if ($link_url) : ?>
                    <a <?= assembleHtmlAttributes([
                        'class'  => 'sidebar-practice-areas-widget__link',
                        'href'   => $link_url,
                        'target' => $link_target,
                    ]) ?>>
                        <span class="screen-reader-text"><?= $link_title ?: $title ?></span>
                    </a>
                <?php endif; ?>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
