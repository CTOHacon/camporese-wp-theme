<?php

/**
 * Form Field Component
 *
 * Renders a flexible form field. Supports text/email/tel/etc. inputs, textarea, select,
 * checkbox (toggle & group), radio group, and file input.
 *
 * @param array $htmlAttributes Root element attributes.
 * @param array $props {
 *     Component properties.
 *
 *     @type array $controlAttributes {
 *          HTML attributes applied to the rendered form control element.
 *          Any standard HTML attribute (e.g. accept, multiple, maxlength) is passed through.
 *
 *          @type string $name        Required. The form field name attribute.
 *          @type string $type        Optional. Input type: 'text', 'email', 'tel', 'checkbox', 'radio', 'file', etc. Default 'text'.
 *          @type mixed  $value       Optional. Initial value. Default ''.
 *          @type bool   $required    Optional. Marks the field as required (adds _required modifier). Default false.
 *          @type string $placeholder Optional. Placeholder text. For selects: rendered as disabled first option.
 *                                    For file inputs: trigger button text (default 'Choose file').
 *                                    For standard inputs: shown as ::placeholder and as __focus-placeholder element.
 *          @type string $id          Optional. Control id. Auto-generated if omitted.
 *     }
 *     @type string     $tag      Optional. HTML tag for the control: 'input' (default), 'select', 'textarea'.
 *                                 Ignored when type is 'checkbox', 'radio', or 'file' (always renders as input).
 *     @type array|null $options   Optional. Associative array of value => label. Behavior depends on context:
 *                                 - tag='select': rendered as <option> elements.
 *                                 - type='checkbox' + $options: renders a checkbox group (multiple selection).
 *                                 - type='radio' + $options: renders a radio group (single selection). Required for radio.
 *                                 - type='checkbox' without $options: renders a single toggle (requires $label).
 *     @type string     $baseClass Optional. Base CSS class for BEM naming. Default 'form-field'.
 *     @type string|null $label    Optional. Label text rendered above the control.
 *                                 For checkbox toggles: rendered inline next to the checkbox instead.
 *                                 Not rendered for file inputs (trigger text comes from placeholder).
 * }
 *
 * Container CSS modifiers (auto-applied):
 *   _required           — when controlAttributes.required is true.
 *   _input / _select / _textarea — matches $tag value.
 *   _type-checkbox / _type-radio / _type-file — for special input types.
 *
 * JS state classes (managed by FormField.ts):
 *   _valid     — field passes validation.
 *   _has-error — field has validation errors.
 *   _focus     — field is focused.
 *
 * @throws Exception If $controlAttributes is not set.
 * @throws Exception If $controlAttributes['name'] is missing.
 *
 * @return void
 */
function component_form_field($htmlAttributes = [], $props = [])
{
    render_component_template('form-field', 'source/components/core/form-field/form-field.php',
        $htmlAttributes,
        $props,
    );
}