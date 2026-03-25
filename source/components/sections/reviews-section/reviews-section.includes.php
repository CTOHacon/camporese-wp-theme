<?php

/**
 * ReviewsSection
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $title             Section title
 *     @type string $description       Section description (supports <strong>)
 *     @type string $rating_bar_title  Rating bar heading ("Google Rating")
 *     @type float  $average_rating    Average rating value
 *     @type int    $total_reviews     Total review count
 *     @type array  $all_reviews_link  Link to all reviews {url, title, target}
 *     @type array  $reviews           Reviews [{author: {image, name}, title, text, date}]
 * }
 */
function component_reviews_section($htmlAttributes = [], $props = [])
{
	$global_rating  = get_field('field_rating', 'option') ?: [];
	$global_reviews = get_field('field_reviews', 'option') ?: [];

	$all_reviews_link = $global_rating['all_reviews_link'] ?? [];

	$props = [
		'title'            => ($props['title'] ?? null) ?: get_field('reviews_section_title', 'option') ?: null,
		'description'      => ($props['description'] ?? null) ?: get_field('reviews_section_description', 'option') ?: null,
		'rating_bar_title' => ($props['rating_bar_title'] ?? null) ?: get_field('reviews_section_rating_bar_title', 'option') ?: 'Google Rating',
		'average_rating'   => $global_rating['average'] ?? 5,
		'total_reviews'    => $global_rating['total_reviews'] ?? 0,
		'all_reviews_link_url'    => $all_reviews_link['url'] ?? null,
		'all_reviews_link_title'  => $all_reviews_link['title'] ?? null,
		'all_reviews_link_target' => $all_reviews_link['target'] ?? null,
		'reviews'          => ($props['reviews'] ?? null) ?: $global_reviews,
	];

	render_component_template('reviews-section', 'source/components/sections/reviews-section/reviews-section.php', $htmlAttributes, $props);
}
