<?php /** AboutSection */ ?>

<section <?= $htmlAttributesString(['class' => 'about-section']) ?>>
	<div class="about-section__inner lib-container">

		<div class="about-section__main">
			<div class="about-section__head">
				<?php if ($pretitle) : ?>
					<<?= $pretitle_tag ?> class="about-section__pretitle"><?= $pretitle ?></<?= $pretitle_tag ?>>
				<?php endif; ?>

				<?php if ($title) : ?>
					<<?= $title_tag ?> class="about-section__title"><?= nl2br($title) ?></<?= $title_tag ?>>
				<?php endif; ?>

				<?php if ($text) : ?>
					<p class="about-section__text"><?= $text ?></p>
				<?php endif; ?>
			</div>

			<?php if ($link_url) : ?>
				<?php component_simple_link_button([
					'class'  => 'about-section__link',
					'href'   => $link_url,
					'target' => $link_target,
				], [
					'slot' => $link_title,
				]) ?>
			<?php endif; ?>

			<?php if ($show_logos && !empty($logos_items) && is_array($logos_items)) : ?>
				<ul class="about-section__logos">
					<?php foreach ($logos_items as $logo_item) : ?>
						<?php if (!empty($logo_item['logo_dark'])) : ?>
							<li class="about-section__logos-item">
								<?php if (!empty($logo_item['link'])) : ?>
									<a <?= assembleHtmlAttributes([
										'class'  => 'about-section__logos-link',
										'href'   => $logo_item['link'],
										'target' => '_blank',
										'rel'    => 'noopener noreferrer',
									]) ?>>
										<?php component_image(['class' => 'about-section__logos-image'], ['reference' => $logo_item['logo_dark']]) ?>
									</a>
								<?php else : ?>
									<?php component_image(['class' => 'about-section__logos-image'], ['reference' => $logo_item['logo_dark']]) ?>
								<?php endif; ?>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>

		<?php if (!empty($metrics_items) && is_array($metrics_items)) : ?>
			<?php component_metrics_list_widget(['class' => 'about-section__metrics'], [
				'items' => $metrics_items,
			]) ?>
		<?php endif; ?>

		<?php if ($image) : ?>
			<div class="about-section__image-wrapper">
				<?php component_image(['class' => 'about-section__image'], ['reference' => $image]) ?>
			</div>
		<?php endif; ?>

	</div>
</section>