<?php /** BlogPostsSlider */ ?>

<section <?= $htmlAttributesString(['class' => 'blog-posts-slider']) ?>>
    <div class="blog-posts-slider__inner lib-container">
        <?php if (!empty($posts) && is_array($posts)): ?>
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($posts as $post): ?>
                        <div class="swiper-slide">
                            <?php component_blog_post_card(['class' => 'blog-posts-slider__card'], [
                                'title'   => $post['title'],
                                'image'   => $post['image'],
                                'excerpt' => $post['excerpt'],
                                'url'     => $post['url'],
                            ]); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
