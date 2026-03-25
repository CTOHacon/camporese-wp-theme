<?php

/**
 * PageHero
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $title                Title line 1 (white)
 *     @type string $title_line_2         Title line 2 (muted)
 *     @type string $title_tag            Title tag (h1|h2|h3)
 *     @type string $slogan               Slogan text (uppercase)
 *     @type string $text                 Description text
 *     @type bool   $show_rating_bar      Show company rating bar
 *     @type bool   $show_contact_buttons Show contact buttons row
 *     @type bool   $show_logos_list      Show proved-by platforms logos
 *     @type bool   $show_metrics         Show metrics row
 *     @type bool   $use_local_metrics    Use local metrics instead of global
 *     @type array  $local_metrics        Local metric items [{title, value, description}]
 *     @type bool   $show_breadcrumbs     Show breadcrumbs
 *     @type int    $background_image     Background image attachment ID
 *     @type string $bg_bottom_overlap    Background bottom overlap shift in rem (e.g. "5")
 *     @type int    $image                Hero image attachment ID
 *     @type string $image_display        Hero image display mode: 'small' (default, inside container) or 'large' (absolute full-height)
 * }
 */
function component_page_hero($htmlAttributes = [], $props = [])
{
	$logos_items = get_field('field_proved_by_platforms', 'option') ?: [];

	$props = [
		'title'                => $props['title'] ?? null,
		'title_line_2'         => $props['title_line_2'] ?? null,
		'title_tag'            => $props['title_tag'] ?? 'h1',
		'slogan'               => $props['slogan'] ?? null,
		'text'                 => $props['text'] ?? null,
		'show_rating_bar'      => $props['show_rating_bar'] ?? false,
		'show_contact_buttons' => $props['show_contact_buttons'] ?? true,
		'show_logos_list'      => $props['show_logos_list'] ?? false,
		'logos_items'          => $logos_items,
		'show_metrics'         => $props['show_metrics'] ?? false,
		'use_local_metrics'    => $props['use_local_metrics'] ?? false,
		'local_metrics'        => $props['local_metrics'] ?? [],
		'show_breadcrumbs'     => $props['show_breadcrumbs'] ?? true,
		'background_image'     => $props['background_image'] ?? null,
		'bg_bottom_overlap'    => $props['bg_bottom_overlap'] ?? null,
		'image'                => $props['image'] ?? null,
		'image_display'        => $props['image_display'] ?? 'small',
	];

	render_component_template('page-hero', 'source/components/sections/page-hero/page-hero.php', $htmlAttributes, $props);
}
