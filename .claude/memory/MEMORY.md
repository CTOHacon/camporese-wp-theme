# HACON Theme Development

## PHP Style: String Interpolation

Prefer double-quoted strings with `{$var}` interpolation over single-quoted concatenation:

```php
// ✅ Correct
"--page-hero-bg-bottom-overlap: {$bg_bottom_overlap}rem"
"source/components/{$category}/{$name}/{$name}.php"

// ❌ Avoid
'--page-hero-bg-bottom-overlap: ' . $bg_bottom_overlap . 'rem'
'source/components/' . $category . '/' . $name . '/' . $name . '.php'
```

## Component PHP Templates

**IMPORTANT**: Never add `use function` imports in component `.php` template files. Functions from `Hacon\ThemeCore` (`assembleHtmlAttributes`, `render_component_template`, etc.) are available globally and don't require imports.

✅ Correct:
```php
<?php
// Props auto-extracted via extract()
?>
<div <?= $htmlAttributesString(['class' => 'component-name']); ?>>
    <span <?= assembleHtmlAttributes(['class' => 'component-name__element']); ?>>
```

❌ Incorrect:
```php
<?php
use function Hacon\ThemeCore\assembleHtmlAttributes; // Don't add this!
```

## Component Rendering

Use `render_component_template()` (not `component()`) with the **full theme-relative path** to the template:

✅ `render_component_template('source/components/button/button.php', $htmlAttributes, $props);`
✅ `render_component_template('source/components/parent/child/child.php', $htmlAttributes, $props);`

## Auto-Generated Files

`theme-require-mapping.json` is 100% auto-generated — never read, edit, or worry about stale references in it.

## Agent: Component Reference Retrieval

When building a component that uses other components, launch an Explore/haiku agent to read the referenced component's `.includes.php` file for its function signature and props. Details in `.claude/agents/component-reference-agent.md`.
