<?php
/**
 * Blog Post Card
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $title     Post title
 *     @type string $excerpt   Post excerpt text
 *     @type string $url       Post permalink
 *     @type string $link_text Button label
 * }
 */
function component_blog_post_card($htmlAttributes = [], $props = [])
{
    $props = [
        'title'     => $props['title'] ?? null,
        'excerpt'   => $props['excerpt'] ?? null,
        'url'       => $props['url'] ?? null,
        'link_text' => $props['link_text'] ?? 'Learn More',
    ];

    render_component_template('blog-post-card', 'source/components/blog/blog-post-card/blog-post-card.php', $htmlAttributes, $props);
}
