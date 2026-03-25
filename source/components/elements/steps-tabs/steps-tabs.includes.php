<?php
/**
 * StepsTabs
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type array $items Tab items [{title, content}]
 * }
 */
function component_steps_tabs($htmlAttributes = [], $props = [])
{
    $props = [
        'items' => $props['items'] ?? [],
    ];

    render_component_template('steps-tabs', 'source/components/elements/steps-tabs/steps-tabs.php', $htmlAttributes, $props);
}
