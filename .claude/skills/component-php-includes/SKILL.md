---
name: component-php-includes
description: Create or modify a component's .includes.php file — the data/logic layer that provides the component function, handles defaults, global settings fallback, and data processing before passing props to the template.
---

# Component `.includes.php` — Data & Logic Layer

The `.includes.php` file is the **data layer** of a component. It:
- Provides the public `component_{name}()` function that other code calls
- Sets default values for all props
- Fetches global ACF settings as fallbacks when props aren't provided
- Transforms and restructures raw data before passing to the template
- Registers side-effects (form handlers, filters, WP hooks)

The **template** (`.php`) receives these props and handles all rendering. **The hard boundary: `.includes.php` never generates HTML.** No `echo`, no closures that output markup — only data shaping. If it writes angle brackets, it belongs in the template.

## File Location

`source/components/{category}/{component-name}/{component-name}.includes.php`

**Child components** live inside the parent folder:
`source/components/{category}/{parent-name}/{child-name}/{child-name}.includes.php`

Auto-loaded by the system — no manual require needed.

---

## Complexity Levels

### Level 1: Simple Pass-Through

For components with no data logic — just a function wrapper:

```php
<?php
/**
 * Button
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $type Button type modifier (solid|rounded|accent)
 * }
 */
function component_button($htmlAttributes = [], $props = [])
{
    render_component_template('button', 'source/components/core/button/button.php', $htmlAttributes, $props);
}
```

Use when: primitive UI components (button, icon, image wrapper) where all props come from the caller and need no defaults or transformation.

### Level 2: Props Mapping with Defaults

For components that need explicit prop mapping and default values:

```php
<?php
/**
 * ContentBlock
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $title      Block title
 *     @type string $title_tag  Heading tag (h2|h3)
 *     @type string $slot       HTML content
 *     @type int    $image      Image attachment ID
 * }
 */
function component_content_block($htmlAttributes = [], $props = [])
{
    $props = [
        'title'     => $props['title'] ?? null,
        'title_tag' => $props['title_tag'] ?? 'h2',
        'slot'      => $props['slot'] ?? null,
        'image'     => $props['image'] ?? null,
    ];

    render_component_template('content-block', 'source/components/sections/content-block/content-block.php', $htmlAttributes, $props);
}
```

Use when: component has enum defaults (`'h2'`), boolean defaults, or you want an explicit prop contract.

### Level 3: Global Settings Fallback

For components that use ACF theme options as defaults, but allow per-instance overrides via props:

```php
<?php
/**
 * FaqSection
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type bool   $show_head          Show section head
 *     @type string $head_title         Section head title
 *     @type string $head_text          Section head text
 *     @type array  $items              FAQ items [{question, answer}]
 *     @type int    $default_open_index Index of item open by default
 *     @type bool   $show_cta           Show CTA block
 *     @type string $cta_title          CTA title
 *     @type string $cta_text           CTA text
 *     @type array  $cta_buttons        CTA buttons [{text, url, type}]
 * }
 */
function component_faq_section($htmlAttributes = [], $props = [])
{
    $global_head  = get_field('faq_section_head', 'option') ?: [];
    $global_cta   = get_field('faq_section_cta', 'option') ?: [];
    $global_items = get_field('faq_section_items', 'option') ?: [];

    $props = [
        'show_head'          => $props['show_head'] ?? true,
        'head_title'         => ($props['head_title'] ?? null) ?: $global_head['title'] ?? null,
        'head_text'          => ($props['head_text'] ?? null) ?: $global_head['text'] ?? null,
        'items'              => ($props['items'] ?? null) ?: $global_items,
        'default_open_index' => $props['default_open_index'] ?? 0,
        'show_cta'           => $props['show_cta'] ?? true,
        'cta_title'          => ($props['cta_title'] ?? null) ?: $global_cta['title'] ?? null,
        'cta_text'           => ($props['cta_text'] ?? null) ?: $global_cta['text'] ?? null,
        'cta_buttons'        => ($props['cta_buttons'] ?? null) ?: $global_cta['buttons'] ?? [],
    ];

    render_component_template('faq-section', 'source/components/sections/faq-section/faq-section.php', $htmlAttributes, $props);
}
```

**Prop-with-global-fallback pattern** (use for ALL string/scalar props that have a global default):
```php
// ✅ (?? null) = safe key access; ?: = falls through on null OR '' (ACF's empty-field return)
'title'      => ($props['title'] ?? null) ?: get_field('component_title', 'option') ?: null,
'head_title' => ($props['head_title'] ?? null) ?: $global_head['title'] ?? null,

// ❌ Wrong — ?? only catches null/undefined; '' from an unfilled ACF field passes through
'head_title' => $props['head_title'] ?? $global_head['title'] ?? null,

// ❌ Wrong — bare ?: triggers Undefined array key when $props = []
'head_title' => $props['head_title'] ?: $global_head['title'],
```

Use when: component has site-wide defaults in theme options that individual instances can override (FAQ sections, CTA blocks, contact sections, review sections).

#### Where to find global settings

- **Block defaults** (per-component): field names come from `{name}.acf.fields.php` — fetch with `get_field('{block_slug}_{field_name}', 'option')`
- **Site-wide settings**: defined in `acf/theme-options/*.php` — look for `'name'` values in `acf_add_local_field_group`

### Level 4: Data Processing

For components that need to transform, compute, or enrich data before rendering:

```php
<?php
/**
 * PageTypographyContent
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $slot         HTML content
 *     @type int    $banner_image Image ID
 * }
 */
function component_page_typography_content($htmlAttributes = [], $props = [])
{
    $slot     = $props['slot'] ?? null;
    $tocItems = [];

    if ($slot) {
        $result   = process_typography_content_headings($slot);
        $slot     = $result['content'];
        $tocItems = $result['toc_items'];
    }

    $props = [
        'slot'         => $slot,
        'toc_items'    => $tocItems,
        'banner_image' => $props['banner_image'] ?? null,
    ];

    render_component_template('page-typography-content', 'source/components/sections/page-typography-content/page-typography-content.php', $htmlAttributes, $props);
}
```

Use when: content needs parsing, derived props need computing, or data needs restructuring. Helper functions for heavy processing should be defined in the same file.

**Data processing boundary:** `.includes.php` only shapes raw data — arrays, strings, IDs. It never generates HTML. If a component needs grouped data for a sub-loop (e.g. images chunked into slides), pass the raw chunks as a prop and let the template build the markup:

```php
// ✅ includes.php — shape the data, pass raw chunks
$image_chunks = !empty($images) ? array_chunk($images, $per_slide) : [];
$props = ['image_chunks' => $image_chunks];

// ✅ template (.php) — build rendering logic from the data
<?php foreach ($image_chunks as $chunk): ?>
    <div class="gallery__slide">
        <?php foreach ($chunk as $image_id): ?>
            <?php component_image(['class' => 'gallery__image'], ['reference' => $image_id]); ?>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>

// ❌ includes.php — closures that echo HTML violate the data-layer boundary
$slides = array_map(fn($chunk) => function() use ($chunk) {
    echo '<div class="gallery__slide">';   // ← HTML in includes = wrong
    foreach ($chunk as $id) { component_image(...); }
    echo '</div>';
}, $image_chunks);
```

When the sub-component (e.g. `basic_slider`) requires callable slides, build those callables in the template, not in `.includes.php`.

### Level 5: Side-Effects & Handlers

For components that register WP hooks, AJAX handlers, or filters:

```php
<?php

use Hacon\ThemeCore\Handlers\FormAjaxHandler\FormAjaxHandler;

add_action('init', function () {
    $handler = new FormAjaxHandler('regular_contact_regular_submit');

    $handler
        ->addField('name', ['required'])
        ->addField('email', ['required', 'email'])
        ->addField('phone', ['required', 'tel'])
        ->addField('message', []);

    // Global settings for form config
    $emails = [];
    $acf_emails = get_field('field_contact_form_emails', 'option');
    if (is_array($acf_emails)) {
        foreach ($acf_emails as $email) {
            if (!empty($email['email'])) {
                $emails[] = $email['email'];
            }
        }
    }
    $handler->setReceiverEmails($emails);

    $thank_you_page = get_field('field_thank_you_page_link', 'option');
    $handler->setRedirect($thank_you_page);

    $handler->init();
});

function component_contact_form_regular($htmlAttributes = [], $props = [])
{
    render_component_template('contact-form-regular', 'source/components/elements/contact-form-regular/contact-form-regular.php', $htmlAttributes, $props);
}
```

Use when: component needs AJAX handlers, WP filters, action hooks, or global variable setup. Side-effects go in `add_action()` blocks outside the function. The `component_` function itself stays clean.

### Global Variable Setup

For components that need a precomputed value available across all instances:

```php
<?php

global $svg_icon_icons_url;
$svg_icon_icons_base_path = '/source/components/core/svg-icon/icons.svg';
$svg_icon_icons_url       = get_template_directory_uri() . $svg_icon_icons_base_path . '?v=' . filemtime(get_template_directory() . $svg_icon_icons_base_path);

function component_svg_icon($htmlAttributes = [], $props = [])
{
    if (!isset($props['icon_file_url'])) {
        global $svg_icon_icons_url;
        $props['icon_file_url'] = $svg_icon_icons_url;
    }

    render_component_template('svg-icon', 'source/components/core/svg-icon/svg-icon.php', $htmlAttributes, $props);
}
```

---

## Default Value Patterns

```php
// Null default — scalars only (string, int, bool): template uses if ($prop):
'title' => $props['title'] ?? null,

// Specific default
'title_tag' => $props['title_tag'] ?? 'h2',

// Boolean default
'show_cta' => $props['show_cta'] ?? true,

// Array default — ALWAYS [] for any prop used in array_map(), foreach(), or array functions
// ✅ Correct — array_map($fn, $styles) won't fatal when styles is empty
'styles' => $props['styles'] ?? [],
'items'  => $props['items']  ?? [],

// ❌ Wrong — null causes fatal: array_map(): Argument #2 must be of type array, null given
'styles' => $props['styles'] ?? null,

// Numeric default
'default_open_index' => $props['default_open_index'] ?? 0,

// Global fallback — prop overrides global, but empty string from ACF falls back to global
// ✅ (?? null) makes key access safe; ?: falls through on null/'' (ACF's empty return)
'title'      => ($props['title'] ?? null) ?: get_field('component_title', 'option') ?: null,
'head_title' => ($props['head_title'] ?? null) ?: $global_head['title'] ?? null,

// ❌ Wrong — ?? only catches null/undefined; '' from an unfilled ACF field passes through
'head_title' => $props['head_title'] ?? $global_head['title'] ?? null,

// ❌ Wrong — bare ?: on $props key triggers Undefined array key when $props = []
'title' => $props['title'] ?: get_field('component_title', 'option'),

// Global fallback for repeater arrays
// Note: get_field() returns false for empty repeaters — normalize with ?: [] at fetch time.
// Use ?: (not ??) so an empty [] from a cleared block field still falls back to global.
'items' => ($props['items'] ?? null) ?: $global_items,

// Global fallback for GROUP props passed as whole objects
// ACF groups ALWAYS return a non-empty associative array even when all sub-fields are blank:
// ['title' => '', 'text' => ''] is TRUTHY — ?: never triggers. Use array_filter instead:
$head_data = $props['head'] ?? [];
'head' => array_filter($head_data) ? $head_data : $global_head,

// ❌ Wrong — group arrays are truthy even when all sub-fields are ''; ?: never falls back
'head' => ($props['head'] ?? null) ?: $global_head,

// ❌ Wrong — isset is always true for [] or ['key' => '']; never falls back to global
'items' => isset($props['items']) ? $props['items'] : $global_items,
```

**Rule**: If the prop is typed `array`, `array|string`, or used with `array_map()`/`foreach()` anywhere in the template — default to `[]`, never `null`.

---

## Function Naming

- Hyphens become underscores: `faq-section` → `component_faq_section`
- Always prefixed with `component_`
- Signature is always `($htmlAttributes = [], $props = [])`
- Always ends with `render_component_template('component-name', 'source/components/.../name.php', $htmlAttributes, $props)`

## `render_component_template()` Signature

```php
render_component_template(string $componentName, string $componentTemplatePath, array $htmlAttributes = [], array $props = [])
```

- **`$componentName`** — kebab-case component name (filename without `.php`, no directory path). E.g. `'button'`, `'faq-section'`, `'general-services-item'`
- **`$componentTemplatePath`** — full theme-relative path to the `.php` template

```php
// ✅ Standard component
render_component_template('faq-section', 'source/components/sections/faq-section/faq-section.php', $htmlAttributes, $props);

// ✅ Child component — name is just the child filename, path includes parent folder
render_component_template('general-services-item', 'source/components/sections/general-services-section/general-services-item/general-services-item.php', $htmlAttributes, $props);
```

Directory structure:
```
source/components/{category}/
└── parent-section/
    ├── parent-section.includes.php
    ├── parent-section.php            ← 'source/components/{category}/parent-section/parent-section.php'
    ├── child-item/
    │   ├── child-item.includes.php   ← 'source/components/{category}/parent-section/child-item/child-item.php'
    │   ├── child-item.php
    │   └── child-item.scss
    └── child-card/
        ├── child-card.includes.php   ← 'source/components/{category}/parent-section/child-card/child-card.php'
        ├── child-card.php
        └── child-card.scss
```

---

## PHPDoc Contract

Always document all props the template will receive:

```php
/**
 * ComponentName
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $title      Title text
 *     @type string $title_tag  Heading tag (h2|h3)
 *     @type bool   $show_cta   Whether to show CTA
 *     @type array  $items      List items [{title, description}]
 *     @type int    $image      Image attachment ID
 *     @type string $slot       HTML content
 * }
 */
```

---

## Critical Rules

1. **Map ALL props** — every prop the template uses must appear in the `$props` array, even if just `?? null`
2. **Array props default to `[]`** — any prop typed `array` or used with `array_map()`/`foreach()` must use `?? []`, never `?? null` (null causes fatal: *Argument #2 must be of type array*)
3. **The `.includes.php` owns defaults** — the template should never need to set its own defaults
4. **Global fallback patterns** — choose based on the prop type:
   - **Scalar/repeater**: `($props['x'] ?? null) ?: $global` — `??` safe key access; `?:` catches `null`, `''`, `[]`
   - **Group as whole object**: `$d = $props['head'] ?? []; 'head' => array_filter($d) ? $d : $global` — groups return `['key' => '']` which is truthy; use `array_filter` to detect actual content
   - **Never use `isset`** for fallbacks — `isset([])` and `isset(['key' => ''])` are both `true`
5. **Fetch globals once** at the top of the function, not inline in the props array
6. **Data shaping only** — parsing, computing, restructuring raw data is fine. HTML generation is not: no `echo`, no closures that output markup. Pass raw data chunks; let the template build renderers.
7. **Side-effects go outside** the `component_` function in `add_action()` blocks
8. **Function name**: `component_{underscore_name}` — always matches the kebab-case component name
9. **Always call** `render_component_template('component-name', 'source/components/.../name.php', $htmlAttributes, $props)` as the last step — use the full theme-relative path
