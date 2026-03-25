<?php

/**
 * ACF Predefined Fields — reusable field factories powered by config/sizes.json.
 *
 * Provides standardized ACF select field definitions for:
 *   - Margins (get_acf_margin_select_field)
 *   - Padding / spacing (get_acf_size_select_field)
 *   - HTML heading tags (get_acf_heading_tag_field)
 */

/**
 * Reads and caches the sizes configuration from config/sizes.json.
 *
 * @return array The parsed sizes config.
 */
function get_sizes_config(): array
{
    static $config = null;
    if ($config === null) {
        $path   = get_template_directory() . '/config/sizes.json';
        $config = json_decode(file_get_contents($path), true) ?: [];
    }
    return $config;
}

/**
 * Builds ACF select choices from a utility definition in sizes.json.
 *
 * For "default" sizes — builds "prefix-key" => "label" pairs using size labels.
 *
 * @param string $utilityKey  Key from sizes.json "utilities" (e.g. "mb", "mt", "pl").
 * @param bool   $includeEmpty Whether to add an empty '' => 'None' choice at the start.
 * @return array [cssClassName => humanLabel] choices for ACF select.
 */
function get_acf_utility_choices(string $utilityKey, bool $includeEmpty = true): array
{
    $config   = get_sizes_config();
    $utility  = $config['utilities'][$utilityKey] ?? null;
    $allSizes = $config['sizes'] ?? [];

    if (!$utility) {
        return $includeEmpty ? ['' => 'None'] : [];
    }

    $choices = $includeEmpty ? ['' => 'None'] : [];

    if (!empty($utility['default']) && is_array($utility['default'])) {
        foreach ($utility['default'] as $sizeKey) {
            $cssClass           = $utilityKey . '-' . $sizeKey;
            $label              = $allSizes[$sizeKey]['label'] ?? $sizeKey;
            $choices[$cssClass] = $label;
        }
    }

    return $choices;
}

/**
 * Builds ACF select choices for padding/spacing using size labels directly.
 * Returns size keys as values (not prefixed CSS classes).
 *
 * @param string[] $sizeKeys  Array of size keys to include. If empty, includes all.
 * @param bool     $includeEmpty Whether to add an empty '' => 'None' choice.
 * @return array [sizeKey => humanLabel] choices for ACF select.
 */
function get_acf_size_choices(array $sizeKeys = [], bool $includeEmpty = true): array
{
    $config   = get_sizes_config();
    $allSizes = $config['sizes'] ?? [];

    $choices = $includeEmpty ? ['' => 'None'] : [];

    $keys = !empty($sizeKeys) ? $sizeKeys : array_keys($allSizes);
    foreach ($keys as $key) {
        if (isset($allSizes[$key])) {
            $choices[$key] = $allSizes[$key]['label'] ?? $key;
        }
    }

    return $choices;
}

/**
 * Creates an ACF select field for margin.
 *
 * Uses the "mb" (or "mt") utility from sizes.json.
 * Returns a CSS class name (e.g. "mb-3") as the field value.
 *
 * @param array $args Override defaults: direction, key, label, name, default_value, wrapper.
 * @return array Complete ACF field definition.
 */
function get_acf_margin_select_field(array $args = []): array
{
    $direction    = $args['direction'] ?? 'bottom';
    $utilityKey   = $direction === 'top' ? 'mt' : 'mb';
    $fieldKey     = $args['key'] ?? "field_margin_$direction";
    $fieldLabel   = $args['label'] ?? "Margin " . ucfirst($direction);
    $fieldName    = $args['name'] ?? "margin_$direction";
    $instructions = $args['instructions'] ?? "Select the desired $direction margin for this element.";
    $defaultValue = $args['default_value'] ?? '';
    $wrapper      = $args['wrapper'] ?? [
        'width' => '',
        'class' => '',
        'id'    => ''
    ];

    $choices = ['' => 'Initial'] + get_acf_utility_choices($utilityKey, false);

    return array_merge([
        'key'               => $fieldKey,
        'label'             => $fieldLabel,
        'name'              => $fieldName,
        'type'              => 'select',
        'instructions'      => $instructions,
        'required'          => 0,
        'conditional_logic' => 0,
        'wrapper'           => $wrapper,
        'choices'           => $choices,
        'default_value'     => $defaultValue,
        'allow_null'        => 0,
        'multiple'          => 0,
        'ui'                => 0,
        'ajax'              => 0,
        'return_format'     => 'value',
        'placeholder'       => '',
    ], $args);
}

/**
 * Creates an ACF select field for choosing a size value (padding, gap, etc.).
 *
 * Returns the size key (e.g. "3", "4-5") as the field value — not a CSS class.
 *
 * @param array $args Field configuration: key, name, label, sizes, default_value, wrapper.
 * @return array Complete ACF field definition.
 */
function get_acf_size_select_field(array $args = []): array
{
    $fieldKey     = $args['key'] ?? 'field_size';
    $fieldLabel   = $args['label'] ?? 'Size';
    $fieldName    = $args['name'] ?? 'size';
    $instructions = $args['instructions'] ?? '';
    $defaultValue = $args['default_value'] ?? '';
    $wrapper      = $args['wrapper'] ?? [
        'width' => '',
        'class' => '',
        'id'    => ''
    ];
    $sizeKeys     = $args['sizes'] ?? [];

    return array_merge([
        'key'               => $fieldKey,
        'label'             => $fieldLabel,
        'name'              => $fieldName,
        'type'              => 'select',
        'instructions'      => $instructions,
        'required'          => 0,
        'conditional_logic' => 0,
        'wrapper'           => $wrapper,
        'choices'           => get_acf_size_choices($sizeKeys),
        'default_value'     => $defaultValue,
        'allow_null'        => 0,
        'multiple'          => 0,
        'ui'                => 0,
        'ajax'              => 0,
        'return_format'     => 'value',
        'placeholder'       => '',
    ], $args);
}

/**
 * Creates an ACF select field for choosing an HTML heading tag.
 *
 * @param array $args Override defaults: key, name, label, default_value, choices, wrapper.
 * @return array Complete ACF field definition.
 */
function get_acf_heading_tag_field(array $args = []): array
{
    $fieldKey     = $args['key'] ?? 'field_heading_tag';
    $fieldLabel   = $args['label'] ?? 'Heading Tag';
    $fieldName    = $args['name'] ?? 'heading_tag';
    $defaultValue = $args['default_value'] ?? 'h2';
    $wrapper      = $args['wrapper'] ?? [
        'width' => 30,
        'class' => '',
        'id'    => ''
    ];
    $choices      = $args['choices'] ?? [
        'h1'   => 'H1',
        'h2'   => 'H2',
        'h3'   => 'H3',
        'h4'   => 'H4',
        'h5'   => 'H5',
        'h6'   => 'H6',
        'p'    => 'P',
        'span' => 'Span',
    ];

    return array_merge([
        'key'               => $fieldKey,
        'label'             => $fieldLabel,
        'name'              => $fieldName,
        'type'              => 'select',
        'required'          => 0,
        'conditional_logic' => 0,
        'wrapper'           => $wrapper,
        'choices'           => $choices,
        'default_value'     => $defaultValue,
        'allow_null'        => 0,
        'multiple'          => 0,
        'ui'                => 0,
        'ajax'              => 0,
        'return_format'     => 'value',
        'placeholder'       => '',
    ], $args);
}
