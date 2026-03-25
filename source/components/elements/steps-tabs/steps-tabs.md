steps-tabs

We need includes, template, SCSS, typescript, ACF block interface

tab-controls
{
    display: flex;
    min-height: --2rem;
    padding: 0 --2rem;
    justify-content: center;
    align-items: center;
    gap: --2rem;

    border-radius: 0 0.125rem 0 0;
    border: 0.25rem solid #FFF;
    background: #F3F6FA;
    mb: --1-5;
}
    tab-control-item
    {
        color: var(--Dark-Cho-Law, #141528);
        font-size: --1-25;
        font-weight: 300;
        line-height: 132%;
        text-transform: uppercase;
        opacity: 0.5;
        
        &._active {
            opacity: 1;
        }
        &:hover{
            opacity: 0.8;
            text-decoration: underline;
        }
    }
tabs-wrapper (tabs are auti switched each 10 seconds - manual tab switch should reset timer)
{
    relative;
    height: 12.5rem; (reassigned in TS reacting on width change to match the biggest content height)
}
    progress-bar-track
    {
        absolute; bottom: 0; left: 0; top: 0;
        height: 100%;
        background: #F3F6FA;
        width: 0.1875rem;
    }
        progress-bar-fill
        {
            width: 100%;
            height: 0%;
            background: #FFB011;
            transition: height 0.3s ease-in-out;
        }
    tab
    {
        padding-left: --2;
        absolute; top: 0; left: 0; width: 100%; height: 100%;
        opacity: 0; visibility: hidden;
        transition: opacity 0.3s ease-in-out;
    }
        tab-content.lib-typography-wrapper
        {
            max-width: width: 49.5rem;
        }
            <use rich text>