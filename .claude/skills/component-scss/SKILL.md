---
name: component-scss
description: Create or modify SCSS styles for a component following theme conventions. Use when building component styles, adding responsive behavior, or styling BEM elements.
---

# Component SCSS Guidelines

Create the `.scss` file for a component in `source/components/{component-name}/`.

SCSS files are auto-imported via glob in `source/styles/asset.app.scss` — no manual import needed.

## File Structure

File: `source/components/{component-name}/{component-name}.scss`

```scss
.component-name {
    // Root styles

    &._modifier {
        // Modifier variant
    }

    &__element {
        // BEM element
    }

    &__element-child {
        // Nested BEM element (CORRECT: flat, not nested under &__element)
    }
}
```

## BEM Naming

```scss
.component-name {           // Block
    &__element { }           // Element
    &__element-child { }     // Child element (flat, NOT nested &__child inside &__element)
    &._modifier { }          // Modifier (underscore prefix)
    &._active { }            // State modifier
}
```

### Figma Element Names → BEM Classes

When Figma uses BEM-like `data-name` values (e.g., `__item-label`, `__value`, `our-advantages`), use those exact names as your BEM element/block classes. Only ignore names that are raw HTML tags (`div`, `span`, `p`, `ul`, etc.).

```scss
// Figma: data-name="__value"  → &__value { }
// Figma: data-name="__item"   → &__item { }
// Figma: data-name="div"      → ignore, choose semantic name yourself
```

NEVER nest BEM elements:
```scss
// WRONG
&__element {
    &__child { }  // This creates .component-name__element__child
}

// CORRECT
&__element { }
&__element-child { }  // This creates .component-name__element-child
```

## Units

**REMs only** — never `px` for sizing, spacing, typography, or border-radius.
**Size Variables** — use `var(--size-x)` directly from the spec as-is. Never explore SCSS files to look up available sizes — if the spec says `var(--size-1)`, use it exactly, if spec says 1rem - use 1rem. All size variables are defined in `config/sizes.json` and auto-generated into SCSS.

## State Modifiers

Use underscore prefix for all state/modifier classes:

```scss
&._active { }
&._open { }
&._disabled { }
&._loading { }
&._scrolled { }
&._left-image { }
&._dark-theme { }
...
```

## CSS Variables

**Only use variables that actually exist.** Allowed categories:

1. `--size-*` vars (from `config/sizes.json`, auto-generated)
2. Global vars declared in `source/styles/_css-vars.scss` (e.g. `--main-font-family`, `--main-color`, `--total-white`, `--total-black`, `--regular-border-radius`, `--regular-gap`)
3. Local component vars you define yourself (e.g. `--default-font-size`)
4. Component-level CSS API vars with `--c-` prefix

**Never invent global vars** like `--font-heading`, `--color-dark`, `--primary-color`, etc. If a color or font isn't in `_css-vars.scss`, use the literal value directly.

```scss
// ✅ CORRECT
color: #001020;
font-family: 'Poltawski Nowy', serif;
background: var(--total-white);
font-size: var(--size-1-25);

// ❌ WRONG — these vars don't exist
color: var(--color-dark);
font-family: var(--font-heading);
background: var(--color-grey-light);
```

### Component parametrization (only when prompted)

```scss
/**
Exposed properties:
--c-font-size
--c-color
**/
.component-name {
    --default-font-size: 1rem;
    --default-color: var(--main-color);

    font-size: var(--c-font-size, var(--default-font-size));
    color: var(--c-color, var(--default-color));
}

// In parent component:
.parent-component &__component-name {
    --c-color: red;
}
```


## Responsive Design

Use theme breakpoint mixins. Available breakpoints: `medium-desktop`, `tablet`, `mobile`.
*The px values of breakpoins are defined in source/styles/_library-provider.scss*

**Always nest `@include smaller-than` inside the selector it modifies — never collect all queries at the end of the file.**

```scss
// ✅ CORRECT — queries live inside the element they affect
.component-name {
    padding: 5rem 8rem;

    @include smaller-than('tablet') {
        padding: 4rem 3rem;
    }

    @include smaller-than('mobile') {
        flex-direction: column;
        padding: 2rem 1.5rem;
    }

    &__title {
        font-size: var(--size-2-25);

        @include smaller-than('tablet') {
            br { display: none; }
        }
    }

    &__image {
        width: 29rem;

        @include smaller-than('mobile') {
            width: 100%;
        }
    }
}

// ❌ WRONG — queries grouped at the bottom, detached from their elements
.component-name {
    padding: 5rem 8rem;

    &__title { font-size: var(--size-2-25); }
    &__image { width: 29rem; }
}
@include smaller-than('tablet') {
    .component-name { padding: 4rem 3rem; }
    .component-name__title br { display: none; }
}
@include smaller-than('mobile') {
    .component-name { flex-direction: column; }
    .component-name__image { width: 100%; }
}
```

For desktop-only styles:
```scss
@include larger-than('mobile') {
}
```

## Modifier Affecting Children

```scss
.component-name {
    &._right-image {
        .component-name__main {
            padding-right: 3rem;
        }
    }

    &._left-image {
        .component-name__image-container {
            @include larger-than('mobile') {
                order: -1;
            }
        }
    }

    &._no-image {
        .component-name__image-container {
            display: none;
        }
    }
}
```

## Common Patterns

### Image cover
```scss
&__image {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}
```

### Transition
```scss
transition: all 0.3s ease-in-out;
```

## Scaffolding Rule

When creating a new component SCSS file, generate empty selectors for ALL BEM elements from the pseudo-code spec:

```scss
.component-name {
    &._modifier { }
    &__title { }
    &__content { }
    &__image { }
    &__link { }
}
```

Fill in styles as needed. Empty selectors serve as a structural map.