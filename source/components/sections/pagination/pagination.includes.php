<?php
/**
 * Pagination
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type WP_Query $query         The WP_Query to paginate (required)
 *     @type array    $pages         [{number, url, is_active}] — built from $query
 *     @type string   $prev_url      URL for the previous page (null if on first page)
 *     @type string   $next_url      URL for the next page (null if on last page)
 * }
 */
function component_pagination($htmlAttributes = [], $props = [])
{
    $query = $props['query'] ?? null;

    if (!$query instanceof WP_Query) {
        return;
    }

    $total_pages = (int) $query->max_num_pages;

    if ($total_pages <= 1) {
        return;
    }

    $paged = max(1, (int) ($query->query_vars['paged'] ?? get_query_var('paged', 1)));

    $pages = [];
    for ($i = 1; $i <= $total_pages; $i++) {
        $pages[] = [
            'number'    => $i,
            'url'       => get_pagenum_link($i),
            'is_active' => $i === $paged,
        ];
    }

    $props = [
        'pages'    => $pages,
        'prev_url' => $paged > 1 ? get_pagenum_link($paged - 1) : null,
        'next_url' => $paged < $total_pages ? get_pagenum_link($paged + 1) : null,
    ];

    render_component_template('pagination', 'source/components/sections/pagination/pagination.php', $htmlAttributes, $props);
}
