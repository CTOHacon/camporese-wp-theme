---
name: component-ts-general
description: Create a TypeScript class for an interactive component. Use when a component needs client-side behavior like event handling, DOM manipulation, scroll tracking, or click-outside detection.
---

# Component TypeScript General Guidelines

Create a `.ts` file for a component in `source/components/{component-name}/` and register it in `source/scripts/asset.app.ts`.

## Two Base Classes

### Component (Reusable — multiple instances per page)

Use for: cards, accordions, sliders, list items — anything that appears multiple times.

```typescript
import Component from "~/library/scripts/Components/Component";

export default class ComponentName extends Component {
    static readonly componentName = "component-name";

    private button: HTMLButtonElement | null = null;
    private items: HTMLElement[] = [];

    public init(): void {
        this.button = this.el.querySelector('.component-name__button');
        this.items = Array.from(this.el.querySelectorAll('.component-name__item'));

        this.button?.addEventListener('click', () => this.handleClick());
    }

    private handleClick(): void {
        this.el.classList.toggle('_active');
    }
}
```

Register in `source/scripts/asset.app.ts`:
```typescript
import ComponentName from "~/components/component-name/component-name";

document.addEventListener('DOMContentLoaded', () => {
    ComponentName.initAll();
});
```

How it works: `initAll()` finds all `[data-component="component-name"]` elements and creates an instance for each.

### SingletonComponent (Unique — one per page)

Use for: header, footer, modals, sidebar — unique page elements.

```typescript
import SingletonComponent from "~/library/scripts/Components/SingletonComponent";

export default class Header extends SingletonComponent {
    static readonly componentName = "header";

    private menuButton: HTMLButtonElement | null = null;

    protected init(): void {
        this.menuButton = this.el.querySelector('.header__menu-button');

        this.menuButton?.addEventListener('click', () => this.toggleMenu());
    }

    private toggleMenu(): void {
        this.el.classList.toggle('_menu-open');
    }
}
```

Register in `source/scripts/asset.app.ts`:
```typescript
import Header from "~/components/header/header";

document.addEventListener('DOMContentLoaded', () => {
    Header.getInstance();
});
```

**Critical:** The HTML element MUST have `id` matching `componentName`:
```php
<header id="header" <?= $htmlAttributesString(['class' => 'header']) ?>>
```

How it works: `getInstance()` finds by `id`, creates once, caches, auto-calls `init()`.

## componentName Requirement

Always define explicitly — TypeScript will error if missing when calling `initAll()` or `getInstance()`:

```typescript
static readonly componentName = "component-name";
```

Must match:
- `data-component` attribute value (for reusable Component)
- Element `id` attribute (for SingletonComponent)

## Lifecycle

1. **Constructor** — stores `this.el` reference (handled by base class)
2. **`init()`** — query DOM elements, bind events, initialize behaviors, set up third-party libs

All setup happens in `init()`. The constructor only stores the element reference.

## Property Declaration

All properties can have default values — there are no restrictions:

```typescript
private button: HTMLButtonElement | null = null;
private items: HTMLElement[] = [];
private isOpen = false;
private clickCount = 0;

// Use ! assertion for properties initialized later in init()
private swiper!: Swiper;
```

## Common Patterns

### Scroll state toggle
```typescript
private handleScroll = () => {
    this.el.classList.toggle("_scrolled", window.scrollY > 0);
};

public init(): void {
    this.handleScroll();
    window.addEventListener("scroll", this.handleScroll, { passive: true });
}
```

### Click outside listener
```typescript
import { useOutsideClickListener } from "~/library/scripts/Composables/useOutsideClickListner";

public init(): void {
    useOutsideClickListener(this.el, () => this.close());
}
```

### Smooth scroll to element
```typescript
import { scrollToElement } from "~/library/scripts/Utils/scrollToElement";

scrollToElement(targetElement);
```

## Available Library Utilities

| Import | Description |
|--------|-------------|
| `~/library/scripts/Components/Component` | Reusable component base |
| `~/library/scripts/Components/SingletonComponent` | Singleton component base |
| `~/library/scripts/Animations/fadeEffect` | `fadeIn`, `fadeOut` |
| `~/library/scripts/Stores/AppModalsStore` | Modal registration & control |
| `~/library/scripts/Composables/useOutsideClickListner` | Outside click detection |
| `~/library/scripts/Composables/useOverflowGrabScroll` | Drag-to-scroll |
| `~/library/scripts/Utils/scrollToElement` | Smooth scroll |
| `~/library/scripts/Utils/getOffsetTop` | Element offset calculation |
| `~/library/scripts/Utils/applyLinkBehaviourOnNonLinkElement` | Click-to-navigate |
| `~/library/scripts/Utils/applySmoothScrollOnAnchorLinks` | Anchor smooth scroll |
| `~/library/scripts/Utils/camelToKebabCase` | String conversion |

## Critical Rules

1. Always define `componentName` explicitly as `static readonly`
2. Use `this.el` to reference the component root
3. All DOM queries and event binding happen in `init()`
4. Always register in `source/scripts/asset.app.ts` — TS files are NOT auto-loaded
5. Reusable: `ComponentName.initAll()` | Singleton: `ComponentName.getInstance()`
