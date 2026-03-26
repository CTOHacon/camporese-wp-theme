<?php
/**
 * BlogPostsSlider
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type int $count Number of posts to display
 * }
 */
function component_blog_posts_slider($htmlAttributes = [], $props = [])
{
    $count = $props['count'] ?? 5;

    $query = new WP_Query([
        'post_type'      => 'blog',
        'posts_per_page' => $count,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post_status'    => 'publish',
    ]);

    $posts = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $posts[] = [
                'title'   => get_the_title(),
                'image'   => get_post_thumbnail_id(),
                'excerpt' => get_the_excerpt(),
                'url'     => get_permalink(),
            ];
        }
        wp_reset_postdata();
    }

    $props = [
        'posts' => $posts,
    ];

    render_component_template('blog-posts-slider', 'source/components/sections/blog-posts-slider/blog-posts-slider.php', $htmlAttributes, $props);
}
