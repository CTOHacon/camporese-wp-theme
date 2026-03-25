<?php
/** Form Field template — see form-field.includes.php for full docblock. */

if (!$controlAttributes ?? null) {
    throw new Exception('`controlAttributes` are not set for `form-field`');
}
if (!$controlAttributes['name'] ?? null) {
    throw new Exception('`name` is required for `controlAttributes` in `form-field`');
}

// Default values
$tag       ??= 'input';
$options   ??= null;
$baseClass ??= 'form-field';
$label     ??= null;
$required    = $controlAttributes['required'] ?? false;

// Initialize control attributes
$inputType = $controlAttributes['type'] ?? 'text';
$value     = $controlAttributes['value'] ?? '';

// Generate unique identifier for form control
$fieldUuid             = uniqid('field_');
$controlAttributes['id'] = $fieldUuid;

// Set component container attributes
$fieldAttributes = $htmlAttributesString([
    'class'                => [
        $baseClass,
        '_required' => $required ?? false,
        "_$tag",
        "_type-$inputType" => in_array($inputType, ['checkbox', 'radio', 'file']),
    ],
    'data-form-field-name' => $controlAttributes['name'],
]);

// Check field type variants
$isCheckboxToggle = $inputType === 'checkbox' && $label && !is_array($options);
$isRadio          = $inputType === 'radio';
$isFileInput      = $inputType === 'file';

/**
 * Render functions for each field type
 */
// Define render functions using anonymous functions
$renderLabel = function ($fieldUuid, $label, $baseClass) {
    ?>
    <label <?= assembleHtmlAttributes([
        'for'   => $fieldUuid,
        'class' => "{$baseClass}__label",
    ]); ?>>
        <?= $label; ?>
    </label>
    <?php
};

$renderSelect = function ($controlAttributes, $baseClass, $options) {
    ?>
    <select <?= assembleHtmlAttributes($controlAttributes, [
        "class" => "{$baseClass}__select-control",
    ]); ?>>
        <?php if ($controlAttributes['placeholder'] ?? '') : ?>
            <option value="" selected disabled><?= $controlAttributes['placeholder'] ?></option>
        <?php endif; ?>
        <?php foreach ($options as $value => $label) : ?>
            <option value="<?= $value; ?>"><?= $label; ?></option>
        <?php endforeach; ?>
    </select>
    <?= component_svg_icon(
        ['class' => "{$baseClass}__select-arrow"],
        ['name' => 'select-arrow']
    ); ?>
<?php
};

$renderTextarea = function ($controlAttributes, $baseClass, $value) {
    ?>
    <textarea <?= assembleHtmlAttributes($controlAttributes, [
        "class" => "{$baseClass}__textarea-control",
    ]); ?>><?= $value; ?></textarea>
    <?php
};

$renderCheckboxToggle = function ($controlAttributes, $baseClass, $fieldUuid, $label) {
    ?>
    <div class="<?= $baseClass; ?>__checkbox">
        <input <?= assembleHtmlAttributes($controlAttributes, [
            "class" => "{$baseClass}__checkbox-control",
        ]); ?>>
        <label <?= assembleHtmlAttributes([
            'for'   => $fieldUuid,
            'class' => "{$baseClass}__checkbox-label",
        ]); ?>>
            <?= $label ?? '' ?>
        </label>
    </div>
    <?php
};

$renderCheckboxGroup = function ($controlAttributes, $baseClass, $fieldUuid, $options) {
    ?>
    <div class="<?= $baseClass; ?>__checkbox-group">
        <?php
        $index = 0;
        foreach ($options as $value => $label) :
            $index++;
            $currentAttributes          = $controlAttributes;
            $currentAttributes['value'] = $value;
            $currentAttributes['id']    = "{$fieldUuid}_{$index}";
            ?>
            <div class="<?= $baseClass; ?>__checkbox">
                <input <?= assembleHtmlAttributes($currentAttributes, [
                    "class" => "{$baseClass}__checkbox-control",
                ]); ?>>
                <label <?= assembleHtmlAttributes([
                    'for'   => $currentAttributes['id'],
                    'class' => "{$baseClass}__checkbox-label",
                ]); ?>>
                    <?= $label ?>
                </label>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
};

$renderRadioGroup = function ($controlAttributes, $baseClass, $fieldUuid, $options) {
    ?>
    <div class="<?= $baseClass; ?>__radio-group">
        <?php
        $index = 0;
        foreach ($options as $value => $label) :
            $index++;
            $currentAttributes          = $controlAttributes;
            $currentAttributes['type']  = 'radio';
            $currentAttributes['value'] = $value;
            $currentAttributes['id']    = "{$fieldUuid}_{$index}";
            ?>
            <div class="<?= $baseClass; ?>__radio">
                <input <?= assembleHtmlAttributes($currentAttributes, [
                    "class" => "{$baseClass}__radio-control",
                ]); ?>>
                <label <?= assembleHtmlAttributes([
                    'for'   => $currentAttributes['id'],
                    'class' => "{$baseClass}__radio-label",
                ]); ?>>
                    <?= $label ?>
                </label>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
};

$renderFileInput = function ($controlAttributes, $baseClass) {
    ?>
    <label <?= assembleHtmlAttributes([
        'for'   => $controlAttributes['id'],
        'class' => "{$baseClass}__file-trigger",
    ]); ?>>
        <span class="<?= $baseClass; ?>__file-trigger-text">
            <?= $controlAttributes['placeholder'] ?? 'Choose file' ?>
        </span>
        <input <?= assembleHtmlAttributes($controlAttributes, [
            "class" => "{$baseClass}__file-control",
        ]); ?>>
    </label>
    <span class="<?= $baseClass; ?>__file-name"></span>
    <?php
};

$renderInput = function ($controlAttributes, $baseClass) {
    ?>
    <input <?= assembleHtmlAttributes($controlAttributes, [
        "class" => "{$baseClass}__input-control",
    ]); ?>>
    <?php
};

?>

<div <?= $fieldAttributes; ?>>
    <?php if (!$isCheckboxToggle && $label) :
        $renderLabel($fieldUuid, $label, $baseClass);
    endif;

    // Render appropriate form control based on type
    if ($tag === 'select') {
        $renderSelect($controlAttributes, $baseClass, $options);
    } elseif ($tag === 'textarea') {
        $renderTextarea($controlAttributes, $baseClass, $value);
    } else {
        // Handle input fields
        if ($isCheckboxToggle) {
            $renderCheckboxToggle($controlAttributes, $baseClass, $fieldUuid, $label);
        } elseif ($inputType === 'checkbox' && is_array($options)) {
            $renderCheckboxGroup($controlAttributes, $baseClass, $fieldUuid, $options);
        } elseif ($isRadio && is_array($options)) {
            $renderRadioGroup($controlAttributes, $baseClass, $fieldUuid, $options);
        } elseif ($isFileInput) {
            $renderFileInput($controlAttributes, $baseClass);
        } else {
            $renderInput($controlAttributes, $baseClass);
        }
    }
    ?>
    <span class="<?= $baseClass ?>__error-message"></span>
    <?php if ($controlAttributes['placeholder'] ?? null) : ?>
        <span class="<?= $baseClass ?>__focus-placeholder"><?= $controlAttributes['placeholder'] ?></span>
    <?php endif; ?>
</div>