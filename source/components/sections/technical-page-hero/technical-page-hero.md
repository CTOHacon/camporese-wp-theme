section.technical-page-hero
css: {
    position: relative;
    padding: 4.625rem 0.75rem 3.5rem 0.75rem;
    flex column align-items: center; justify-content: center;
    text-align: center;
    &::before {
        absolute;
        content: "";
        width: 100%;
        height: 34.4375rem;
        top: -2rem;
        top: calc(50% - 45.9375rem/2 - 7.7813rem);

        background: linear-gradient(180deg, #FFFFFF 0%, #F4F8FC 21.75%);
        border-radius: 1rem;
    }
}
    h1__title
    css: {
        font-size: 0;
    }
    component_image __image
    css: {
        height: 30.1875rem;
        margin-bottom: 1.8125rem;
    }
    h2__secondary-title
    css: {
        font-weight: 600;
        font-size: --size-2-5;
        line-height: 106%;
        margin-bottom: --size-1;
    }
    __text
    css: {
        max-width: 69.9375rem;
        font-size: --size-1;
        line-height: 124%;
        letter-spacing: 0.02em;
        color: #677583;
        margin-bottom: --size-1;
    }
    component_button __button [type="solid-dark-blue"] (accept as link from props (passed to html href attr and slot prop))
    css: {
        --c-width: 12rem;
        --c-padding: 1rem 1.5rem;
    }