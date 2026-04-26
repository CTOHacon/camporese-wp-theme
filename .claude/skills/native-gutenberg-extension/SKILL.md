---
name: native-gutenberg-extension
description: Create a native Gutenberg block extension that modifies or enhances existing core WordPress blocks (paragraph, heading, separator, list, table, etc.) with custom attributes, inspector sidebar controls, editor preview classes, and frontend rendering. Use when the user wants to add custom toggles/selects/fields to core blocks, inject CSS classes onto native blocks, extend the block editor sidebar for core blocks, or modify how core blocks render on the frontend via render_block. This is NOT for creating new ACF blocks — it only extends existing WordPress core blocks. Use even when the user says "add a field to paragraphs" or "modify headings in the editor" without explicitly mentioning Gutenberg extensions.
---

# Native Gutenberg Block Extension

Extend existing WordPress core blocks with custom attributes, sidebar controls, editor preview behavior, and frontend rendering.

## File Structure

Each feature gets its own files inside `source/editor-block-extensions/`:

```
source/editor-block-extensions/
├── enqueue.php                     # Central registry — enqueues all JS, requires all render PHP
├── {feature-name}.js               # Editor: attributes + controls + preview
├── {feature-name}.render.php       # Frontend: render_block filter (only when needed)
```

Connection chain: `functions.php` → `requireAll('includes/*.php')` → `includes/theme.editor-block-extensions.php` → `source/editor-block-extensions/enqueue.php`.

## JS File — Three Layers

The JS file is a plain script (no ES modules, no Vite) wrapped in `(function (wp) { ... })(window.wp);`. It uses `wp.hooks.addFilter` to hook into three extension points. Include only the layers the feature needs.

**Layer 1 — Custom attributes** (`blocks.registerBlockType`): Adds attribute definitions to target blocks. Each attribute has a `type` (`'boolean'`, `'string'`, `'number'`) and `default`.

**Layer 2 — Inspector controls** (`editor.BlockEdit`): Adds sidebar panel with controls via `createHigherOrderComponent`. Uses `InspectorControls` > `PanelBody` > control elements. Available controls from `wp.components`: `ToggleControl` (boolean), `SelectControl` (string dropdown), `TextControl` (string input), `RangeControl` (number slider).

**Layer 3 — Editor preview** (`editor.BlockListBlock`): Applies CSS classes to the block wrapper in the editor so toggles are visually reflected. Skip this layer for data-only attributes with no visual effect.

Each layer's filter uses the `TARGET_BLOCKS` array defined at the top of the IIFE to scope which core blocks are affected.

Read `source/editor-block-extensions/editor-block-extensions.js` as the canonical reference for the JS pattern — it demonstrates all three layers.

## Render PHP File — Frontend Output

When the extension modifies frontend rendering, create a `{feature-name}.render.php` file. The most common pattern is a `render_block` filter that injects CSS classes into the block's opening HTML tag using regex.

The regex must handle two cases: the tag already has a `class` attribute (prepend), or it doesn't (add one). Match HTML tags to block types: `p` for paragraph, `h[1-6]` for heading, `hr` for separator, `ul|ol` for list, `table` for table.

Use `sanitize_html_class()` for any dynamic string values from block attributes.

Read the `render_block` filter in `source/editor-block-extensions/enqueue.php` as the canonical reference for this pattern.

## Registering in enqueue.php

**JS enqueue**: Add `wp_enqueue_script` inside the existing `enqueue_block_editor_assets` action. Handle: `camporese-{feature-name}`. Dependencies: list every `wp-*` package the script uses. Version: `filemtime()` for cache busting.

**PHP data → JS**: Use `wp_localize_script` right after enqueue to pass server-side data (ACF choices, theme options). Variable name: `camporese{FeatureName}` in camelCase.

**Render PHP**: Require the `.render.php` file at the top of `enqueue.php`, outside any hook.

## Naming Conventions

- Filter namespace: `camporese/{feature-name}-{purpose}` (e.g. `camporese/spacing-attributes`)
- HOC name: `with{FeatureName}{Purpose}` (e.g. `withSpacingControls`)
- Script handle: `camporese-{feature-name}`
- CSS classes: `_` prefix BEM modifiers (e.g. `_is-accent`, `_has-opacity`)
