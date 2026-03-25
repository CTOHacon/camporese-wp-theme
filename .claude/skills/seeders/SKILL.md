---
name: seeders
description: Create seeders that populate ACF options with default content. Use when a component or page needs default data seeded into WordPress options (theme settings, menus, repeater fields, etc.).
---

# Seeders

Seeders populate ACF options with default content. All seeders use `Seeders::register()` and are run from the WP admin seeder panel.

## Two Types of Seeders

### 1. Component Seeders — `{name}.acf.seeder.php`

Live **inside the component folder**. Auto-loaded by `seeders/component-seeders.php` via glob `**/*.acf.seeder.php`.

```
source/components/services-modal/services-modal.acf.seeder.php
source/components/footer/footer.acf.seeder.php
```

Use for: seeding the component's own ACF theme option fields (the ones defined in the component's `.acf.theme-option.php` or the related `theme-parts.*.php` page).

### 2. Standalone Seeders — `seeders/{name}.php`

Live in the `seeders/` directory. Used for site-wide data not tied to a single component (menus, contacts, global settings).

```
seeders/footer-menu.php
seeders/contacts.php
```

## Pattern

Both types use the same `Seeders::register()` API:

```php
<?php

use Hacon\ThemeCore\ThemeModules\Seeders\Seeders;

Seeders::register('seeder_name', function () {
    update_field('field_name', $value, 'option');
});
```

- Seeder name uses `snake_case` matching the component or data group
- `update_field` takes the ACF **field name** (not the `field_` key), the value, and `'option'`

## Repeater Field Values

Pass an array of rows. Each row is an associative array of sub-field names to values:

```php
update_field('services_modal_large_cards', [
    [
        'image' => '',                              // image ID — leave '' if seeding text only
        'title' => 'Humane Wildlife Removal',
        'text'  => 'We safely and ethically remove wildlife from your property.',
        'link'  => ['url' => '/humane-wildlife-removal/', 'title' => 'Humane Wildlife Removal', 'target' => ''],
    ],
    // ...
], 'option');
```

For **link sub-fields**, always provide the full array `{url, title, target}` — never a plain string.

For **image sub-fields**, use `''` when seeding text-only content (images added manually). Never use `null` or `false`.

## Full Component Seeder Example

```php
<?php

use Hacon\ThemeCore\ThemeModules\Seeders\Seeders;

Seeders::register('services_modal', function () {
    update_field('services_modal_large_cards', [
        [
            'image' => '',
            'title' => 'Humane Wildlife Removal',
            'text'  => 'We safely and ethically remove wildlife from your property.',
            'link'  => ['url' => '/humane-wildlife-removal/', 'title' => 'Humane Wildlife Removal', 'target' => ''],
        ],
    ], 'option');

    update_field('services_modal_small_cards', [
        ['image' => '', 'title' => 'Raccoon Control', 'link' => ['url' => '/racoon-control-removal/', 'title' => 'Raccoon Control', 'target' => '']],
    ], 'option');
});
```

## Critical Rules

1. **Naming**: component seeders use `{component-name}.acf.seeder.php` — the `.acf.` infix is required for auto-loading
2. **Never** use `wp eval-file` instructions or standalone `if (!defined('ABSPATH'))` guards — use `Seeders::register()` exclusively
3. **field name, not key**: `update_field('services_modal_large_cards', ...)` not `update_field('field_services_modal_large_cards', ...)`
4. Image fields: use `''` for placeholder, never `null` or `false`
5. Link fields: always full array `{url, title, target}`
