<?php

/**
 * AsideReviewsWidget
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $title         Widget title
 *     @type int    $total_reviews Total review count
 *     @type array  $reviews       Reviews [{author: {image, name}, title, text, date}]
 * }
 */
function component_aside_reviews_widget($htmlAttributes = [], $props = [])
{
	$global_rating  = get_field('field_rating', 'option') ?: [];
	$global_reviews = get_field('field_reviews', 'option') ?: [];

	$props = [
		'title'         => ($props['title'] ?? null) ?: get_field('aside_reviews_widget_title', 'option') ?: 'Google Rating',
		'total_reviews' => ($props['total_reviews'] ?? null) ?: $global_rating['total_reviews'] ?? 0,
		'reviews'       => ($props['reviews'] ?? null) ?: $global_reviews,
	];

	render_component_template('aside-reviews-widget', 'source/components/elements/aside-reviews-widget/aside-reviews-widget.php', $htmlAttributes, $props);
}
