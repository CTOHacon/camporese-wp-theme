<?php /** PartnerLogos */ ?>

<?php if (!empty($items) && is_array($items)): ?>
	<ul <?= $htmlAttributesString(['class' => 'partner-logos']) ?>>
		<?php foreach ($items as $logo_item): ?>
			<?php if (!empty($logo_item['logo_dark'])): ?>
				<li class="partner-logos__item">
					<?php if (!empty($logo_item['link'])): ?>
						<a <?= assembleHtmlAttributes([
							'class'  => 'partner-logos__link',
							'href'   => $logo_item['link'],
							'target' => '_blank',
							'rel'    => 'noopener noreferrer',
						]) ?>>
							<?php component_image(['class' => 'partner-logos__image'], ['reference' => $logo_item['logo_dark']]) ?>
						</a>
					<?php else: ?>
						<?php component_image(['class' => 'partner-logos__image'], ['reference' => $logo_item['logo_dark']]) ?>
					<?php endif; ?>
				</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
