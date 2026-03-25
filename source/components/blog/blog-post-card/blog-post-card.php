<?php /** Blog Post Card */ ?>

<article <?= $htmlAttributesString(['class' => 'blog-post-card']) ?>>
    <?php if ($url): ?>
        <a class="blog-post-card__overlay" href="<?= esc_url($url) ?>" aria-label="<?= esc_attr($title) ?>"></a>
    <?php endif; ?>

    <div class="blog-post-card__content">
        <?php if ($title): ?>
            <h3 class="blog-post-card__title"><?= $title ?></h3>
        <?php endif; ?>

        <div class="blog-post-card__separator">
            <div class="blog-post-card__separator-fill"></div>
        </div>

        <?php if ($excerpt): ?>
            <p class="blog-post-card__excerpt"><?= $excerpt ?></p>
        <?php endif; ?>
    </div>

    <?php if ($url): ?>
        <?php component_simple_link_button(['class' => 'blog-post-card__link', 'href' => $url], ['slot' => $link_text]); ?>
    <?php endif; ?>
</article>
