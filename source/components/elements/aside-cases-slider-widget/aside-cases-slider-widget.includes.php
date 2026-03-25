<?php

/**
 * AsideCasesSliderWidget
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $title    Head title
 *     @type string $subtitle Head subtitle
 *     @type array  $items    Slide items [{title, text}]
 * }
 */
function component_aside_cases_slider_widget($htmlAttributes = [], $props = [])
{
	$global = get_field('aside_cases_slider_widget_items', 'option') ?: [];

	$props = [
		'title'    => ($props['title'] ?? null) ?: get_field('aside_cases_slider_widget_title', 'option') ?: null,
		'subtitle' => ($props['subtitle'] ?? null) ?: get_field('aside_cases_slider_widget_subtitle', 'option') ?: null,
		'items'    => ($props['items'] ?? null) ?: $global,
	];

	render_component_template('aside-cases-slider-widget', 'source/components/elements/aside-cases-slider-widget/aside-cases-slider-widget.php', $htmlAttributes, $props);
}
