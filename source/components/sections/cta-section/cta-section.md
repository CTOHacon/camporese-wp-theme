cta-section

We need Template, Includes, Scss, ACF Block + global defaults

section.cta-section.lib-container-large (, relative, overflow hidden)
{
    position: relative;
    overflow: hidden;

    image-wrapper
    {
        flex: 1; relative; overflow: hidden;
    }
        image-label
        {
            color: #001020;
            font-family: "Funnel Sans";
            font-size: 0.95906rem;
            font-weight: 300;
            line-height: 132%; /* 1.26594rem */
            text-transform: uppercase;
            border-radius: 0 0.125rem 0 0;
            border: 0.25rem solid var(--White, #FFF);
            background: #F3F6FA;
            bottom: -0.25rem;
            left: -0.25rem;
            padding: 0.35rem 1rem 0.35rem 0.5rem;
        }
        image {
            absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
    main-wrapper
    {
        flex: 1; relative; overflow: hidden;
        flex; column; gap: --2;
        padding: 5.38rem 4.32rem;
    }
        background-image (configurable, covers entire main-wrapper)
        {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
        }
        main-content
        {
            max-width: 36.5rem;
        }
            title
            {
                color: #F7F6F5;
                font-family: "Poltawski Nowy";
                font-size: --2-5;
                font-weight: 400;
                line-height: 112%;
            }
            description
            {
                color: #F7F6F5;
                opacity: 0.8;
                font-weight: 300;
                font-size: --1;
                line-height: 144%;
            }

            __actions (horizontal row with button + phone)
            {
                display: flex;
                gap: 1.75rem;
                align-items: center;
            }

                __button (use button_component, usage like in source/components/sections/cta-section-bar/cta-section-bar.php, but maybe you will need to add a variation for button and modify it using variables to match the design in this section https://www.figma.com/design/AyaanrpUhVRNDhyfYQZE8h/Camporese-Law-Firm--Copy-?node-id=704-9177&m=dev)

                __phone (vertical stack: label + number row)
                {
                    display: flex;
                    flex-direction: column;
                    gap: 0.25rem;

                    label {
                        color: #A0D9D0;
                        opacity: 0.5;
                        font-family: "Funnel Sans";
                        font-weight: 300;
                        font-size: --1;
                        text-transform: uppercase;
                        line-height: 100%;
                        "Or Just Call"
                    }

                    link (icon + number) (use phone from acf/theme-options/contacts.php, add underline on hover)
                    {
                        display: flex;
                        gap: 0.1875rem;
                        align-items: center;

                        icon (phone-outline) { size: 1.4375rem; }

                        number {
                            color: #A0D9D0;
                            font-size: --1-125;
                            font-weight: 400;
                            text-transform: uppercase;
                            line-height: 100%;
                        }
                    }
                }
}