ul.advantages-list.lib-container
css: {
    flex, gap: 1.5rem; flex wrap;
}
    li__item
    css: {
        <!-- 1/3 in row -->
        display: flex;
        align-items: center;
        gap: --size-1;
        text-align: center;
    }
        component_image __item-icon
        css: {
            width: 4.5rem;
            height: auto;
        }
        __item-main
        css: {

        }
            __item-title
            css: {
                font-weight: 500;
                font-size: --size-1-125;
                line-height: 100%;
                letter-spacing: 0.02em;
                color: #285E98;
                margin-bottom: 0.5rem;
            }
            __item-text
            css: {
                font-weight: 400;
                font-size: --size-1;
                line-height: 150%;
                letter-spacing: -0.02em;
                color: #677583;
                2 lines eclipsis
            }