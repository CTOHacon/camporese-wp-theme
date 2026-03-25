aside-reviews-widget uses the acf/theme-options/reviews.php as data source

Also we need a configuration in block defaults (to configure the title (Google Rating by default))

We need only includes, component and SCSS

head
{
    flex; column; horizontal center;
    padding-top: --3-5;

    border-radius: 0.25rem;
    border: --size-1px solid rgba(20, 21, 40, 0.12);
    background: #F3F6FA;
    mb: --1
}
    stars-decoration
    {
        mb: --size-1;
        height: --size-2-5;
        width: auto;
    }
        @https://www.figma.com/design/AyaanrpUhVRNDhyfYQZE8h/Camporese-Law-Firm--Copy-?node-id=2066-10886&m=dev (export as external .svg image file in the source/components/elements/aside-reviews-widget and use)
    title
    {
        font-family: Poltawski Nowy;
        font-size: --2-5;
        font-weight: 400;
        line-height: 100%;  
        mb: --2-5
    }
    reviews-count
    {
        padding: --1
        font-size: --1;
        font-style: normal;
        font-weight: 400;
        line-height: 100%;
    }
reviews-body
{
    border-radius: 0.25rem;
    border: --1px solid rgba(20, 21, 40, 0.12);
    background: #F3F6FA;
    padding: --1-5
}
    reviews-slider-wrapper
    {
        display: flex;
        padding: --2 --1;
        flex-direction: column;
        gap: 0.625rem;

        border-radius: 0.25rem;
        border: --1px solid var(--Semi-Blue, #E5EDF6);
        background: #FFF;
    }
    reviews-slider (swiper, 1per view, 0 gap, loop, autoplay, draggable, no pagination, navigation -> controls) (swiper default styles are already connected)
    {
    }
        review-item.swiper-slide (can be a child component)
        {
            padding: 0 --1 --1 --1;
            flex column gap --1;
        }
        stars
        {
            flex; gap: 0.25rem;
        }
            star*5 (component svg icon name star)
            css 
            {
                width: --1;
                height: --1;
            }
            title
            {
                color: #141528;
                font-family: "Poltawski Nowy";
                font-size: 1.375rem;
                font-weight: 700;
                line-height: 150%;
                letter-spacing: -0.0275rem;
                text-transform: capitalize;
            }
            text
            {
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 6;
                text-overflow: ellipsis;

                overflow: hidden;
                color:  #141528;
                font-size: --1;
                font-style: normal;
                font-weight: 400;
                line-height: 150%;
                min-height: calc(6 * (var(--size-1) * 1.5));
                letter-spacing: -0.02rem;
                text-transform: capitalize;
            }
            separator-line
                render this SVG to proportionaly fill the 100% width:
                    @https://www.figma.com/design/AyaanrpUhVRNDhyfYQZE8h/Camporese-Law-Firm--Copy-?node-id=2066-10904&m=dev
            author
                @https://www.figma.com/design/AyaanrpUhVRNDhyfYQZE8h/Camporese-Law-Firm--Copy-?node-id=2066-10904&m=dev
    controls
        https://www.figma.com/design/AyaanrpUhVRNDhyfYQZE8h/Camporese-Law-Firm--Copy-?node-id=2066-10910&m=dev
    