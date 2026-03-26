<?php /** PageTypographyContent */ ?>

<section <?= $htmlAttributesString(['class' => [
    'page-typography-content',
    'page-typography-content-base'
]]) ?>>
    <?php render_page_typography_content_base([
        'pre_title'          => $pre_title,
        'pre_title_tag'      => $pre_title_tag,
        'title'              => $title,
        'title_tag'          => $title_tag,
        'image'              => $image,
        'slot'               => $slot,
        'enable_breadcrumbs' => $enable_breadcrumbs,
        'sidebar_slot'       => function () {
                ?>
        <div class="page-typography-content__sidebar-content">
            <?php
                    component_aside_reviews_widget();
                    component_aside_cta_add_widget();
                    component_aside_cases_slider_widget();
                    ?>
        </div>
        <?php
            },
    ]); ?>
</section>