<?php
/**
 * MetricsRow
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type array $items Metric items [{value, description}]
 * }
 */
function component_metrics_row($htmlAttributes = [], $props = [])
{
    $global_metrics = get_field('metrics_row_items', 'option') ?: [];

    $props = [
        'items' => !empty($props['items']) ? $props['items'] : $global_metrics,
    ];

    render_component_template('metrics-row', 'source/components/elements/metrics-row/metrics-row.php', $htmlAttributes, $props);
}
