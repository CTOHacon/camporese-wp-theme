<?php /** BlogArchiveList */ ?>

<section <?= $htmlAttributesString(['class' => ['blog-archive-list', 'lib-container']]) ?>>

    <?php component_category_select_dropdown(['class' => 'blog-archive-list__category-select'], [
        'categories'       => $categories,
        'current_category' => $current_category,
    ]); ?>

    <?php if (!empty($posts) && is_array($posts)): ?>
        <ul class="blog-archive-list__posts-list">
            <?php foreach ($posts as $post): ?>
                <li class="blog-archive-list__posts-list-item">
                    <?php component_blog_post_card(['class' => 'blog-archive-list__blog-post-card'], [
                        'title'   => $post['title'],
                        'excerpt' => $post['excerpt'],
                        'url'     => $post['url'],
                    ]); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php component_pagination(['class' => 'blog-archive-list__pagination'], [
        'query' => $query,
    ]); ?>

</section>
