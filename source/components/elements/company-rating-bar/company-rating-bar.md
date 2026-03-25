Create includes, component template, scss
Use global settings data from /Users/Alex/Documents/projects/Dnovo Clients/Critter Hero/app/public/wp-content/themes/critter-hero-theme/acf/theme-options/post-type.post.archive-settings.php

`$background`: white(default) other pos options: transparent
.company-rating-bar._$background
css: {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0.25rem 1rem 0.25rem 0.25rem;
    gap: 0.25rem;
    width: fit-content;
    background-color: var(--c-background-color);
    border: var(--size-1px) solid var(--c-border-color, var(--c-background-color));
    backdrop-filter: blur(0.125rem);
    border-radius: 2rem;

    &._transparent{
        --c-background-color: rgba(255, 255, 255, 0.16);
        --c-border-color: rgba(255, 255, 255, 0.16);
    }
}
    __author-images
    css: {
        display: flex;
        flex-direction: row-reverce;
    }
        __author-image-wrapper (select 5 first items from all reviews and pluck their author images)
        css: {
            width: 2rem;
            height: 2rem;
            border: var(--size-1px) solid #ECF3F6;
            margin: 0px -1.25rem;
        }
            component_image __author-image
            css: {
                image fit
            }
    __rating
    css: {
        display: flex;
        gap: 0.25rem;
        align-items: center;
    }
        component_svg_icon[name=star] __rating-icon
        css: {
            width: 1.5rem
        }
        __rating-value
        css: {
            font-weight: 500;
            font-size: 0.875rem;
            line-height: 133%;
            color: #285E98;
            (if is _transparent) {
                color: #00B58F;
            }
        }
            {{average rating from globals}}/5
    __total-reviews
    css: {
        font-weight: 400;
        font-size: 0.875rem;
        line-height: 133%;
        color: #677583;
        (if is _transparent) {
            color: #ffffff;
        }
    }
    __separator
    css: {
        font-weight: 400;
        font-size: 0.875rem;
        line-height: 133%;
        text-align: center;
        text-transform: capitalize;
        color: #677583;
        (if is _transparent) {
            color: #ffffff;
        }
    }
        |
    a__all-reviews-link (from globals)
    css: {
        font-weight: 400;
        font-size: 0.875rem;
        line-height: 133%;
        text-decoration-line: underline;
        (if is _transparent) {
            color: #00B58F;
        }
    }
    