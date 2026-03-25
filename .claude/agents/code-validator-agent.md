# Code Validator Agent

## Purpose
Post-completion audit agent that validates a component's HTML output for W3C compliance, SEO best practices, and WCAG accessibility. Run after finishing a component to catch issues before shipping.

## Agent Config
```
subagent_type: Explore
description: "Validate component code for W3C, SEO, and accessibility compliance"
```

## Prompt Template
```
Audit the component "{COMPONENT_NAME}" for W3C validity, SEO, and accessibility.

Read ALL of these files for the component (skip any that don't exist):
- source/components/**/{COMPONENT_NAME}/{COMPONENT_NAME}.php
- source/components/**/{COMPONENT_NAME}/{COMPONENT_NAME}.includes.php
- source/components/**/{COMPONENT_NAME}/{COMPONENT_NAME}.scss
- source/components/**/{COMPONENT_NAME}/{COMPONENT_NAME}.ts

Also read any child component .php templates referenced inside the main template.

Then produce a report covering the three sections below.
For each issue found, state the file, line, the problem, and the fix.
If a section has no issues, state "No issues found."

---

### 1. W3C HTML Validity
Check the .php template(s) for:
- Nesting violations (e.g. <div> inside <p>, <p> inside <span>, block elements inside inline elements)
- Duplicate or missing `id` attributes
- Unclosed or self-closing tag misuse (e.g. `<div />`)
- Deprecated HTML elements or attributes (`<center>`, `<font>`, `align=`, `bgcolor=`)
- Invalid attribute values (e.g. `role` values that don't exist)
- Missing required attributes (`<img>` without `alt`, `<a>` without `href`, `<html>` without `lang`)
- Multiple `<main>`, `<h1>` per page (flag if component outputs `<h1>` — it may conflict with the page hero)
- Malformed HTML entities

### 2. SEO
Check for:
- Heading hierarchy — component should not skip heading levels (e.g. h2 then h4); flag if heading tag is hardcoded when it should be configurable via ACF
- Links without descriptive text (e.g. "click here", "read more" without `aria-label`)
- Missing structured data opportunities (FAQ sections should note Schema.org FAQ markup)
- Empty `<h*>` tags or headings populated only with whitespace
- `<a>` tags with `target="_blank"` missing `rel="noopener"`
- Excessive DOM nesting that could hurt performance (more than 8 levels deep)

### 3. Accessibility (WCAG 2.1 AA)
Check for:
- Interactive elements missing focus styles (buttons, links, inputs in .scss)
- Missing or incorrect ARIA attributes:
  - Toggles/accordions: `aria-expanded`, `aria-controls`, matching `id`
  - Modals: `role="dialog"`, `aria-modal="true"`, `aria-labelledby`
  - Live regions: `aria-live` for dynamic content
- Missing `<label>` or `aria-label` on form inputs
- Insufficient color contrast hints (flag hardcoded colors in SCSS that appear to be light-on-light or dark-on-dark)
- Keyboard navigation gaps:
  - Click handlers in .ts without corresponding keydown (Enter/Space) handlers
  - `tabindex` misuse (positive values, missing on custom interactive elements)
  - Focus trap for modals
- Missing skip-link targets or landmark roles
- Decorative images not marked with `alt=""` or `aria-hidden="true"`
- Text embedded in images without text alternative
- Motion/animation without `prefers-reduced-motion` media query in SCSS

---

Format the output as:

## Validation Report: {COMPONENT_NAME}

### W3C HTML
(issues or "No issues found.")

### SEO
(issues or "No issues found.")

### Accessibility
(issues or "No issues found.")

### Summary
- Total issues: X (W3C: N, SEO: N, A11y: N)
- Severity breakdown: X critical, X warning, X info
```

## When to Use
- After finishing all files for a new component
- After significant edits to an existing component's template or logic
- When the user explicitly asks for a code audit / validation
- Before committing a component to ensure quality

## Severity Levels
- **Critical** — Will cause validation errors, broken accessibility, or SEO penalties (e.g. missing alt, nesting violation, no focus management on modal)
- **Warning** — Best practice violation that may impact UX or rankings (e.g. hardcoded heading tag, missing `rel="noopener"`)
- **Info** — Suggestion for improvement, not a violation (e.g. could add Schema.org markup, consider `prefers-reduced-motion`)
