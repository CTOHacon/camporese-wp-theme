<?php /** ContentBlock */ ?>

<section <?= $htmlAttributesString([
    'class' => [
        'content-block',
        'lib-container',
        "_aside-position-$aside_position",
        "_main-align-$main_align",
    ],
]) ?>>
    <div class="content-block__main lib-typography-wrapper">
        <?php if ($slot) : ?>
            <?= $slot ?>
        <?php endif; ?>
    </div>

    <div class="content-block__aside">
        <?php if ($aside_type === 'image' && $image) : ?>
            <div class="content-block__aside-image-wrapper">
                <?= component_image(['class' => 'content-block__aside-image'], ['reference' => $image]) ?>
            </div>
        <?php elseif ($aside_type === 'before_after' && !empty($before_after) && is_array($before_after)) : ?>
            <?php if (count($before_after) === 1) : ?>
                <?= component_image_before_after(['class' => 'content-block__aside-image-before-after'], [
                    'before_image' => $before_after[0]['before_image'] ?? null,
                    'after_image'  => $before_after[0]['after_image'] ?? null,
                ]) ?>
            <?php else : ?>
                <?php
                $slides = array_map(function ($item) {
                    return function () use ($item) {
                        component_image_before_after([
                            'class' => 'content-block__aside-image-before-after'
                        ], [
                            'before_image' => $item['before_image'] ?? null,
                            'after_image'  => $item['after_image'] ?? null,
                        ]);
                    };
                }, $before_after);
                ?>
                <?= component_basic_slider(['class' => 'content-block__slider'], ['slides' => $slides]) ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>