Template, scss, TS, ACF, "Block Defaults" Global Settings Page,

section.faq-section.lib-container
component_section_head
css: {
    --c-text-align: left;
}
    ul__faq-list (repeater with block layout)
        li__faq-item (1st item _opened by default)
        css: {
            padding: var(--size-1);
            background: #FFFFFF;
            border: var(--size-1px) solid #E5EDF6;
            border-radius: var(--size-1);
            padding: 1rem;
        }
            __head
            css: {
                flex; align-items: center; space-between;
            }
                h3__title
                css: {
                    font-weight: 500;
                    font-size: var(--size-1-125);
                    line-height: 144%;
                }
                component_svg_icon[name="faq-angle"] __icon
                css: {
                    width: 0.875rem;
                    transition: transform 0.3s ease;
                    (rotate 180 deg when opened)
                }
            __answer
            css: {
                padding-top: --size-1;
                font-weight: 400;
                font-size: --size-1;
                line-height: 124%;
                letter-spacing: 0.02em;
                color: #677583;

                (block when opened, none when closed)
            }