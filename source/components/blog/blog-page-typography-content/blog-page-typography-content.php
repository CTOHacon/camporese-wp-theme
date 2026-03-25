<?php /** BlogPageTypographyContent */ ?>

<section <?= $htmlAttributesString(['class' => [
    'blog-page-typography-content',
    'page-typography-content-base'
]]) ?>>
    <?php render_page_typography_content_base([
        'pre_title'     => $pre_title,
        'pre_title_tag' => $pre_title_tag,
        'title'         => $title,
        'title_tag'     => $title_tag,
        'image'         => $image,
        'slot'          => $slot,
        'sidebar_slot'  => function () use ($toc_items) { ?>
        <?php if (!empty($toc_items) && is_array($toc_items)) : ?>
            <div class="blog-page-typography-content__table-of-contents">
                <div class="blog-page-typography-content__toc-list-wrapper">
                    <ul class="blog-page-typography-content__toc-list">
                        <?php foreach ($toc_items as $item) : ?>
                            <li class="blog-page-typography-content__toc-list-item-wrapper">
                                <a href="#<?= esc_attr($item['id']) ?>" class="blog-page-typography-content__toc-list-item"
                                    data-heading-id="<?= esc_attr($item['id']) ?>"
                                    data-level="<?= esc_attr($item['level'] ?? 'h2') ?>">
                                    <?= esc_html($item['text']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <?php component_sidebar_practice_areas_widget(); ?>

    <?php },
    ]); ?>
</section>