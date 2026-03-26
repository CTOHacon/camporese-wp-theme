<?php
/**
 * FaqTabsSection
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type array $tabs Tabs [{label, items: [{title, answer}]}]
 * }
 */
function component_faq_tabs_section($htmlAttributes = [], $props = [])
{
    $global_tabs = get_field('faq_tabs_section_tabs', 'option') ?: [];

    $props = [
        'tabs' => ($props['tabs'] ?? null) ?: $global_tabs,
    ];

    if (empty($props['tabs'])) {
        return;
    }

    render_component_template('faq-tabs-section', 'source/components/sections/faq-tabs-section/faq-tabs-section.php', $htmlAttributes, $props);
}
