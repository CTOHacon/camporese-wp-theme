---
name: component-php-template
description: Create a component's .php template file — the display/presentation layer that renders HTML from props. Use when building the visual output of a component. For the data logic layer (.includes.php), use the component-php-includes skill instead.
---

# Component `.php` Template — Display Layer

The `.php` template is the **presentation layer**. It receives props (prepared by `.includes.php`) and renders HTML. It should contain NO data fetching, NO `get_field()` calls, NO heavy logic — only display conditionals and loops.

Props are auto-extracted via `extract()` — every key in the `$props` array from `.includes.php` becomes a direct variable (e.g., `$title`, `$items`, `$slot`).

## File Location

`source/components/{component-name}/{component-name}.php`

**Child components**: `source/components/{parent-name}/{child-name}/{child-name}.php`

## Input

The user provides either:
- A pseudo-code spec describing the component structure
- A description of what the component should render
- A design reference or screenshot

Before writing the template, always check the corresponding `.includes.php` to know what props are available. If it doesn't exist yet, use the `/component-php-includes` skill first.

## Pseudo-code Interpretation

```
component-name (modifier: _light|_dark)  → prop with values → class modifier on root
    __element                             → BEM element → <div> unless semantic type applies
        __element-child                   → nested BEM element (component-name__element-child)
    component_nested(prop1).__nested      → nested component call
    __title                               → always <h3> (default heading level)
    __title (tag: h2|h3)                  → explicit heading level override
    __text / __description / __body       → <p>
    __items
        __item[]                          → array prop
    <slot>                                → HTML content prop ($slot)
```

**`__title` is always a heading — never a `<div>`.** When the spec says `__title` with no tag annotation, use `<h3>`. Only use a different level when `(tag: h2|h3)` is explicitly specified.

Extract ONLY explicitly present elements. Never invent HTML not in the spec.

**Figma element names as BEM classes**: When Figma `data-name` uses BEM-like names (`__value`, `__item-label`), use those exact names as CSS classes. Ignore names that are raw HTML tags (`div`, `p`, `ul`). See `component-scss` skill for details.

## Semantic & Accessible HTML — Default Approach

Templates must produce clean, semantic, accessible markup from the start. Choose elements by meaning, not by styling convenience. Always include appropriate ARIA attributes where the UI pattern calls for them (e.g., `role="tablist/tab/tabpanel"`, `aria-selected`, `aria-expanded`, `aria-controls`, `aria-labelledby`, `aria-label` on `<nav>`).

| Content type | Element | Notes |
|---|---|---|
| Page/content section | `<section>` | Default root for page-level components |
| Self-contained content unit | `<article>` | Cards with title + body + optional image |
| Navigation region | `<nav aria-label="...">` | Any group of navigation links |
| Link list inside nav | `<ul>/<li>` | Never use `<div>` for a list of links |
| Text content | `<p>` | All body/description text — never `<div>` |
| Card title | `<h3>` (or correct level) | Maintain document heading hierarchy |
| Aside/supplemental | `<aside>` | Sidebar, marketing bars |
| Generic container | `<div>` | Only when no semantic element applies |

```php
// ✅ Navigation with link list — ul/li, h-tags, p
<nav class="services-nav__body" aria-label="Services menu">
    <ul class="services-nav__cards">
        <li>
            <article class="services-nav__card">
                <h3 class="services-nav__card-title"><a href="...">Service Name</a></h3>
                <p class="services-nav__card-text">Description text.</p>
            </article>
        </li>
    </ul>
</nav>

// ❌ Generic divs with no semantic value
<div class="services-nav__body">
    <div class="services-nav__cards">
        <div class="services-nav__card">
            <div class="services-nav__card-title"><a href="...">Service Name</a></div>
            <div class="services-nav__card-text">Description text.</div>
        </div>
    </div>
</div>
```

When using `<ul>/<li>` as a CSS grid container, add `list-style: none; padding: 0;` on the `<ul>` and `display: contents` on `<li>` so the card components become direct grid items.

## Basic Template

```php
<?php /** ComponentName */ ?>

<section <?= $htmlAttributesString(['class' => 'component-name']) ?>>
    <?php if ($title): ?>
        <<?= $title_tag ?> class="component-name__title"><?= $title ?></<?= $title_tag ?>>
    <?php endif; ?>

    <?php if ($slot): ?>
        <div class="component-name__content"><?= $slot ?></div>
    <?php endif; ?>
</section>
```

## Root Element

Uses `$htmlAttributesString()` — auto-injected by the system, never define it yourself:

```php
<div <?= $htmlAttributesString(['class' => 'component-name']) ?>>
```

With conditional modifiers:

```php
<div <?= $htmlAttributesString([
    'class' => ['component-name', $color_theme, '_active' => $is_active]
]) ?>>
```

- `data-component` is auto-added — never add it manually
- Class arrays merge with whatever was passed via `$htmlAttributes` from the caller

## Inner Elements

Use `assembleHtmlAttributes()` for any inner element with dynamic attributes:

```php
<a <?= assembleHtmlAttributes([
    'class'  => 'component-name__link',
    'href'   => $link_url,
    'target' => $link_target,
]) ?>>
    <?= $link_title ?>
</a>
```

Link fields come from ACF's native `'type' => 'link'` and are flattened in `.includes.php` or ACF callback to `$link_url`, `$link_title`, `$link_target`.

For static inner elements, plain HTML classes are fine:

```php
<div class="component-name__body">
```

## How `$htmlAttributesString` / `assembleHtmlAttributes` Work

**`$htmlAttributesString()`** — auto-injected closure. Use **once**, on the **root element only**. It merges the caller's `$htmlAttributes` (third argument of `render_component_template()`) with what you pass, so external classes, styles, and data attributes carry through.

**`assembleHtmlAttributes()`** — universal utility. Use on **any inner element** that needs dynamic attributes. No merging — just converts an array to an attribute string.

Both produce attribute strings with the same rules:

- **`class`** is special: arrays are merged and joined with spaces. Supports conditional syntax `['_active' => $bool]`.
- **All other attributes** (`style`, `data-*`, `aria-*`, `id`, etc.) are passed through as-is. Pass them as **strings**.
- `null`, `false`, and `''` values are **skipped** (attribute not rendered).
- `true` renders a boolean attribute (e.g., `disabled`).
- Values are auto-escaped with `esc_attr()`.

```php
// ✅ Inline styles — use double-quoted string interpolation
<div <?= $htmlAttributesString([
    'class' => 'wrapper',
    'style' => "background-color: {$color}; padding-top: var(--size-{$size})",
]) ?>>

// ✅ Conditional style — use ternary to pass string or null
<div <?= $htmlAttributesString([
    'class' => 'wrapper',
    'style' => $color ? "background-color: {$color}" : null,
]) ?>>

// ✅ Multiple conditional style parts — build in a variable first
<?php
$styles = implode('; ', array_filter([
    $color ? "background-color: {$color}" : null,
    $padding_top ? "padding-top: var(--size-{$padding_top})" : null,
]));
?>
<div <?= $htmlAttributesString([
    'class' => 'wrapper',
    'style' => $styles ?: null,
]) ?>>
```

## Display Patterns

### Conditional rendering

```php
<?php if ($title): ?>
    <h2 class="component-name__title"><?= $title ?></h2>
<?php endif; ?>
```

### Dynamic HTML tags

```php
<<?= $title_tag ?> class="component-name__title"><?= $title ?></<?= $title_tag ?>>
```

The default value for `$title_tag` is set in `.includes.php` — template trusts it.

### Boolean visibility

```php
<?php if ($show_head): ?>
    <div class="component-name__head">
        <!-- head content -->
    </div>
<?php endif; ?>
```

### Array iteration

Use `<ul>/<li>` when items are a list of links or cards. Use `<div>` only for non-list content (e.g. a grid of visual blocks with no list semantics).

```php
<?php if (!empty($items) && is_array($items)): ?>
    <ul class="component-name__list">
        <?php foreach ($items as $item): ?>
            <li class="component-name__item">
                <?php if (!empty($item['title'])): ?>
                    <h3 class="component-name__item-title"><?= $item['title'] ?></h3>
                <?php endif; ?>
                <?php if (!empty($item['text'])): ?>
                    <p class="component-name__item-text"><?= $item['text'] ?></p>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
```

### Nested components

Always use component functions — never raw `<img>`, never duplicate component logic:

```php
<?= component_image(['class' => 'hero__bg'], ['reference' => $image, 'lazy' => false, 'size' => 'full']) ?>
<?= component_button(['class' => 'hero__cta', 'href' => $link_url], ['type' => 'solid accent rounded', 'slot' => $link_title]) ?>
<?= component_svg_icon(['class' => 'card__icon'], ['name' => 'icon-arrow']) ?>
<?= component_typography_wrapper(['class' => 'section__content'], ['slot' => $content]) ?>
```

### Image Component Usage

**CRITICAL**: Always use `component_image()` for rendering images. NEVER use `wp_get_attachment_image()` or raw `<img>` tags — this includes decorative/background images. If the spec shows `component_image`, the image must be an ACF image field (add it to `.acf.fields.php` and `.includes.php` if missing).

**Props:**
- `reference` (int|string|object) — Image attachment ID or image object (required)
- `size` (string) — WordPress image size ('thumbnail', 'medium', 'large', 'full', or custom) — defaults to 'full'
- `lazy` (bool) — defaults to `true`. **Only set `false` when the spec/mock explicitly states it** (e.g., a hero image marked "eager" or "no lazy"). Never add it as an assumption.

**Examples:**

```php
// ✅ Basic usage — omit lazy, omit size unless spec specifies them
<?php component_image(['class' => 'card__image'], ['reference' => $image_id]); ?>

// ✅ Only set lazy/size when explicitly in the spec
<?php component_image(['class' => 'hero__image'], ['reference' => $image_id, 'size' => 'full']); ?>

// ✅ Override alt text via htmlAttributes
<?php component_image(['class' => 'logo', 'alt' => 'Company Logo'], ['reference' => $logo_id]); ?>
```

### Slot content (InnerBlocks / HTML content)

```php
<?php if ($slot): ?>
    <div class="component-name__content"><?= $slot ?></div>
<?php endif; ?>
```

No escaping — props may contain HTML.

## Escaping Rules

**Default: no escaping.** Props may contain HTML (`<br>`, `<a>`, etc.) — output them raw with `<?= $var ?>`.

**Only escape** when placing a variable inside a raw HTML attribute with `""`:

```php
<!-- ✅ Raw attribute value — MUST escape -->
<a href="<?= esc_url($url) ?>" title="<?= esc_attr($title) ?>">

<!-- ✅ assembleHtmlAttributes handles escaping automatically — no manual escaping -->
<a <?= assembleHtmlAttributes(['href' => $url, 'title' => $title]) ?>>

<!-- ✅ Text/HTML content — never escape -->
<?= $title ?>
<?= $slot ?>
```

Never use `esc_html()` — it strips HTML that props intentionally contain.

## Critical Rules

1. **Semantic + accessible by default** — use proper HTML elements and ARIA attributes from the start (tabs, accordions, nav, etc.)
2. **No data fetching** — never call `get_field()`, `get_option()`, or query the database. That belongs in `.includes.php`
3. **No default values** — trust that `.includes.php` already set them. Use props directly
4. **Root element** uses `$htmlAttributesString()`, inner elements use `assembleHtmlAttributes()` or plain classes
5. `data-component` is auto-added — never add manually
6. **Wrap ALL variables** in conditionals — `<?php if ($var): ?>`
7. **No escaping** on content output — only `esc_attr()`/`esc_url()` inside raw `""` attributes
8. Use `component_image` from `source/components/core/image/image.includes.php` and `component_svg_icon` from `source/components/core/svg-icon/svg-icon.includes.php` for images and icons
9. Arrays check: `<?php if (!empty($items) && is_array($items)): ?>`
10. Template is display-only — if you need to compute, transform, or fetch, that goes in `.includes.php`
11. **`__title` is always a heading** — use `<h3>` by default, never `<div>`. Only deviate when `(tag:)` is explicitly specified in the spec.
