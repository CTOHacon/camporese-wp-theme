# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Build Commands

### Frontend (Vite) — run from `source/`
```bash
npm run dev          # Build with watch mode
npm run build        # Production build
npm run create-component  # Interactive component scaffold generator
```

### Gutenberg Blocks — run from `gutenberg/`
```bash
npm run start        # Dev with watch
npm run build        # Production build
```

### PHP Dependencies — run from theme root
```bash
composer install
```

### Deployment — run from `.deployment/`
Uses Bun runtime with SSH/SFTP sync. Config in `.deployment/config.json` (git-ignored).

## Architecture

### HACON Theme Core Framework
This theme is built on `hacon/theme-core` (Composer package). It provides the component system, asset loading, form handling, and other core infrastructure. **ACF Pro is a hard requirement** — the theme will not function without it.

### Component System
Components live in `source/components/{name}/` with these files:
- `{name}.php` — Template (props are auto-extracted via `extract()`)
- `{name}.includes.php` — Wrapper function `component_{name}()` (auto-loaded)
- `{name}.scss` — Styles (auto-imported via glob)
- `{name}.acf.php` — ACF block registration (auto-loaded)
- `{name}.ts` — TypeScript behavior (optional)
- `{name}.wp-admin.scss` — Editor-only styles (optional)

**Key rendering mechanics:**
- `render_component_template($componentName, $templatePath, $htmlAttributes, $props)` renders a component — `$componentName` is the kebab-case name, `$templatePath` is the theme-relative path to the `.php` template (e.g. `source/components/button/button.php`)
- `$htmlAttributesString` closure is auto-injected — use on root element only
- `assembleHtmlAttributes()` — use for inner elements
- `data-component` attribute is auto-added, never add manually
- ACF group fields flatten in callbacks: `$fields['link']['url']` → `$fields['link_url']`
- ACF images must use `'return_format' => 'id'`

### Build Output
Vite outputs to `source/build/` with hashed filenames. assets are enqueued via glob patterns in `config/assets.php`.

### Key Directories
- `config/` — PHP configuration (assets, ACF sources, color themes, recaptcha, etc.)
- `includes/` — Theme support, fonts, post types, ACF field helpers
- `acf/` — ACF field definitions (post-meta, term-meta, theme-options)
- `source/library/` — Shared SCSS mixins, TS utilities, component base classes, dev tools

## Developer Documentation
Detailed instructions and patterns are in `.github/instructions/`:
- Component Patterns, Component Workflow, SCSS Styling, TypeScript Components, Theme Options, System Architecture

## Skills
When you are asked to create component - instantly select the skills relevant for requested component and use them

**Skills are self-sufficient.** When implementing a component from a spec, the loaded skill files contain all patterns, conventions, and examples needed. Do NOT read existing component files as reference — that is redundant and wastes context. Go directly from skills + spec to writing files.

## Memory

**All memory and notes MUST be saved inside the project's `.claude/memory/` directory** — never in the global user folder (`~/.claude/projects/...`). This keeps project knowledge co-located with the codebase and version-controlled.