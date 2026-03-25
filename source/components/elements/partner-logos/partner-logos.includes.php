<?php

/**
 * PartnerLogos
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type array $items Logo items [{logo_dark, link}]
 * }
 */
function component_partner_logos($htmlAttributes = [], $props = [])
{
	$global_items = get_field('proved_by_platforms', 'option') ?: [];

	$props = [
		'items' => ($props['partner_logos_items'] ?? null) ?: $global_items,
	];

	render_component_template('partner-logos', 'source/components/elements/partner-logos/partner-logos.php', $htmlAttributes, $props);
}
