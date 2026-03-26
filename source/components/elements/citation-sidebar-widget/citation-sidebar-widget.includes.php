<?php
/**
 * CitationSidebarWidget
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type int    $image Background image attachment ID
 *     @type string $quote Quote HTML content (use <em> for accent-colored phrases)
 * }
 */
function component_citation_sidebar_widget($htmlAttributes = [], $props = [])
{
    $props = [
        'image' => ($props['image'] ?? null) ?: get_field('citation_sidebar_widget_image', 'option') ?: null,
        'quote' => ($props['quote'] ?? null) ?: get_field('citation_sidebar_widget_quote', 'option') ?: null,
    ];

    render_component_template('citation-sidebar-widget', 'source/components/elements/citation-sidebar-widget/citation-sidebar-widget.php', $htmlAttributes, $props);
}
