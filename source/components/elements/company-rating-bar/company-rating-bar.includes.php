<?php
/**
 * Renders the company rating bar component
 *
 * @param array{
 *     average_rating?: float|string,
 *     total_reviews?: int|string,
 *     all_reviews_link?: array{url?: string, title?: string, target?: string},
 *     author_images?: array<int>,
 * 	   disable_link?: bool
 * } $props Component properties
 */
function component_company_rating_bar(array $htmlAttributes = [], array $props = []): void
{
	// Get global reviews settings
	$rating_data = get_field('field_rating', 'option') ?: [];
	$all_reviews = get_field('field_reviews', 'option') ?: [];

	// Get average rating (from props or globals)
	$average_rating = $props['average_rating'] ?? ($rating_data['average'] ?? 5);

	// Get total reviews (from props or globals)
	$total_reviews = $props['total_reviews'] ?? ($rating_data['total_reviews'] ?? 0);

	// Get all reviews link (from props or globals)
	$all_reviews_link = $props['all_reviews_link'] ?? ($rating_data['all_reviews_link'] ?? null);

	// Get author images (from props or extract from reviews)
	$author_images = $props['author_images'] ?? [];

	// If no author images provided, get first 5 from reviews
	if (empty($author_images) && !empty($all_reviews)) {
		$author_images = array_slice(
			array_filter(
				array_map(function ($review) {
					return $review['author']['image']['ID'] ?? null;
				}, $all_reviews)
			),
			0,
			5
		);
	}

	// Prepare sanitized props for template
	$sanitizedProps = [
		'average_rating'   => floatval($average_rating),
		'total_reviews'    => intval($total_reviews),
		'all_reviews_link' => $all_reviews_link,
		'author_images'    => $author_images,
		'disable_link'     => $props['disable_link'] ?? false,
	];

	render_component_template('company-rating-bar', 'source/components/elements/company-rating-bar/company-rating-bar.php', $htmlAttributes, $sanitizedProps);
}
