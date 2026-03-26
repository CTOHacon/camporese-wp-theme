<?php /** PageHero */ ?>

<section <?= $htmlAttributesString([
	'class' => 'page-hero',
	'style' => $bg_bottom_overlap ? "--page-hero-bg-bottom-overlap:  {$bg_bottom_overlap}" : null,
]) ?>>
	<div class="page-hero__background">
		<?php if ($background_image) : ?>
			<div class="page-hero__background-image-wrapper">
				<?php component_image(['class' => 'page-hero__background-image'], [
					'reference' => $background_image,
					'lazy'      => false
				]) ?>
			</div>
			<div class="page-hero__background-image-wrapper-shadow"></div>
		<?php endif; ?>
	</div>

	<?php if ($image) : ?>
		<div class="lib-container-large page-hero__image-wrapper-container">
			<div class="page-hero__image-wrapper _<?= $image_display ?>">
				<?php component_image(['class' => 'page-hero__image'], [
					'reference' => $image,
					'lazy'      => false
				]) ?>
			</div>
		</div>
	<?php endif; ?>

	<div class=" page-hero__shadow _<?= $image_display ?>">
	</div>

	<div class="page-hero__inner-wrapper lib-container">

		<div class="page-hero__main-part-wrapper">

			<?php if ($title) : ?>
				<<?= $title_tag ?> class="page-hero__title">
					<span class="page-hero__title-line-1"><?= $title ?></span>
					<?php if ($title_line_2) : ?>
						<span class="page-hero__title-line-2"><?= $title_line_2 ?></span>
					<?php endif; ?>
				</<?= $title_tag ?>>
			<?php endif; ?>

			<?php if ($slogan) : ?>
				<p class="page-hero__slogan"><?= $slogan ?></p>
			<?php endif; ?>

			<?php if ($text) : ?>
				<p class="page-hero__text"><?= $text ?></p>
			<?php endif; ?>

			<?php if ($show_rating_bar) : ?>
				<?php component_company_rating_bar(['class' => 'page-hero__rating-bar']) ?>
			<?php endif; ?>

			<?php if ($show_contact_buttons) : ?>
				<?php component_contact_buttons_row(['class' => 'page-hero__contact-buttons']) ?>
			<?php endif; ?>

		</div>

		<?php if ($show_logos_list && !empty($logos_items) && is_array($logos_items)) : ?>
			<ul class="page-hero__logos-list">
				<?php foreach ($logos_items as $logo_item) : ?>
					<?php if (!empty($logo_item['logo_light'])) : ?>
						<li class="page-hero__logos-item">
							<?php if (!empty($logo_item['link'])) : ?>
								<a <?= assembleHtmlAttributes([
									'class'  => 'page-hero__logos-link',
									'href'   => $logo_item['link'],
									'target' => '_blank',
									'rel'    => 'noopener noreferrer',
								]) ?>>
									<?php component_image(['class' => 'page-hero__logos-image'], ['reference' => $logo_item['logo_light']]) ?>
								</a>
							<?php else : ?>
								<?php component_image(['class' => 'page-hero__logos-image'], ['reference' => $logo_item['logo_light']]) ?>
							<?php endif; ?>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<?php if ($show_metrics) : ?>
			<?php if ($use_local_metrics && !empty($local_metrics)) : ?>
				<?php component_metrics_row(['class' => 'page-hero__metrics-row'], ['items' => $local_metrics]) ?>
			<?php else : ?>
				<?php component_metrics_row(['class' => 'page-hero__metrics-row']) ?>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ($show_breadcrumbs) : ?>
			<?php component_breadcrumbs(['class' => 'page-hero__breadcrumbs'], [
				'theme' => 'light',
			]) ?>
		<?php endif; ?>

	</div>
</section>