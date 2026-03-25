page-typography-content component and section + ACF

pre-title (text + tag select)
{
    color: #238E7D;
    font-size: var(--size-1-125);
    font-style: normal;
    font-weight: 600;
    line-height: 132%;
    text-transform: uppercase;
    mb: --size-1
}
title (text + tag select)
{
    max-width: 51.5rem;
    font-family: Poltawski Nowy;
    font-size: --size3-5;
    font-style: normal;
    font-weight: 400;
    line-height: 124%; /* 4.34rem */
    margin-bottom: --size-2-75;
}
image-wrapper (if image passed)
{
    height: 35rem;
    border-radius: 0.25rem;
    overflow: hidden;
}
    image
    {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

sidebar-layout
css: {
    grid; calc(100% - 30rem - --size-3-5) 30rem;
    gap: --size-3-5;
    padding-right: --size-3;

    tablet: {
        padding-right: 0;
    }
    mobile: {
        grid: 100%;
    }
}
    main
    {}
        <main-slot>
    aside
    {
        margin-top: -12rem;
        position relative;
        height: calc(100% + 12rem);
    }
        <sidebar-slot>