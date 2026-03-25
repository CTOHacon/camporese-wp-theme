aside-cases-slider-widget

We need includes, SCSS, template, global settings

{
    border-radius: 0.25rem;
    border: --size-1px solid rgba(20, 21, 40, 0.12);
    background:  #F3F6FA;
    padding: --2;
    relative; overflow: hidden;
    flex; column; gap: --1;
    text-align: center;
}

img source/components/elements/aside-cases-slider-widget/background.png
{
    absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;
}

head
{
}
    title
    {
        color: #fff;
        font-family: "Poltawski Nowy";
        font-size: --1-75;
        font-style: normal;
        font-weight: 400;
        line-height: 112%;
        letter-spacing: -0.0175rem;
        text-transform: capitalize;
    }
    subtitle
    {
        color: #F3F6FA;
        font-size: --1;
        font-style: normal;
        font-weight: 300;
        line-height: 100%;
        padding: 0 0.5rem
    }
slider-wrapper
{
    border-radius: 0.125rem;
    border: --size-1px solid rgba(160, 217, 208, 0.72);
    background: rgba(0, 0, 0, 0.32);
    backdrop-filter: blur(0.25rem);
}
    slider (swiper, 1per view, 0 gap, loop, autoplay, draggable, no pagination, navigation -> controls) (swiper default styles are already connected)
    {
    }
        slide-item.swiper-slide
        {
            padding: --2-5 --3 --2 --3;
            flex; column; justify-content: center; align-items: center;
        }
            title 
            {
                color: #FFF;
                font-family: "Poltawski Nowy";
                font-size: --2;
                font-style: normal;
                font-weight: 400;
                line-height: 100%;
                text-transform: capitalize;
            }
            separator-line
            {
                width: 4.875rem;
                height: --size-1px;
                background: #A0D9D0;
                margin-bottom: --1;
                margin-top: --1-25;
            }
            text
            {
               display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 3;
                align-self: stretch;
                overflow: hidden;
                color: #FFF;
                text-align: center;
                text-overflow: ellipsis;
                font-size: 0.875rem;
                font-weight: 300;
                line-height: 132%; /* 1.155rem */
                min-height: calc(3 * (0.875rem * 1.32));
            }
    controls
        copy paste from aside-reviews-widget;