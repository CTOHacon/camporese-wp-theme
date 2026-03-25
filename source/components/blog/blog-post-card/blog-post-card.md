.blog-post-card
css: {
    relative;
    height: 18rem;
    border-radius: var(--size-1);
    overflow: hidden;
}
    component_image __image
    css; {
        absolute; inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    __image-overlay
    css: {
        background: linear-gradient(180deg, rgba(33, 33, 33, 0) 62.43%, #101010 93.83%);
        inset: 0;
    }
    __title
    css: {
        absolute;
        left: --size-1-5;
        bottom: --size-1-5;
        right: --size-2-5;

        on card-hover { bottom: 0.5rem}
    } 
        a
        css: {
            font-weight: 500;
            font-size: --size-1-125;
            line-height: 112%;
            letter-spacing: 0.02em;
            color: #F6F6F6;
            ::before{
                content: '';
                absolute; inset: 0;
            }
        }

Accepts the image and title as props.