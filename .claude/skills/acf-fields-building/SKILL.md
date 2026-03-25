---
name: acf-fields-building
description: Build ACF field definition arrays for blocks, theme options, and repeaters. Use when constructing the fields array for any ACF registration (createACFBlock, acf_add_local_field_group, .acf.fields.php).
---

# ACF Field Definitions

This is the single reference for building ACF field arrays. All field types, organization patterns, and naming conventions live here.

## Predefined Field Factories

Defined in `includes/acf.predefined-fields.php`. Use these instead of building common fields manually:

```php
// Margin bottom (returns CSS class like "mb-3") — always include in Layouting tab
get_acf_margin_select_field()
get_acf_margin_select_field(['default_value' => 'mb-3', 'wrapper' => ['width' => 33]])
get_acf_margin_select_field(['direction' => 'top'])  // margin-top variant

// Size/spacing select (returns size key like "3", "4-5") — for padding, gap, etc.
get_acf_size_select_field([
    'key'   => 'field_bg_wrapper_padding_top',
    'name'  => 'padding_top',
    'label' => 'Padding Top',
    'sizes' => ['1', '1-5', '2', '3', '4', '5', '6'],  // subset of available sizes
])

// Heading tag select (returns tag like "h2", "p", "span")
get_acf_heading_tag_field([
    'key'           => 'field_ph_title_tag',
    'name'          => 'title_tag',
    'label'         => 'Title Tag',
    'default_value' => 'h1',
])
```

All size labels and choices are sourced from `config/sizes.json` — the single source of truth for the responsive size system.

## Field Types

```php
// Text
['key' => 'field_title', 'name' => 'title', 'label' => 'Title', 'type' => 'text']

// Textarea
['key' => 'field_desc', 'name' => 'description', 'label' => 'Description', 'type' => 'textarea']

// WYSIWYG
['key' => 'field_content', 'name' => 'content', 'label' => 'Content', 'type' => 'wysiwyg']

// Image — ALWAYS 'return_format' => 'id'. Render via component_image(), never <img> tags.
['key' => 'field_image', 'name' => 'image', 'label' => 'Image', 'type' => 'image', 'return_format' => 'id']

// Gallery — ALWAYS 'return_format' => 'id'
['key' => 'field_images', 'name' => 'images', 'label' => 'Images', 'type' => 'gallery', 'return_format' => 'id']

// Link — native ACF Pro type with built-in picker UI. Returns ['url', 'title', 'target'].
// NEVER use a group with separate url/text/target sub-fields for links.
['key' => 'field_link', 'name' => 'link', 'label' => 'Link', 'type' => 'link']

// Select
[
    'key' => 'field_orientation',
    'name' => 'orientation',
    'label' => 'Orientation',
    'type' => 'select',
    'choices' => ['_left' => 'Left', '_right' => 'Right'],
    'default_value' => '_right',
]

// True/False
['key' => 'field_show_cta', 'name' => 'show_cta', 'label' => 'Show CTA', 'type' => 'true_false', 'default_value' => 1]

// Half-width layout (any field)
['key' => 'field_phone', 'name' => 'phone', 'label' => 'Phone', 'type' => 'text', 'wrapper' => ['width' => 50]]

// Conditional logic (show only when another field has specific value)
[
    'key' => 'field_image',
    'name' => 'image',
    'type' => 'image',
    'return_format' => 'id',
    'conditional_logic' => [
        [['field' => 'field_orientation', 'operator' => '!=', 'value' => '_no-image']],
    ],
]

// Message (info text, no data — `name` is always '')
[
    'key'     => 'field_info',
    'name'    => '',
    'label'   => '',
    'type'    => 'message',
    'message' => 'Helpful text or HTML for editors.',
]
```

## Compound Fields

### Repeater

```php
[
    'key'          => 'field_items',
    'name'         => 'items',
    'label'        => 'Items',
    'type'         => 'repeater',
    'layout'       => 'block',
    'button_label' => 'Add Item',
    'sub_fields'   => [
        ['key' => 'field_item_title', 'name' => 'title', 'label' => 'Title', 'type' => 'text'],
        ['key' => 'field_item_link', 'name' => 'link', 'label' => 'Link', 'type' => 'link'],
        ['key' => 'field_item_image', 'name' => 'image', 'label' => 'Image', 'type' => 'image', 'return_format' => 'id'],
    ],
]
```

Sub-field `name` stays short (`title`, `link`). Sub-field `key` includes parent prefix for uniqueness (`field_item_title`).

### Group

Bundle 2+ related fields. Sub-field `name` stays short — the group name provides context:

```php
[
    'key'        => 'field_author',
    'name'       => 'author',
    'label'      => 'Author',
    'type'       => 'group',
    'layout'     => 'block',
    'sub_fields' => [
        ['key' => 'field_author_name', 'name' => 'name', 'label' => 'Name', 'type' => 'text'],
        ['key' => 'field_author_photo', 'name' => 'photo', 'label' => 'Photo', 'type' => 'image', 'return_format' => 'id'],
    ],
]
```

ACF returns: `$fields['author'] = ['name' => '...', 'photo' => 123]`.

**When to use groups:** When 2+ fields belong together conceptually (CTA title+button, author name+photo). **Never use groups for links** — use native `'type' => 'link'`.

## Tabs

Tabs are purely visual — they don't nest data. Use them to split the editor UI into logical sections:

```php
['key' => 'field_tab_content', 'label' => 'Content', 'type' => 'tab']
['key' => 'field_tab_layouting', 'label' => 'Layouting', 'type' => 'tab']
```

**When to use:** When a block or options page has 4+ fields. Content tab holds user-facing data, Layouting tab holds layout options and `get_acf_margin_select_field()`.

Tab keys use the format `field_tab_{slug}_{section}`. Tabs have no `name`.

## Combined Example

```php
[
    // --- Content tab ---
    ['key' => 'field_tab_content', 'label' => 'Content', 'type' => 'tab'],
    ['key' => 'field_title', 'name' => 'title', 'label' => 'Title', 'type' => 'text'],
    ['key' => 'field_link', 'name' => 'link', 'label' => 'Link', 'type' => 'link'],
    [
        'key' => 'field_author',
        'name' => 'author',
        'label' => 'Author',
        'type' => 'group',
        'layout' => 'block',
        'sub_fields' => [
            ['key' => 'field_author_name', 'name' => 'name', 'label' => 'Name', 'type' => 'text'],
            ['key' => 'field_author_photo', 'name' => 'photo', 'label' => 'Photo', 'type' => 'image', 'return_format' => 'id'],
        ],
    ],

    // --- Layouting tab ---
    ['key' => 'field_tab_layouting', 'label' => 'Layouting', 'type' => 'tab'],
    [
        'key' => 'field_orientation',
        'name' => 'orientation',
        'label' => 'Orientation',
        'type' => 'select',
        'choices' => ['_left' => 'Left', '_right' => 'Right'],
        'default_value' => '_right',
    ],
    get_acf_margin_select_field(),
]
```

## Key Naming

| Context | `key` | `name` |
|---|---|---|
| Block content field | `field_{block_slug}_{field}` | `{block_slug}_{field}` |
| Theme options field | `field_{field_name}` | `field_{field_name}` |
| Sub-field (group/repeater) | `field_{parent}_{sub}` (unique) | `{sub}` (short) |
| Tab | `field_tab_{slug}_{section}` | *(no name)* |
| Message | `field_{slug}_info` | `''` |

## Critical Rules

1. **Images**: always `'return_format' => 'id'` — render via `component_image()`, never manual `<img>` tags
2. **Links**: always native `'type' => 'link'` — never separate url/text/target fields
3. **Groups**: use for 2+ related fields, never for links
4. **Sub-field `name`**: short (`title`, `text`); sub-field **`key`**: includes parent prefix for uniqueness
5. **Field keys must be globally unique** across all ACF registrations in the project
6. **Tabs are visual only** — no data nesting. Groups nest data.
7. **Use predefined factories** for margins (`get_acf_margin_select_field`), sizes/padding (`get_acf_size_select_field`), and heading tags (`get_acf_heading_tag_field`) — never hardcode their choices manually
