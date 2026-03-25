# Component Reference Usage Retrieval Agent

## Purpose
When creating a new component that references/uses existing components (e.g. spec says "use `button`" or "render `section-head`"), launch this agent to retrieve the component's call signature quickly.

## Agent Config
```
subagent_type: Explore
model: haiku
description: "Retrieve component reference docs"
```

## Prompt Template
```
I need the usage reference for the component "{COMPONENT_NAME}".

1. Find the .includes.php file matching this component name under source/components/
   - Use Glob: source/components/**/{COMPONENT_NAME}.includes.php
2. Read the file contents
3. Return ONLY:
   - The function name (e.g. component_button)
   - The full @param docblock (props list)
   - Any default values or data processing logic
   - The render_component_template path (confirms correct component)

Do NOT read .php template, .scss, or .acf.php files — only .includes.php.
```

## When to Use
- Component spec/pseudocode references another component by name
- Need to know props accepted by a child component before calling it
- Multiple references → launch multiple agents in parallel (one per component)

## Key Facts
- `.includes.php` contains: function signature, props docblock, defaults, data processing
- Function naming: `component_{name_with_underscores}()`
- Call pattern: `render_component_template('source/components/{category}/.../name.php', $htmlAttributes, $props)`
- Path is always the full theme-relative path to the `.php` template
