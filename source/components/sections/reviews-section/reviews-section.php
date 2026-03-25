<?php /** ReviewsSection */ ?>

<section <?= $htmlAttributesString(['class' => 'reviews-section lib-container-large']) ?>>
	<div class="reviews-section__inner lib-container">

		<div class="reviews-section__rating-bar">
			<div class="reviews-section__rating-bar-content">
				<div class="reviews-section__rating-mark">
					<img class="reviews-section__rating-mark-icon"
						src="<?= esc_url(get_template_directory_uri() . '/source/components/sections/reviews-section/laurel-wreath.svg') ?>"
						alt="" />
					<?php if ($average_rating) : ?>
						<span class="reviews-section__rating-mark-value"><?= $average_rating ?></span>
					<?php endif; ?>
				</div>

				<div class="reviews-section__rating-bar-text">
					<?php if ($rating_bar_title) : ?>
						<p class="reviews-section__rating-bar-title"><?= $rating_bar_title ?></p>
					<?php endif; ?>

					<span class="reviews-section__rating-bar-separator"></span>

					<?php if ($total_reviews) : ?>
						<?php if ($all_reviews_link_url) : ?>
							<a <?= assembleHtmlAttributes([
								'class'  => 'reviews-section__rating-bar-reviews-link',
								'href'   => $all_reviews_link_url,
								'target' => $all_reviews_link_target,
							]) ?>>
								Based On <?= number_format($total_reviews) ?> Reviews
							</a>
						<?php else : ?>
							<span class="reviews-section__rating-bar-reviews-link">
								Based On <?= number_format($total_reviews) ?> Reviews
							</span>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="reviews-section__main">
			<div class="reviews-section__head">
				<?php if ($title) : ?>
					<h2 class="reviews-section__title"><?= $title ?></h2>
				<?php endif; ?>

				<?php if ($description) : ?>
					<p class="reviews-section__description"><?= $description ?></p>
				<?php endif; ?>
			</div>

			<?php if (!empty($reviews) && is_array($reviews)) : ?>
				<div class="reviews-section__slider-wrapper">
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php foreach ($reviews as $review) : ?>
								<div class="swiper-slide reviews-section__slide">
									<div class="reviews-section__stars">
										<?php for ($i = 0; $i < 5; $i++) : ?>
											<?php component_svg_icon(['class' => 'reviews-section__star'], ['name' => 'star']); ?>
										<?php endfor; ?>
									</div>

									<?php if (!empty($review['text'])) : ?>
										<p class="reviews-section__review-text"><?= $review['text'] ?></p>
									<?php endif; ?>

									<svg class="reviews-section__separator" viewBox="0 0 368 2" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path d="M1 1L367 1.00003" stroke="#B2B7BC" stroke-width="2" stroke-linecap="round"
											stroke-dasharray="1 3" />
									</svg>

									<?php if (!empty($review['author']['name'])) : ?>
										<div class="reviews-section__author">
											<?php if (!empty($review['author']['image']['id'])) : ?>
												<div class="reviews-section__author-image-wrapper">
													<?php component_image(['class' => 'reviews-section__author-image'], ['reference' => $review['author']['image']['id']]); ?>
												</div>
											<?php endif; ?>

											<div class="reviews-section__author-info">
												<span class="reviews-section__author-name"><?= $review['author']['name'] ?></span>

												<?php if (!empty($review['date'])) : ?>
													<span class="reviews-section__author-date"><?= date('M j, Y', strtotime($review['date'])) ?></span>
												<?php endif; ?>
											</div>
										</div>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>

	</div>
</section>
