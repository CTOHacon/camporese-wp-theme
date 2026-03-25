Template, Includes, SCSS, TS (slider), ACF Block + Block Defaults Global Settings

Data source: acf/theme-options/reviews.php (reviews repeater + company rating)

section.reviews-section.lib-container-large
css: {
    background: #F3F6FA;
    border-radius: 0.25rem;
    padding-top: 3.5rem;
}
    __inner.lib-container
    css: {
        display: flex;
        gap: --2;
    }
        __rating-bar (new child component, see spec below the ---)
        css: {
            flex: 21.5rem 0 0;
        }

        __main (right, flex: 1)
        css: {
        }
            __head
            css: {
                margin-bottom: --2;
            }
                h2__title
                css: {
                    font-family: "Poltawski Nowy";
                    font-size: --3;
                    font-weight: 400;
                    line-height: 112%;
                    color: #001020;
                    margin-bottom: --1;
                }
                __description
                css: {
                    font-size: --1;
                    font-weight: 300;
                    line-height: 132%;
                    color: #001020;
                    opacity: 0.8;
                }
                    first line is bold (font-weight: 700), rest is light (300)
                    use two separate spans or format via ACF (textarea with <strong>)

            __slider-wrapper
            css: {
                width: calc(100% + var(--lib-container-simulation-padding)); (bleeds right outside container)
                overflow: hidden;
                padding-bottom: 4.625rem; (just needed)
            }
                slider (swiper): {
                    slidesPerView: auto;
                    spaceBetween: 16px (--1);
                    autoplay: 3000ms delay;
                    draggable;
                    pauseOnMouseEnter;
                    loop;
                    no dots;
                    no arrows;
                    1 slide per view on mobile;
                }
                __slide.swiper-slide
                css: {
                    flex: 21.5rem 0 0; (fixed on desktop, 100% width on mobile)
                    flex-shrink: 0;

                    display: flex;
                    flex-direction: column;
                    gap: --1;
                    padding: --2;
                    background: #FFFFFF;
                    border: var(--size-1px) solid #E5EDF6;
                    border-radius: 0.25rem;
                }

                    Handle stars, separator and author same as source/components/elements/aside-reviews-widget
                    __stars
                    css: {
                        display: flex;
                        gap: 0.25rem;
                    }
                        component_svg_icon[name="star"] * 5
                        css: {
                            width: --1;
                            height: --1;
                        }
                    __review-text
                    css: {
                        font-size: --1;
                        font-weight: 400;
                        line-height: 150%;
                        letter-spacing: -0.02em;
                        color: #677583;
                        text-transform: capitalize;
                        ellipsis 5 lines;
                        min-height: calc(5 * (var(--size-1) * 1.5));
                    }
                    __separator
                        same as aside-reviews-widget separator (SVG line, 100% width)
                    __author
                    css: {
                        display: flex;
                        gap: 0.75rem;
                        align-items: center;
                    }
                        __author-image-wrapper
                        css: {
                            width: 3rem;
                            height: 3rem;
                            border-radius: 50%;
                            overflow: hidden;
                        }
                            component_image __author-image (object-fit: cover)
                        __author-info
                        css: {
                            text-align: left;
                            text-transform: capitalize;
                        }
                            __author-name
                            css: {
                                font-family: "Poltawski Nowy";
                                font-size: --1;
                                font-weight: 400;
                                line-height: 133%;
                                color: #12283E;
                            }
                            __author-date
                            css: {
                                font-size: 0.875rem;
                                font-weight: 400;
                                line-height: 100%;
                                letter-spacing: -0.02em;
                                color: #677583;
                                opacity: 0.5;
                            }

---

Child component: reviews-section-rating-bar (inside reviews-section folder or inline)

__rating-bar
css: {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: --1-5 --2;
    border-radius: 0.25rem;
    overflow: hidden;
    position: relative;
    background-image: will be provided as file (dark themed, place in component folder assets/rating-bar-background.png - relative path from build forlder to the component folder);
    background-size: cover;
    background-position: center;
}
    Data from acf/theme-options/reviews.php (field_rating group)

    __rating-bar-content
    css: {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: --1;
    }
        __rating-mark
        css: {
            position: relative;
            width: 6.8rem;
            height: 6.8rem;
        }
            __rating-mark-icon (laurel wreath SVG, provide as file in component folder)
            css: {
                position: absolute;
                inset: 0;
                width: 100%;
                height: 100%;
            }
            __rating-mark-value
            css: {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-family: "Poltawski Nowy";
                font-size: 2.625rem;
                font-weight: 400;
                line-height: 100%;
                color: #FFFFFF;
                text-align: center;
            }
                {{ field_rating.average }} (e.g. "4.9")

        __rating-bar-text
        css: {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.25rem;
        }
            __rating-bar-title
            css: {
                font-family: "Poltawski Nowy";
                font-size: --2;
                font-weight: 400;
                line-height: 100%;
                color: #FFFFFF;
                white-space: nowrap;
            }
                "Google Rating" (configurable in block defaults)

            __rating-bar-separator
                short horizontal line (width 4.5rem hedight --size-1px), white, centered
                (SVG or border-top)

            __rating-bar-reviews-link
            css: {
                font-size: --1;
                font-weight: 400;
                line-height: 100%;
                color: #A0D9D0;
                text-align: center;
                text-decoration: underline;
            }
                if field_rating.all_reviews_link: render as <a>
                else: render as <span>
                "Based On {{ field_rating.total_reviews }} Reviews"
