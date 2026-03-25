<?php

/**
 * Blockquote
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $title  Quote title
 *     @type string $text   Quote text
 * }
 */
function component_blockquote($htmlAttributes = [], $props = [])
{
    $props = [
        'title' => $props['title'] ?? null,
        'text'  => $props['text']  ?? null,
    ];

    render_component_template('blockquote', 'source/components/elements/blockquote/blockquote.php', $htmlAttributes, $props);
}
