<?php
/**
 * Metrics List Widget
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type array $items Array of metric items, each: ['value' => string, 'label' => string, 'description' => string]
 * }
 */
function component_metrics_list_widget($htmlAttributes = [], $props = [])
{
    render_component_template('metrics-list-widget', 'source/components/elements/metrics-list-widget/metrics-list-widget.php', $htmlAttributes, $props);
}
