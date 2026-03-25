---
name: component-global-defaults
description: Create block default settings for a component (.acf.fields.php, .acf.theme-option.php). Use when a component needs site-wide default values editable in WP admin that individual block instances can override.
---

# Component Block Defaults

When a block has site-wide default content managed from WP admin, these files provide the infrastructure:

```
source/components/{name}/
├── {name}.acf.fields.php           ← shared field definitions (source of truth)
├── {name}.acf.php                  ← Gutenberg block — see component-acf-block skill
├── {name}.acf.theme-option.php     ← WP admin defaults page
└── {name}.includes.php             ← consumes defaults with fallback — see component-php-includes skill

acf/theme-options/
└── block-defaults.php              ← root page + component loader (one per project)
```

If the block has no global defaults (instance-only fields), only `.acf.php` is needed — fields go inline.

## `block-defaults.php` — Root Page

File: `acf/theme-options/block-defaults.php` — create once per project. Auto-loaded via `config/acf.php`.

```php
<?php

acf_add_options_page([
    'page_title' => 'Block Defaults',
    'menu_title' => 'Block Defaults',
    'menu_slug'  => 'block-defaults',
    'capability' => 'edit_theme_options',
    'icon_url'   => 'dashicons-layout',
    'redirect'   => true,
]);

requireAll(path_join(getThemeСonfig('components.base'), '**/*.acf.theme-option.php'));
```

## `{name}.acf.fields.php` — Shared Field Definitions

Returns an array of content fields shared by both the block (`.acf.php`) and the admin defaults page (`.acf.theme-option.php`).

Field `key` and `name` both use the `{block_slug}_{field_name}` prefix for global uniqueness:

```php
<?php
// cta-section-bar.acf.fields.php

return [
    [
        'key'           => 'field_cta_section_bar_image',
        'name'          => 'cta_section_bar_image',
        'label'         => 'Image',
        'type'          => 'image',
        'return_format' => 'id',
    ],
    [
        'key'   => 'field_cta_section_bar_title',
        'name'  => 'cta_section_bar_title',
        'label' => 'Title',
        'type'  => 'text',
    ],
    [
        'key'   => 'field_cta_section_bar_button',
        'name'  => 'cta_section_bar_button',
        'label' => 'Button',
        'type'  => 'link',
    ],
];
```

For field type definitions and examples, see **`acf-fields-building`** skill.

## `{name}.acf.theme-option.php` — Admin Defaults Sub-Page

Registers the Block Defaults sub-page and field group. Uses the same `$fields` array as the block, with a preview image at the top:

```php
<?php

$fields = require __DIR__ . '/cta-section-bar.acf.fields.php';

acf_add_options_sub_page([
    'page_title'  => 'CTA Section Bar',
    'menu_title'  => 'CTA Section Bar',
    'parent_slug' => 'block-defaults',
    'menu_slug'   => 'block-defaults-cta-section-bar',
]);

acf_add_local_field_group([
    'key'    => 'group_block_defaults_cta_section_bar',
    'title'  => 'Block Defaults - CTA Section Bar',
    'fields' => array_merge(
        [
            [
                'key'     => 'field_cta_section_bar_preview',
                'label'   => 'Block Appearance Example',
                'name'    => '',
                'type'    => 'message',
                'message' => '<img src="' . get_template_directory_uri() . '/source/components/cta-section-bar/image.png" alt="CTA Section Bar" style="max-width:100%;height:auto;border-radius:6px;" />',
            ],
        ],
        $fields
    ),
    'location' => [
        [['param' => 'options_page', 'operator' => '==', 'value' => 'block-defaults-cta-section-bar']],
    ],
]);
```

## How `.acf.php` Imports Shared Fields

The block registration file imports the same fields and adds a message linking to the defaults page:

```php
$fields = require __DIR__ . '/cta-section-bar.acf.fields.php';

createACFBlock(
    ['name' => 'cta-section-bar', ...],
    [
        ['key' => 'field_tab_cta_section_bar_content', 'label' => 'Content', 'type' => 'tab'],
        [
            'key'     => 'field_cta_section_bar_info',
            'name'    => '',
            'label'   => '',
            'type'    => 'message',
            'message' => 'Default content is pulled from <a href="' . admin_url('admin.php?page=block-defaults-cta-section-bar') . '" target="_blank">CTA Section Bar</a> settings. Add values below to override.',
        ],
        ...$fields,
        ['key' => 'field_tab_cta_section_bar_layouting', 'label' => 'Layouting', 'type' => 'tab'],
        get_acf_margin_select_field(),
    ],
    function ($fields, $context) { ... }
);
```

See `component-acf-block` skill for the full `.acf.php` template and callback patterns.

## Naming Conventions

| Item | Pattern | Example |
|------|---------|---------|
| Fields file | `{name}.acf.fields.php` | `cta-section-bar.acf.fields.php` |
| Theme-option file | `{name}.acf.theme-option.php` | `cta-section-bar.acf.theme-option.php` |
| Page slug | `block-defaults-{name}` | `block-defaults-cta-section-bar` |
| Page title | Exact title-cased component name | `CTA Section Bar` |
| Field key | `field_{block_slug}_{field_name}` | `field_cta_section_bar_image` |
| Field name | `{block_slug}_{field_name}` | `cta_section_bar_image` |
| Group key | `group_block_defaults_{block_slug}` | `group_block_defaults_cta_section_bar` |

## Critical Rules

1. **Field naming**: `key = field_{block_slug}_{field_name}`, `name = {block_slug}_{field_name}` — both prefixed for global uniqueness
2. **Page title**: exact title-cased component name — never abbreviate
3. **Page slug**: `block-defaults-{component-name}` — must match the `location` rule value
4. **First field**: always a `message` field (`name = ''`) rendering `image.png` via `get_template_directory_uri()`
5. **`block-defaults.php`** must exist before any `.acf.theme-option.php` files
6. For field type rules (images, links, sub-fields) — see **`acf-fields-building`** skill
