<?php /** AsideReviewsWidget */ ?>

<aside <?= $htmlAttributesString(['class' => 'aside-reviews-widget']) ?>>
	<div class="aside-reviews-widget__head">
		<img class="aside-reviews-widget__stars-decoration"
			src="<?= esc_url(get_template_directory_uri() . '/source/components/elements/aside-reviews-widget/stars-decoration.svg') ?>"
			alt="" />

		<?php if ($title) : ?>
			<p class="aside-reviews-widget__title"><?= $title ?></p>
		<?php endif; ?>

		<?php if ($total_reviews) : ?>
			<p class="aside-reviews-widget__reviews-count">Based On <?= number_format($total_reviews) ?> Reviews</p>
		<?php endif; ?>
	</div>

	<?php if (!empty($reviews) && is_array($reviews)) : ?>
		<div class="aside-reviews-widget__reviews-body">
			<div class="aside-reviews-widget__reviews-slider-wrapper">
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php foreach ($reviews as $review) : ?>
							<div class="swiper-slide">
								<div class="aside-reviews-widget__review-item">
									<div class="aside-reviews-widget__stars">
										<?php for ($i = 0; $i < 5; $i++) : ?>
											<?php component_svg_icon(['class' => 'aside-reviews-widget__star'], ['name' => 'star']); ?>
										<?php endfor; ?>
									</div>

									<?php if (!empty($review['title'])) : ?>
										<h3 class="aside-reviews-widget__review-title"><?= $review['title'] ?></h3>
									<?php endif; ?>

									<?php if (!empty($review['text'])) : ?>
										<p class="aside-reviews-widget__review-text"><?= $review['text'] ?></p>
									<?php endif; ?>

									<svg class="aside-reviews-widget__separator" viewBox="0 0 368 2" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path d="M1 1L367 1.00003" stroke="#B2B7BC" stroke-width="2" stroke-linecap="round"
											stroke-dasharray="1 3" />
									</svg>

									<?php if (!empty($review['author']['name'])) : ?>
										<div class="aside-reviews-widget__author">
											<?php if (!empty($review['author']['image']['id'])) : ?>
												<?php component_image(['class' => 'aside-reviews-widget__avatar'], ['reference' => $review['author']['image']['id']]); ?>
											<?php endif; ?>

											<div class="aside-reviews-widget__author-main">
												<span
													class="aside-reviews-widget__author-name"><?= $review['author']['name'] ?></span>

												<?php if (!empty($review['date'])) : ?>
													<span
														class="aside-reviews-widget__author-date"><?= date('M j, Y', strtotime($review['date'])) ?></span>
												<?php endif; ?>
											</div>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="aside-reviews-widget__controls">
					<button class="aside-reviews-widget__prev" aria-label="Previous review">
						<svg class="aside-reviews-widget__nav-icon" width="14" height="12" viewBox="0 0 14 12" fill="none"
							xmlns="http://www.w3.org/2000/svg">
							<path d="M9.50677 1.11182L4.49316 6.00008L9.50677 10.8884" stroke="#141528" stroke-width="1.5"
								stroke-linecap="round" stroke-linejoin="bevel" />
						</svg>
					</button>
					<button class="aside-reviews-widget__next" aria-label="Next review">
						<svg class="aside-reviews-widget__nav-icon" width="14" height="12" viewBox="0 0 14 12" fill="none"
							xmlns="http://www.w3.org/2000/svg" style="transform: scaleX(-1)">
							<path d="M9.50677 1.11182L4.49316 6.00008L9.50677 10.8884" stroke="#141528" stroke-width="1.5"
								stroke-linecap="round" stroke-linejoin="bevel" />
						</svg>
					</button>
				</div>
			</div>
		</div>
	<?php endif; ?>
</aside>