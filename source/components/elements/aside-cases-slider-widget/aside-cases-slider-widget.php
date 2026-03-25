<?php /** AsideCasesSliderWidget */ ?>

<aside <?= $htmlAttributesString(['class' => 'aside-cases-slider-widget']) ?>>
	<img class="aside-cases-slider-widget__background"
		src="<?= esc_url(get_template_directory_uri() . '/source/components/elements/aside-cases-slider-widget/assets/background.png') ?>"
		alt="" />

	<div class="aside-cases-slider-widget__head">
		<?php if ($title) : ?>
			<p class="aside-cases-slider-widget__title"><?= $title ?></p>
		<?php endif; ?>

		<?php if ($subtitle) : ?>
			<p class="aside-cases-slider-widget__subtitle"><?= $subtitle ?></p>
		<?php endif; ?>
	</div>

	<?php if (!empty($items) && is_array($items)) : ?>
		<div class="aside-cases-slider-widget__slider-wrapper">
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php foreach ($items as $item) : ?>
						<div class="swiper-slide">
							<div class="aside-cases-slider-widget__slide-item">
								<?php if (!empty($item['title'])) : ?>
									<h3 class="aside-cases-slider-widget__slide-title"><?= $item['title'] ?></h3>
								<?php endif; ?>

								<div class="aside-cases-slider-widget__separator-line"></div>

								<?php if (!empty($item['text'])) : ?>
									<p class="aside-cases-slider-widget__slide-text"><?= $item['text'] ?></p>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

		</div>
		<div class="aside-cases-slider-widget__controls">
			<button class="aside-cases-slider-widget__prev" aria-label="Previous slide">
				<svg class="aside-cases-slider-widget__nav-icon" width="14" height="12" viewBox="0 0 14 12" fill="none"
					xmlns="http://www.w3.org/2000/svg">
					<path d="M9.50677 1.11182L4.49316 6.00008L9.50677 10.8884" stroke="#fff" stroke-width="1.5"
						stroke-linecap="round" stroke-linejoin="bevel" />
				</svg>
			</button>
			<button class="aside-cases-slider-widget__next" aria-label="Next slide">
				<svg class="aside-cases-slider-widget__nav-icon" width="14" height="12" viewBox="0 0 14 12" fill="none"
					xmlns="http://www.w3.org/2000/svg" style="transform: scaleX(-1)">
					<path d="M9.50677 1.11182L4.49316 6.00008L9.50677 10.8884" stroke="#fff" stroke-width="1.5"
						stroke-linecap="round" stroke-linejoin="bevel" />
				</svg>
			</button>
		</div>
	<?php endif; ?>
</aside>