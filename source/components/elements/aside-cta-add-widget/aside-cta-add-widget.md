aside-cta-add-widget
Create includes, template, SCSS, global default settings

aside-cta-add-widget
{
    border-radius: 0.25rem;
    background: #141528;
}
    main
    {
        relative; overflow: hidden;
        height: 40rem;
    }
        image {
            absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;
        }
        halo-gradient-shadow 
        { absolute; top: 0; left: 0; width: 100%; height: 100%;}
            Repeat all 3 gradints from here -  @https://www.figma.com/design/AyaanrpUhVRNDhyfYQZE8h/Camporese-Law-Firm--Copy-?node-id=2066-11060&m=dev
        main-wrapper
        {
            abosolute; bottom: --2-5; left: --2-5;
            display: flex; column;
            gap: --1-25
        }
            title
            {
                color: #F3F6FA;
                font-size: 3.25rem;
                font-style: normal;
                font-weight: 700;
                line-height: 100%;
                letter-spacing: -0.065rem;
                text-transform: uppercase;
                tablet {
                    font-size: --3rem;
                }
            }
            phone (a) - use phone from global settings (add also some hover effect on it)
            {
                flex; align-items: center;
            }
                label
                {
                    color: #F3F6FA;
                    text-overflow: ellipsis;
                    font-size: --size-1-125;
                    font-weight: 400;
                    line-height: 100%;
                    letter-spacing: -0.0225rem;
                    text-transform: uppercase;
                    margin-right: --1
                }
                icon svg-icon [phone]
                {
                    color: #A0D9D0;
                    width: --2;
                    height: --2;
                    mr: 0.5rem;
                }
                value (from global phone)
                {
                    color: #A0D9D0;
                    font-size: --2;
                    font-style: normal;
                    font-weight: 400;
                    line-height: 100%;
                }
        
        slogan
        {
            max-width: 22.0625rem;
            color: #A0D9D0;
            font-family: "Poltawski Nowy";
            font-size: --2-5;
            font-style: normal;
            font-weight: 400;
            line-height: 100%;
            text-transform: capitalize;
            absolute; top: --2-5; left: --2-5;
            i, strong, span{
                color: #FFF;
                font-style: italic;
            }
        }
        

    bottom-badge (configurable)
    {
        display: flex;
        padding: 0.4375rem 1.5rem;
        justify-content: center;
        align-items: center;
        gap: 0.625rem;

        text-align: center;
        font-size: --size-1-25;
        font-weight: 400;
        line-height: 132%;
        letter-spacing: -0.025rem;
        text-transform: uppercase;
    }
        {text}