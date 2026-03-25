---
name: component-acf-block
description: Create an ACF Pro block registration file (.acf.php) for a component. Use when a component needs to be available as a Gutenberg block in WordPress admin.
---

# ACF Pro Block File Creation

Create the `.acf.php` file for a component in `source/components/{component-name}/`.

This file registers the component as a Gutenberg block using ACF PRO's `createACFBlock()` helper.

## Files

For blocks with editable global defaults, see **`component-global-defaults`** skill for `.acf.fields.php` and `.acf.theme-option.php`. This skill covers the `.acf.php` block registration file.

### `{name}.acf.php`

Imports the fields file, spreads them into a flat array with tabs and margin, and maps prefixed field names to component props in the callback.

When the block has a Block Defaults settings page, include a `message` field after the Content tab that links editors to the global defaults:

```php
<?php

$fields = require __DIR__ . '/component-name.acf.fields.php';

createACFBlock(
    [
        'name'          => 'component-name',
        'title'         => 'Component Name',
        'category'      => 'theme-blocks',
        'icon'          => 'admin-site',
        'mode'          => 'preview',
        'supports'      => ['align' => false],
        'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), 'component-name/*.png')),
    ],
    [
        ['key' => 'field_tab_component_name_content', 'label' => 'Content', 'type' => 'tab'],
        // ↓ Include when block has a Block Defaults settings page
        [
            'key'     => 'field_component_name_info',
            'name'    => '',
            'label'   => '',
            'type'    => 'message',
            'message' => 'Default content is pulled from <a href="' . admin_url('admin.php?page=block-defaults-component-name') . '" target="_blank">Component Name</a> settings. Add values below to override.',
        ],
        ...$fields,
        ['key' => 'field_tab_component_name_layouting', 'label' => 'Layouting', 'type' => 'tab'],
        get_acf_margin_select_field(),
    ],
    function ($fields, $context) {
        component_component_name(
            ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
            [
                'title' => $fields['component_name_title'] ?? null,
                'image' => $fields['component_name_image'] ?? null,
            ]
        );
    }
);
```

## Always Required

1. `'mode' => 'preview'` — always
2. `get_acf_margin_select_field()` — always include as last field
3. `'return_format' => 'id'` — for ALL image fields
4. Callback always passes `$fields['margin_bottom']` and `$context['block']['className']` to class array
5. `'preview_image'` — always include, replace `component-name` with actual name:
   `'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), '{component-name}/*.png'))`

## Predefined Field Factories

Use these instead of hardcoding choices — see **`acf-fields-building`** skill for full API:

- `get_acf_margin_select_field($args)` — margin select, returns CSS class (`mb-3`)
- `get_acf_size_select_field($args)` — size/padding select, returns size key (`3`, `4-5`)
- `get_acf_heading_tag_field($args)` — heading tag select, returns tag (`h2`, `p`)

All size choices come from `config/sizes.json`.

## Field Types & Organization

For field type definitions (text, image, link, repeater, group, etc.), tabs, groups, and naming — see **`acf-fields-building`** skill.

## Callback Patterns

### Basic (no groups)

```php
function ($fields, $context) {
    component_component_name(
        ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
        $fields
    );
}
```

### Flatten group fields (standard pattern for groups)

ACF groups return nested arrays. **Always flatten** them before passing to the component, so the template receives flat variables via `extract()`:

```php
// Group 'cta' with sub-fields 'text' and 'url'
// ACF returns: $fields['cta'] = ['text' => '...', 'url' => '...']
// Component needs: $cta_text, $cta_url

function ($fields, $context) {
    $cta = $fields['cta'] ?: [];  // ?: not ?? — ACF returns false for empty groups
    $fields['cta_text'] = $cta['text'] ?? null;
    $fields['cta_url'] = $cta['url'] ?? null;
    unset($fields['cta']);

    component_component_name(
        ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
        $fields
    );
}
```

### Process repeater items (e.g. flatten link inside each row)

ACF returns `false` for an empty repeater — use `?:` not `??` when reading repeater fields:

```php
function ($fields, $context) {
    // ✅ ?: handles ACF's false return for empty repeaters
    $items = $fields['items'] ?: [];
    foreach ($items as &$item) {
        $link = $item['link'] ?? [];
        $item['link_url']    = $link['url']    ?? null;
        $item['link_title']  = $link['title']  ?? null;
        $item['link_target'] = $link['target'] ?? null;
        unset($item['link']);
    }
    unset($item);
    $fields['items'] = $items;

    component_component_name(
        ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
        $fields
    );
}
```

### Flatten link field + group

```php
function ($fields, $context) {
    // Flatten native 'link' field (returns ['url', 'title', 'target'])
    $link = $fields['link'] ?? [];
    $fields['link_url'] = $link['url'] ?? null;
    $fields['link_title'] = $link['title'] ?? null;
    $fields['link_target'] = $link['target'] ?? null;
    unset($fields['link']);

    // Flatten 'author' group
    $author = $fields['author'] ?? [];
    $fields['author_name'] = $author['name'] ?? null;
    $fields['author_photo'] = $author['photo'] ?? null;
    unset($fields['author']);

    component_component_name(
        ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
        $fields
    );
}
```

### With InnerBlocks (requires `'jsx' => true` in supports)

```php
function ($fields, $context) {
    $content = $context['is_preview'] ? '<InnerBlocks />' : do_blocks($context['content']);

    component_component_name(
        ['class' => [$fields['margin_bottom'] ?? null, $context['block']['className'] ?? null]],
        $fields + ['slot' => $content]
    );
}
```

### With select modifier as class

```php
function ($fields, $context) {
    component_component_name(
        ['class' => [
            $fields['margin_bottom'] ?? null,
            $context['block']['className'] ?? null,
            $fields['orientation'] ?? null, // e.g. '_left-image', '_right-image'
        ]],
        $fields
    );
}
```

## Field Key Naming

- **Content fields**: `key = field_{block_slug}_{field_name}`, `name = {block_slug}_{field_name}` — block slug as prefix on both, scopes fields globally
- **Sub-field keys** (inside groups/repeaters): `field_{block_slug}_{parent}_{sub_name}` for uniqueness; sub-field `name` stays short (`url`, `title`)
- **Tab keys**: `field_tab_{block_slug}_{section_name}` — tabs have no `name`
- Prefixed names flow through the callback: `$fields['block_slug_field_name']` maps to component props

## Critical Rules

1. Always `'mode' => 'preview'`
2. Always include `get_acf_margin_select_field()`
3. Always include `'preview_image' => getThemeFileUri(path_join(getThemeСonfig('components.base'), '{name}/*.png'))`
4. `'jsx' => true` ONLY when using InnerBlocks
5. Groups and repeaters: read with `($fields['key'] ?? null) ?: []` — `??` suppresses "Undefined array key" on new/unsaved blocks; `?:` handles ACF's `false` return for empty groups/repeaters
6. InnerBlocks: use `$context['is_preview'] ? '<InnerBlocks />' : do_blocks($context['content'])`
7. Callback signature is always `function ($fields, $context)` — `$context` contains: `block`, `is_preview`, `content`, `post_id`
8. Use **spread operator** `...$fields` to inline shared fields. `array_merge()` also works for interspersing arrays
9. When the block has a Block Defaults settings page, use **`component-global-defaults`** skill and add a `message` field linking to `admin_url('admin.php?page=block-defaults-{slug}')`
