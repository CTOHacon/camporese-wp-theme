Component content-block.
includes, temlate, scss, acf

`$aside_position` default = right
`$main_align` default = top
section.content-block._aside-position-$aside_position._main-align-$main_align
css: {
    disaply: flex;
    align-items (depends on _main-align-...)
    gap: 3rem; mobile: gap: 1rem;

    mpbile: flex-direction: column
}
    __main.lib-typography-wrapper
    css: {
        --content-max-width: 40.4375rem;
        & > {
            h1,h2,h3,h4,p,[data-component="metrics-row"] {
                max-width: var(--content-max-width);
            }
        }
    }
        slot (rendered inner blocks)
    __aside
    css: {
        min-height: 40rem; mobile: min-height: 30vh;
        position: relative;
        flex: 0 0 44rem; mobile: flex: auto;
    }
        if image - 
        __aside-image-wrapper
        css: {
            border-radius: var(--size-1)
            overflow: hidden;
            height: 100%;
        }
        if before/after 
            (if 1 item) -
                single source/components/image-before-after/image-before-after.includes.php
            if > 1 item
                use source/components/basic-slider/basic-slider.includes.php with the image-before-after as item


Content block management:
InnerBlocks with restricted set of blocks allowed: [source/components/preheader-badge/preheader-badge.acf.php, source/components/fancy-list-ordered/fancy-list-ordered.acf.php, source/components/fancy-list-unordered/fancy-list-unordered.acf.php, source/components/metrics-row/metrics-row.acf.php, default wp heading and paragraph] (ensure the metioned .acf.php blocks has content block in their parents)

group: Aside
    Select of Type: [Single Image, Before/After]
    Single Image:
        image select
    Before After:
        repeater
        
group: Configuration
    Select Aside Position(Left | Right)
    Select Main Align(Top | Middle | Bottom)
    margin bottom