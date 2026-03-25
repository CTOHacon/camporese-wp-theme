---
name: component-ts-slider
description: Create a Swiper slider/carousel component. Use when a component needs a slider, carousel, or any swipeable content. Swiper 10.x is pre-installed.
---

# Slider Component with Swiper

Swiper 10.x is pre-installed in `source/package.json`. Use it for all slider/carousel functionality.

## TypeScript File

File: `source/components/{component-name}/{component-name}.ts`

```typescript
import Component from "~/library/scripts/Components/Component";
import Swiper from "swiper";
import { Navigation, Pagination, Autoplay } from "swiper/modules";

export default class ComponentName extends Component {
    static readonly componentName = "component-name";

    private swiper!: Swiper;

    public init(): void {
        const swiperEl = this.el.querySelector<HTMLElement>(".swiper");
        if (!swiperEl) return;

        this.swiper = new Swiper(swiperEl, {
            modules: [Navigation, Pagination],
            slidesPerView: 1,
            spaceBetween: 16, // in px (Swiper uses px internally)
            navigation: {
                nextEl: this.el.querySelector(".component-name__next"),
                prevEl: this.el.querySelector(".component-name__prev"),
            },
            pagination: {
                el: this.el.querySelector(".component-name__pagination"),
                clickable: true,
            },
        });
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

## PHP Template Structure

The Swiper HTML structure must follow this exact pattern:

```php
<?php /** ComponentName */ ?>

<section <?= $htmlAttributesString(['class' => 'component-name']) ?>>
    <div class="swiper">
        <div class="swiper-wrapper">
            <?php if (!empty($items) && is_array($items)): ?>
                <?php foreach ($items as $item): ?>
                    <div class="swiper-slide">
                        <!-- Slide content -->
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Navigation (outside .swiper) -->
    <button class="component-name__prev" aria-label="Previous slide">
        <?= component_svg_icon(['class' => 'component-name__nav-icon'], ['name' => 'icon-arrow-left']) ?>
    </button>
    <button class="component-name__next" aria-label="Next slide">
        <?= component_svg_icon(['class' => 'component-name__nav-icon'], ['name' => 'icon-arrow-right']) ?>
    </button>

    <!-- Pagination -->
    <div class="component-name__pagination"></div>
</section>
```

**Critical HTML rules:**
- `.swiper` wrapper is required
- `.swiper-wrapper` contains all slides
- `.swiper-slide` wraps each slide
- Navigation/pagination elements should be OUTSIDE `.swiper` but inside the component root

## Interactive Content Inside Slides

When slides contain interactive inner components (e.g. drag handles, range sliders, before/after comparisons), Swiper's touch handling conflicts with the inner component's pointer events. Use the `data-no-swipe` attribute convention:

```typescript
// In slider config — exclude marked elements from Swiper's touch handling
this.swiper = new Swiper(swiperEl, {
    noSwiping: true,
    noSwipingSelector: '[data-no-swipe]',
    // ...
});
```

Inner components add the attribute to their interactive elements:
```php
<!-- In the inner component's .php template -->
<div class="inner-component__handle" data-no-swipe>
```

`BasicSlider` exports `NO_SWIPE_ATTR` as the standard attribute name for programmatic use.

## SCSS Structure

```scss
.component-name {
    position: relative;

    .swiper {
        overflow: hidden;
    }

    &__prev,
    &__next {
        // Position navigation buttons
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 2;
        cursor: pointer;
        background: none;
        border: none;
    }

    &__prev {
        left: -2rem;
    }

    &__next {
        right: -2rem;
    }

    &__nav-icon {
        width: 1.5rem;
        height: 1.5rem;
    }

    &__pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 1.5rem;
    }
}
```

## Common Swiper Configurations

### Responsive slidesPerView

```typescript
this.swiper = new Swiper(swiperEl, {
    modules: [Navigation, Pagination],
    slidesPerView: 1,
    spaceBetween: 16,
    breakpoints: {
        640: {  // mobile breakpoint
            slidesPerView: 2,
            spaceBetween: 20,
        },
        1180: { // tablet breakpoint
            slidesPerView: 3,
            spaceBetween: 24,
        },
    },
    navigation: {
        nextEl: this.el.querySelector(".component-name__next"),
        prevEl: this.el.querySelector(".component-name__prev"),
    },
});
```

### Autoplay

```typescript
import { Navigation, Pagination, Autoplay } from "swiper/modules";

this.swiper = new Swiper(swiperEl, {
    modules: [Navigation, Pagination, Autoplay],
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    // ...
});
```

### Loop mode

```typescript
this.swiper = new Swiper(swiperEl, {
    modules: [Navigation],
    loop: true,
    slidesPerView: 1,
    // ...
});
```

### Free mode (for horizontal scrolling)

```typescript
import { FreeMode } from "swiper/modules";

this.swiper = new Swiper(swiperEl, {
    modules: [FreeMode],
    freeMode: true,
    slidesPerView: "auto",
    spaceBetween: 16,
});
```

## Available Swiper Modules

Import only what you need from `"swiper/modules"`:

- `Navigation` — prev/next buttons
- `Pagination` — dots/bullets
- `Autoplay` — auto-advance slides
- `FreeMode` — free scrolling
- `EffectFade` — fade transition
- `Thumbs` — thumbnail navigation
- `Grid` — multi-row layout
- `Scrollbar` — scrollbar control

## Critical Rules

1. **Never import `swiper/css`** in TS, and **no `@use` import needed in SCSS** — Swiper base styles are preconnected globally
2. Always import Swiper modules individually — never import the full bundle
3. Navigation/pagination elements must be queried from `this.el` (component scope), not document-wide
4. Use `this.el.querySelector()` for all Swiper element references
5. Swiper uses `px` for `spaceBetween` internally — this is the one exception to the REMs rule
6. Breakpoint values in Swiper config use `px` and should match theme breakpoints: `640` (mobile), `1180` (tablet), `1680` (medium-desktop)
7. Always use `!` assertion for the swiper property: `private swiper!: Swiper`
8. Register with `ComponentName.initAll()` in `asset.app.ts` (sliders are typically reusable)
9. If slides may contain interactive components, add `noSwiping: true` + `noSwipingSelector: '[data-no-swipe]'`
