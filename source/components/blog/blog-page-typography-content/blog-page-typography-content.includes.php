<?php

/**
 * BlogPageTypographyContent
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $pre_title     Pre-title text
 *     @type string $pre_title_tag Pre-title HTML tag
 *     @type string $title         Title text
 *     @type string $title_tag     Title HTML tag
 *     @type int    $image         Image attachment ID
 *     @type string|callable $slot  Main content HTML or callback (e.g. the_content)
 * }
 */
function component_blog_page_typography_content($htmlAttributes = [], $props = [])
{
    $slot     = $props['slot'] ?? null;
    $tocItems = [];

    if (is_callable($slot)) {
        ob_start();
        $slot();
        $slot = ob_get_clean();
    }

    if ($slot) {
        $result   = process_typography_content_headings($slot);
        $slot     = $result['content'];
        $tocItems = $result['toc_items'];
    }

    $props = [
        'pre_title'     => $props['pre_title'] ?? null,
        'pre_title_tag' => $props['pre_title_tag'] ?? 'p',
        'title'         => $props['title'] ?? null,
        'title_tag'     => $props['title_tag'] ?? 'h1',
        'image'         => $props['image'] ?? null,
        'slot'          => $slot,
        'toc_items'     => $tocItems,
    ];

    render_component_template('blog-page-typography-content', 'source/components/blog/blog-page-typography-content/blog-page-typography-content.php', $htmlAttributes, $props);
}

/**
 * Process HTML content to add IDs to headings and extract TOC items.
 * Uses regex instead of DOMDocument to preserve all existing attributes/classes
 * (DOMDocument re-serializes HTML and can strip classes added by block filters).
 *
 * @param string $content HTML content
 * @return array ['content' => string, 'toc_items' => array]
 */
function process_typography_content_headings($content)
{
    $tocItems = [];
    $usedIds  = [];

    $content = preg_replace_callback(
        '/<(h[23])(\s[^>]*)?>(.+?)<\/\1>/is',
        function ($match) use (&$tocItems, &$usedIds) {
            $tag        = $match[1];
            $attributes = $match[2] ?? '';
            $innerHtml  = $match[3];
            $text       = trim(strip_tags($innerHtml));

            if (empty($text)) {
                return $match[0];
            }

            $baseId  = slugify_heading($text);
            $id      = $baseId;
            $counter = 1;

            while (in_array($id, $usedIds)) {
                $id = $baseId . '-' . $counter;
                $counter++;
            }

            $usedIds[] = $id;

            $tocItems[] = [
                'id'    => $id,
                'text'  => $text,
                'level' => strtolower($tag),
            ];

            // Inject id attribute, preserving all existing attributes
            if (preg_match('/\sid\s*=/i', $attributes)) {
                $attributes = preg_replace('/\sid\s*=\s*["\'][^"\']*["\']/i', ' id="' . esc_attr($id) . '"', $attributes);
            } else {
                $attributes = ' id="' . esc_attr($id) . '"' . $attributes;
            }

            return "<{$tag}{$attributes}>{$innerHtml}</{$tag}>";
        },
        $content
    );

    return [
        'content'   => $content,
        'toc_items' => $tocItems,
    ];
}

/**
 * Convert text to slug format
 * @param string $text
 * @return string
 */
function slugify_heading($text)
{
    $text = strtolower($text);
    $text = preg_replace('/[^\w\s-]/', '', $text);
    $text = preg_replace('/[\s_-]+/', '-', $text);
    $text = trim($text, '-');
    return $text;
}
