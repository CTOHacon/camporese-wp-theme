<?php

/**
 * AboutSection
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $pretitle         Pretitle text (uppercase)
 *     @type string $pretitle_tag     Pretitle tag (p|h2|h3)
 *     @type string $title            Title text
 *     @type string $title_tag        Title heading tag (h2|h3)
 *     @type string $text             Description text
 *     @type string $link_url         Link URL
 *     @type string $link_title       Link text
 *     @type string $link_target      Link target
 *     @type int    $image            Image attachment ID
 *     @type bool   $show_logos       Show proved-by platform logos
 *     @type array  $logos_items      Platform logos [{logo_dark, link}]
 *     @type array  $metrics_items   Metrics widget items [{value, label, description}]
 * }
 */
function component_about_section($htmlAttributes = [], $props = [])
{
	$global = [
		'pretitle'    => get_field('about_section_pretitle', 'option'),
		'pretitle_tag' => get_field('about_section_pretitle_tag', 'option'),
		'title'       => get_field('about_section_title', 'option'),
		'title_tag'   => get_field('about_section_title_tag', 'option'),
		'text'        => get_field('about_section_text', 'option'),
		'link'        => get_field('about_section_link', 'option') ?: [],
		'image'       => get_field('about_section_image', 'option'),
		'show_logos'  => get_field('about_section_show_logos', 'option'),
		'metrics'     => get_field('about_section_metrics', 'option') ?: [],
	];

	$logos_items = get_field('field_proved_by_platforms', 'option') ?: [];

	$props = [
		'pretitle'     => ($props['about_section_pretitle'] ?? null) ?: $global['pretitle'] ?: null,
		'pretitle_tag' => ($props['about_section_pretitle_tag'] ?? null) ?: $global['pretitle_tag'] ?: 'p',
		'title'        => ($props['about_section_title'] ?? null) ?: $global['title'] ?: null,
		'title_tag'    => ($props['about_section_title_tag'] ?? null) ?: $global['title_tag'] ?: 'h2',
		'text'         => ($props['about_section_text'] ?? null) ?: $global['text'] ?: null,
		'link_url'     => ($props['about_section_link_url'] ?? null) ?: $global['link']['url'] ?? null,
		'link_title'   => ($props['about_section_link_title'] ?? null) ?: $global['link']['title'] ?? null,
		'link_target'  => ($props['about_section_link_target'] ?? null) ?: $global['link']['target'] ?? null,
		'image'        => ($props['about_section_image'] ?? null) ?: $global['image'] ?: null,
		'show_logos'   => $props['about_section_show_logos'] ?? $global['show_logos'] ?? true,
		'logos_items'  => $logos_items,
		'metrics_items' => !empty($props['about_section_metrics']) ? $props['about_section_metrics'] : $global['metrics'],
	];

	render_component_template('about-section', 'source/components/sections/about-section/about-section.php', $htmlAttributes, $props);
}
