<?php
/**
 * ArchiveHero
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $pretitle  Small label above the title
 *     @type string $title     Main heading text
 *     @type string $title_tag Heading tag (h1|h2)
 *     @type string $text      Body text
 * }
 */
function component_archive_hero($htmlAttributes = [], $props = [])
{
    $props = [
        'pretitle'  => $props['pretitle'] ?? null,
        'title'     => $props['title'] ?? null,
        'title_tag' => $props['title_tag'] ?? 'h1',
        'text'      => $props['text'] ?? null,
    ];

    render_component_template('archive-hero', 'source/components/sections/archive-hero/archive-hero.php', $htmlAttributes, $props);
}
