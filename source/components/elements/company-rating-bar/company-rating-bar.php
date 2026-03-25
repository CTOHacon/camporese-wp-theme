<?php
/**
 * Company Rating Bar Component Template
 *
 * @var Closure $htmlAttributesString - Outputs the HTML attributes for the root element
 * @var float $average_rating - Average rating value
 * @var int $total_reviews - Total number of reviews
 * @var array|null $all_reviews_link - Link to all reviews page
 * @var array<int> $author_images - Array of author image IDs
 */

?>

<div <?= $htmlAttributesString(['class' => 'company-rating-bar']); ?>>

	<?php if (!empty($author_images)) : ?>
		<div <?= assembleHtmlAttributes(['class' => 'company-rating-bar__author-images']); ?>>
			<?php foreach ($author_images as $image_id) : ?>
				<div <?= assembleHtmlAttributes(['class' => 'company-rating-bar__author-image-wrapper']); ?>>
					<?php component_image(['class' => 'company-rating-bar__author-image'], ['reference' => $image_id]); ?>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<div <?= assembleHtmlAttributes(['class' => 'company-rating-bar__rating']); ?>>
		<?php component_svg_icon(['class' => 'company-rating-bar__rating-icon'], ['name' => 'star']); ?>
		<span <?= assembleHtmlAttributes(['class' => 'company-rating-bar__rating-value']); ?>>
			<?= number_format($average_rating, 1); ?>/5
		</span>
	</div>

	<?php if ($total_reviews > 0) : ?>
		<span <?= assembleHtmlAttributes(['class' => 'company-rating-bar__total-reviews']); ?>>
			From <?= number_format($total_reviews); ?> Reviews
		</span>
	<?php endif; ?>

	<?php if (!empty($all_reviews_link && !$disable_link) && !empty($all_reviews_link['url'])) : ?>
		<svg class="company-rating-bar__separator" width="2" height="16" viewBox="0 0 2 16" fill="none"
			xmlns="http://www.w3.org/2000/svg">
			<path
				d="M0.321867 15.4559C0.228534 15.4559 0.149201 15.4233 0.0838673 15.3579C0.0278672 15.3019 -0.000132799 15.2273 -0.000132799 15.1339V0.321945C-0.000132799 0.228612 0.0278672 0.153945 0.0838673 0.0979445C0.149201 0.0326114 0.228534 -5.50747e-05 0.321867 -5.50747e-05H0.867867C0.961201 -5.50747e-05 1.03587 0.0326114 1.09187 0.0979445C1.1572 0.153945 1.18987 0.228612 1.18987 0.321945V15.1339C1.18987 15.2273 1.1572 15.3019 1.09187 15.3579C1.03587 15.4233 0.961201 15.4559 0.867867 15.4559H0.321867Z"
				fill="#677583" />
		</svg>


		<a <?= assembleHtmlAttributes([
			'class'  => 'company-rating-bar__all-reviews-link',
			'href'   => $all_reviews_link['url'],
			'target' => $all_reviews_link['target'] ?? '_self',
		]); ?>>
			<?= $all_reviews_link['title'] ?? 'See all reviews'; ?>
		</a>
	<?php endif; ?>
</div>