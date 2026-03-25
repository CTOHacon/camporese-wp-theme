---
name: acf-global-settings
description: Create or modify ACF theme options pages (global settings) in acf/theme-options/. Use when adding site-wide settings like contacts, social links, header/footer config, or any global theme option.
---

# ACF Global Settings (Theme Options) Creation

Create or modify ACF options pages in `acf/theme-options/`. These files are auto-loaded via `config/acf.php` — no manual registration needed.

## File Structure

### Top-Level Options Page

File: `acf/theme-options/{category}.php`

```php
<?php

acf_add_options_page([
    'page_title' => 'Page Title',
    'menu_title' => 'Menu Title',
    'menu_slug'  => 'menu-slug',
    'capability' => 'edit_theme_options',
    'icon_url'   => 'dashicons-icon-name',
    'redirect'   => false, // true if this is a parent-only container
]);

acf_add_local_field_group([
    'key'      => 'group_{menu_slug}',
    'title'    => 'Page Title',
    'fields'   => [
        // Fields here
    ],
    'location' => [
        [['param' => 'options_page', 'operator' => '==', 'value' => 'menu-slug']],
    ],
]);
```

### Sub-Page Options

File: `acf/theme-options/{parent}.{sub-category}.php`

```php
<?php

acf_add_options_sub_page([
    'page_title'  => 'Sub Page Title',
    'menu_title'  => 'Sub Menu Title',
    'parent_slug' => 'parent-menu-slug',
    'menu_slug'   => 'parent-sub-menu-slug',
]);

acf_add_local_field_group([
    'key'      => 'group_{parent}_{sub}',
    'title'    => 'Group Title',
    'fields'   => [
        // Fields here
    ],
    'location' => [
        [['param' => 'options_page', 'operator' => '==', 'value' => 'parent-sub-menu-slug']],
    ],
]);
```

## Block Defaults

For per-component block defaults (`.acf.fields.php`, `.acf.theme-option.php`, `block-defaults.php`), see the **`component-global-defaults`** skill.

## Naming Conventions

| Item | Pattern | Example |
|------|---------|---------|
| Top-level file | `{category}.php` | `contacts.php` |
| Sub-page file | `{parent}.{sub}.php` | `contacts.contact-form.php` |

## Field Types & Organization

For field type definitions, tabs, groups, and naming — see **`acf-fields-building`** skill.

## Organizational Patterns

### Standalone settings page

`contacts.php`, `scripts.php` — direct `acf_add_options_page` + field group.

### Settings with sub-pages

`theme-parts.php` (redirect container) + `theme-parts.header.php`, `theme-parts.footer.php`.

## Critical Rules

1. Files in `acf/theme-options/` are auto-loaded — no manual require needed
2. Menu slugs must be globally unique across WP admin
3. Field group `location.value` must match the page's `menu_slug`
4. Always retrieve with `get_field('field_name', 'option')` — `'option'` param is required
5. Use `'redirect' => true` for parent-only container pages
6. For field type rules (images, links, keys) — see **`acf-fields-building`** skill
