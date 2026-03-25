---
name: component-modal
description: Create a modal/overlay component (dialog, popup, mega-menu, mobile menu, contact form modal). Use when building any overlay that opens/closes. Covers all 4 files (.includes.php, .php, .scss, .ts) with full accessibility.
---

# Modal Component Creation

Modals are **SingletonComponents** — one instance per page, found by `id`. They manage their own open/close state with `fadeIn`/`fadeOut` and include full accessibility (ARIA, focus trap, Escape key, focus restoration).

## Modal Types

| Type | Position | Backdrop | Close triggers | Example |
|------|----------|----------|---------------|---------|
| **Dialog** | Centered overlay | Backdrop + blur | Close button, backdrop click, Escape | contact-form-modal |
| **Dropdown/Mega-menu** | Below header | No backdrop (click outside closes) | Outside click, Escape | services-menu-modal |
| **Slide panel** | Fixed side/top | Optional | Toggle button, Escape | mobile-menu-modal |

---

## 1. `.includes.php`

```php
<?php
/**
 * MyModal
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type string $slot Modal content
 * }
 */
function component_my_modal($htmlAttributes = [], $props = [])
{
    $props = [
        'slot' => $props['slot'] ?? null,
    ];

    render_component_template('my-modal', 'source/components/singleton/my-modal/my-modal.php', $htmlAttributes, $props);
}
```

For modals that pull from global settings:

```php
function component_services_menu_modal($htmlAttributes = [], $props = [])
{
    $props = [
        'groups' => $props['groups'] ?? get_field('field_services_menu', 'option') ?? [],
    ];

    render_component_template('services-menu-modal', 'source/components/singleton/services-menu-modal/services-menu-modal.php', $htmlAttributes, $props);
}
```

---

## 2. `.php` Template

### Dialog modal (centered with backdrop)

```php
<?php /** ContactFormModal */ ?>

<div <?= $htmlAttributesString([
    'class'       => 'contact-form-modal',
    'id'          => 'contact-form-modal',
    'role'        => 'dialog',
    'aria-modal'  => 'true',
    'aria-label'  => 'Contact Form',
    'aria-hidden' => 'true',
]) ?>>
    <div class="contact-form-modal__backdrop"></div>

    <div class="contact-form-modal__content">
        <button class="contact-form-modal__close" type="button" aria-label="Close modal">
            <?= component_svg_icon(['class' => 'contact-form-modal__close-icon'], ['name' => 'close']) ?>
        </button>

        <?= component_contact_form_regular(['class' => 'contact-form-modal__form']) ?>
    </div>
</div>
```

### Dropdown/mega-menu modal (positioned below header)

```php
<?php /** ServicesMenuModal */ ?>

<div <?= $htmlAttributesString([
    'class'       => 'services-menu-modal',
    'id'          => 'services-menu-modal',
    'role'        => 'dialog',
    'aria-modal'  => 'true',
    'aria-label'  => 'Services Menu',
    'aria-hidden' => 'true',
]) ?>>
    <div class="services-menu-modal__inner-wrapper lib-container">
        <nav class="services-menu-modal__body" aria-label="Services menu">
            <!-- Tab controls and content panels -->
        </nav>
    </div>
</div>
```

### Slide panel modal (mobile menu)

```php
<?php /** MobileMenuModal */ ?>

<div <?= $htmlAttributesString([
    'class'       => 'mobile-menu-modal',
    'id'          => 'mobile-menu-modal',
    'role'        => 'dialog',
    'aria-modal'  => 'true',
    'aria-label'  => 'Mobile Menu',
    'aria-hidden' => 'true',
]) ?>>
    <nav class="mobile-menu-modal__body" aria-label="Mobile menu">
        <!-- Menu content -->
    </nav>
</div>
```

### Required ARIA attributes on root

Always include all of these:
```php
'role'        => 'dialog',
'aria-modal'  => 'true',
'aria-label'  => 'Descriptive Name',
'aria-hidden' => 'true',       // Toggled to 'false' by TS on open
```

### Required `id`

The root element MUST have `id` matching `componentName` — this is how `SingletonComponent.getInstance()` finds it:
```php
'id' => 'my-modal',
```

---

## 3. `.scss`

### Dialog modal

```scss
.contact-form-modal {
    position: fixed;
    inset: 0;
    z-index: 1100;
    display: none;
    align-items: center;
    justify-content: center;

    &._open {
        display: flex;
    }

    &__backdrop {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(0.25rem);
    }

    &__content {
        position: relative;
        width: 100%;
        max-width: 37.5rem;
        max-height: calc(100vh - 2rem);
        max-height: calc(100dvh - 2rem);
        overflow-y: auto;
        border-radius: var(--size-1);
        box-shadow: 0 1.5rem 3rem -0.5rem rgba(0, 0, 0, 0.24);
    }

    &__close {
        position: absolute;
        top: var(--size-1);
        right: var(--size-1);
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        background: rgba(0, 0, 0, 0.08);
        cursor: pointer;
        transition: background 0.2s ease;

        &:hover {
            background: rgba(0, 0, 0, 0.12);
        }
    }

    &__close-icon {
        width: 1.25rem;
        height: 1.25rem;
    }
}
```

### Dropdown/mega-menu modal

```scss
.services-menu-modal {
    position: fixed;
    inset: 0;
    top: calc(var(--header-area-height));
    z-index: 1000;
    display: none;

    &._open {
        display: flex;
    }

    &__body {
        background: #FFFFFF;
        box-shadow: 0rem 4rem 9rem -3.5rem rgba(0, 0, 0, 0.32);
        border-radius: 1rem;
    }
}
```

### Slide panel modal

```scss
.mobile-menu-modal {
    position: fixed;
    top: var(--header-area-height);
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 999;
    background: #fff;
    display: none;
    overflow-y: auto;

    &._open {
        display: block;
    }
}
```

Key: always `display: none` by default. `fadeIn` handles showing, `._open` class is added after fade completes for CSS state.

---

## 4. `.ts` — TypeScript

### Full dialog modal implementation

```typescript
import SingletonComponent from "~/library/scripts/Components/SingletonComponent";
import { fadeIn, fadeOut } from "~/library/scripts/Animations/fadeEffect";

export default class ContactFormModal extends SingletonComponent {
    static readonly componentName = "contact-form-modal";

    private closeButton: HTMLButtonElement | null = null;
    private backdrop: HTMLElement | null = null;
    private triggers: HTMLElement[] = [];
    private isOpen = false;
    private previouslyFocusedElement: HTMLElement | null = null;

    protected init(): void {
        this.closeButton = this.el.querySelector(".contact-form-modal__close");
        this.backdrop = this.el.querySelector(".contact-form-modal__backdrop");
        this.triggers = Array.from(
            document.querySelectorAll('a[href="#contact-modal"], [data-open-contact-modal]')
        );

        this.bindTriggers();
        this.bindCloseButton();
        this.bindBackdropClick();
        this.bindKeyboardEvents();
    }

    private bindTriggers(): void {
        this.triggers.forEach((trigger) => {
            trigger.addEventListener("click", (e) => {
                e.preventDefault();
                this.open();
            });
        });
    }

    private bindCloseButton(): void {
        this.closeButton?.addEventListener("click", () => this.close());
    }

    private bindBackdropClick(): void {
        this.backdrop?.addEventListener("click", () => this.close());
    }

    private bindKeyboardEvents(): void {
        document.addEventListener("keydown", (e) => {
            if (!this.isOpen) return;
            if (e.key === "Escape") this.close();
            if (e.key === "Tab") this.trapFocus(e);
        });
    }

    private trapFocus(e: KeyboardEvent): void {
        const focusableElements = this.el.querySelectorAll<HTMLElement>(
            'button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), a[href], [tabindex]:not([tabindex="-1"])'
        );
        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];

        if (e.shiftKey) {
            if (document.activeElement === firstElement) {
                e.preventDefault();
                lastElement.focus();
            }
        } else {
            if (document.activeElement === lastElement) {
                e.preventDefault();
                firstElement.focus();
            }
        }
    }

    public open(): void {
        if (this.isOpen) return;

        this.previouslyFocusedElement = document.activeElement as HTMLElement;
        this.isOpen = true;
        this.el.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden";

        fadeIn(this.el, {
            duration: 200,
            display: "flex",
            onEnd: () => {
                this.el.classList.add("_open");
                // Focus first interactive element
                const firstInput = this.el.querySelector<HTMLElement>(
                    "input:not([type='hidden']), button, a[href]"
                );
                firstInput?.focus();
            },
        });
    }

    public close(): void {
        if (!this.isOpen) return;

        this.isOpen = false;
        this.el.setAttribute("aria-hidden", "true");
        document.body.style.overflow = "";

        fadeOut(this.el, {
            duration: 200,
            onEnd: () => {
                this.el.classList.remove("_open");
                this.previouslyFocusedElement?.focus();
            },
        });
    }
}
```

### Dropdown/mega-menu modal (outside click instead of backdrop)

```typescript
import SingletonComponent from "~/library/scripts/Components/SingletonComponent";
import { fadeIn, fadeOut } from "~/library/scripts/Animations/fadeEffect";

export default class ServicesMenuModal extends SingletonComponent {
    static readonly componentName = "services-menu-modal";

    private triggers: HTMLElement[] = [];
    private isOpen = false;
    private previouslyFocusedElement: HTMLElement | null = null;

    protected init(): void {
        this.triggers = Array.from(
            document.querySelectorAll('a[href="#services-menu-modal"]')
        );

        this.bindTriggers();
        this.bindOutsideClick();
        this.bindKeyboardEvents();
    }

    private bindTriggers(): void {
        this.triggers.forEach(trigger => {
            trigger.addEventListener("click", (e) => {
                e.preventDefault();
                this.isOpen ? this.close() : this.open();
            });
        });
    }

    // Click directly on the modal wrapper (which covers the viewport) closes it
    private bindOutsideClick(): void {
        this.el.addEventListener("click", (e) => {
            if (e.target === this.el) this.close();
        });
    }

    private bindKeyboardEvents(): void {
        document.addEventListener("keydown", (e) => {
            if (!this.isOpen) return;
            if (e.key === "Escape") this.close();
            if (e.key === "Tab") this.trapFocus(e);
        });
    }

    private trapFocus(e: KeyboardEvent): void {
        const focusableElements = this.el.querySelectorAll<HTMLElement>(
            'button:not([disabled]), a[href], [tabindex]:not([tabindex="-1"])'
        );
        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];

        if (e.shiftKey) {
            if (document.activeElement === firstElement) {
                e.preventDefault();
                lastElement.focus();
            }
        } else {
            if (document.activeElement === lastElement) {
                e.preventDefault();
                firstElement.focus();
            }
        }
    }

    public open(): void {
        if (this.isOpen) return;

        this.previouslyFocusedElement = document.activeElement as HTMLElement;
        this.isOpen = true;
        this.el.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden";
        this.triggers.forEach(t => t.classList.add("_active"));

        fadeIn(this.el, {
            duration: 200,
            display: "flex",
            onEnd: () => {
                this.el.classList.add("_open");
            },
        });
    }

    public close(): void {
        if (!this.isOpen) return;

        this.isOpen = false;
        this.el.setAttribute("aria-hidden", "true");
        document.body.style.overflow = "";
        this.triggers.forEach(t => t.classList.remove("_active"));

        fadeOut(this.el, {
            duration: 200,
            onEnd: () => {
                this.el.classList.remove("_open");
                this.previouslyFocusedElement?.focus();
            },
        });
    }
}
```

### Slide panel / mobile menu (toggle button)

```typescript
import SingletonComponent from "~/library/scripts/Components/SingletonComponent";
import { fadeIn, fadeOut } from "~/library/scripts/Animations/fadeEffect";

export default class MobileMenuModal extends SingletonComponent {
    static readonly componentName = "mobile-menu-modal";

    private toggleButton: HTMLButtonElement | null = null;
    private isOpen = false;

    protected init(): void {
        this.toggleButton = document.querySelector("#mobile-menu-toggle-button");


        this.toggleButton?.addEventListener("click", () => {
            this.isOpen ? this.close() : this.open();
        });

        document.addEventListener("keydown", (e) => {
            if (this.isOpen && e.key === "Escape") this.close();
        });
    }

    public open(): void {
        if (this.isOpen) return;
        this.isOpen = true;
        this.el.setAttribute("aria-hidden", "false");
        this.toggleButton?.classList.add("_active");
        document.body.style.overflow = "hidden";
        fadeIn(this.el, {
            duration: 200,
            display: "block",
            onEnd: () => this.el.classList.add("_open"),
        });
    }

    public close(): void {
        if (!this.isOpen) return;
        this.isOpen = false;
        this.el.setAttribute("aria-hidden", "true");
        this.toggleButton?.classList.remove("_active");
        document.body.style.overflow = "";
        fadeOut(this.el, {
            duration: 200,
            onEnd: () => this.el.classList.remove("_open"),
        });
    }
}
```

---

## Trigger Patterns

Modals can be opened from anywhere. Common patterns:

### Anchor-based triggers (collected by the modal itself)

```typescript
// In modal's init():
this.triggers = Array.from(document.querySelectorAll('a[href="#contact-modal"]'));

this.triggers.forEach(trigger => {
    trigger.addEventListener("click", (e) => {
        e.preventDefault();
        this.open();
    });
});
```

```html
<!-- Any component can trigger by href -->
<a href="#contact-modal">Contact Us</a>
```

### Data attribute triggers

```typescript
this.triggers = Array.from(document.querySelectorAll('[data-open-contact-modal]'));
```

### External toggle button (by ID)

```typescript
this.toggleButton = document.querySelector("#mobile-menu-toggle-button");
```

### From another component via public method

```typescript
// In header.ts:
import MobileMenuModal from "~/components/mobile-menu-modal/mobile-menu-modal";

MobileMenuModal.getInstance().open();
```

---

## Registration in `asset.app.ts`

```typescript
import ContactFormModal from "~/components/contact-form-modal/contact-form-modal";
import ServicesMenuModal from "~/components/services-menu-modal/services-menu-modal";
import MobileMenuModal from "~/components/mobile-menu-modal/mobile-menu-modal";

document.addEventListener("DOMContentLoaded", () => {
    ContactFormModal.getInstance();
    ServicesMenuModal.getInstance();
    MobileMenuModal.getInstance();
});
```

---

## Accessibility Checklist

Every modal MUST implement:

1. `role="dialog"` and `aria-modal="true"` on root element
2. `aria-label` describing the modal purpose
3. `aria-hidden="true"` toggled to `"false"` on open
4. **Escape key** closes the modal
5. **Focus trap** — Tab cycles within the modal, not to page behind
6. **Focus restoration** — save `document.activeElement` before open, restore on close
7. **Body scroll lock** — `document.body.style.overflow = "hidden"` on open, `""` on close
8. **Initial focus** — focus first interactive element after open animation completes

---

## fadeIn / fadeOut API

```typescript
import { fadeIn, fadeOut } from "~/library/scripts/Animations/fadeEffect";

fadeIn(element, {
    duration: 200,        // ms
    display: "flex",      // CSS display value, default "block"
    onEnd: () => {},      // After animation completes
});

fadeOut(element, {
    duration: 200,
    onEnd: () => {},      // After element is set to display: none
});
```

---

## Critical Rules

1. Modals are always **SingletonComponent** — one instance, found by `id`
2. Root element MUST have `id` matching `componentName`
3. Default `display: none` in CSS — `fadeIn` handles showing
4. `._open` class is added AFTER fade completes (in `onEnd`), removed AFTER fadeOut completes
5. Always lock body scroll on open, unlock on close
6. Always implement Escape key close
7. Dialog modals must trap focus and restore focus on close
8. Triggers can be anchor-based (`href="#modal-id"`), data-attribute-based, or button-based
9. Triggers toggle `._active` class on themselves when modal state changes
10. All DOM queries and event binding happen in `init()` — properties can have default values
