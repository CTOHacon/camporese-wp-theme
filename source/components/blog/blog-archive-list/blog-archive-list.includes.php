<?php
/**
 * BlogArchiveList
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type WP_Query $query            The WP_Query to list posts from and paginate
 *     @type array    $posts            [{title, excerpt, url}] — built from $query
 *     @type array    $categories       [{title, link}] — all blog-category terms
 *     @type string   $current_category Name of the currently active category (null if none)
 * }
 */
function component_blog_archive_list($htmlAttributes = [], $props = [])
{
    $query = $props['query'] ?? null;

    // Build posts list from query — post-meta card fields take priority over defaults
    $posts = [];
    if ($query instanceof WP_Query && !empty($query->posts)) {
        foreach ($query->posts as $post) {
            $card_title = get_field('blog_card_title', $post->ID) ?: null;

            $posts[] = [
                'title'   => $card_title ?: get_the_title($post),
                'excerpt' => has_excerpt($post) ? get_the_excerpt($post) : wp_trim_words(strip_shortcodes($post->post_content), 30),
                'url'     => get_permalink($post),
            ];
        }
    }

    // Build categories list for the dropdown
    $terms = get_terms([
        'taxonomy'   => 'blog-category',
        'hide_empty' => true,
    ]);

    $blog_archive_url = get_post_type_archive_link('blog');

    $categories = [
        [
            'title' => 'All Categories',
            'link'  => $blog_archive_url
        ],
    ];

    if (!is_wp_error($terms) && !empty($terms)) {
        foreach ($terms as $term) {
            $categories[] = [
                'title' => $term->name,
                'link'  => get_term_link($term),
            ];
        }
    }

    // Determine currently active category from queried object
    $current_term     = get_queried_object();
    $current_category = ($current_term instanceof WP_Term && $current_term->taxonomy === 'blog-category')
        ? $current_term->name
        : null;

    $props = [
        'query'            => $query,
        'posts'            => $posts,
        'categories'       => $categories,
        'current_category' => $current_category,
    ];

    render_component_template('blog-archive-list', 'source/components/blog/blog-archive-list/blog-archive-list.php', $htmlAttributes, $props);
}
