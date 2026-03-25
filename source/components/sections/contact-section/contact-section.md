section.contact-section.lib-container
css: {
    flex;;
    background: #FFFFFF;
    border: var(--size-1px) solid #E5EDF6;
    border-radius: var(--size-1);
}
    component_contact_form_fancy (source/components/contact-form-fancy/contact-form-fancy.includes.php) acepts the settings from the contact-section global/blok context. __contact-form
    css: {
        flex: 1;
    }
    __contact-info
    css: {
        flex: 24.125rem;
        padding: 1rem;
        flex, column. column flex items end;
    }
        __contact-info-head 
        css: {
            padding-left: var(--size-1);
        }
        h2__title
        css: {
            font-style: normal;
            font-weight: 600;
            font-size: var(--size-1-75);
            line-height: 106%;
        }
        p__text
        css: {
            font-size: var(--size-1);
            line-height: 150%;
            color: #677583;
        }
        __map-wrapper
        css: {
            margin-top: var(--size-3);
            border-radius: var(--size-0-5);
            overflow: hidden;
            height: 19.5625rem;
            width: 100%;
            height: 19.5625rem;
            margin-bottom: var(--size-1);
        }
            component_image (source/components/image/image.includes.php) __map-image
            css: {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        __contacts
        css: {
            flex, column, gap 0.5rem;
        }
            a__contact-link (mailto)
            css: {
                display: flex;
                align-items: center;
                padding: 0.5rem;
                gap: 1rem;
                background: #FFFFFF;
                border: var(--size-1px) solid rgba(40, 94, 152, 0.32);
                border-radius: 0.5rem;

                on hover: border color #285E98;
            }
                __icon-wrapper
                css: {
                    width: 4rem;
                    height: 4rem;
                    background: rgba(40, 94, 152, 0.1);
                    border-radius: 0.5rem;
                    flex; ceter center;
                    on link hover background #285E98
                }
                    <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 7H35C36.925 7 38.5 8.575 38.5 10.5V31.5C38.5 33.425 36.925 35 35 35H7C5.075 35 3.5 33.425 3.5 31.5V10.5C3.5 8.575 5.075 7 7 7Z" stroke="#285E98" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M38.5 10.5L21 22.75L3.5 10.5" stroke="#285E98" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    css: {
                        width: 2.625rem; height: 2.625rem;

                        icon #FFFFFF on link hover
                    }
                span__contact-text
                css: {
                    font-style: normal;
                    font-weight: 400;
                    font-size: var(--size-1-125);
                    line-height: 132%;
                }
            a(link to maps, if link set - link, if no - span with no hover effects, make check :is(a))
                has icon
                <svg width="35" height="36" viewBox="0 0 35 36" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M30.625 15C30.625 25.5 17.5 34.5 17.5 34.5C17.5 34.5 4.375 25.5 4.375 15C4.375 11.4196 5.75781 7.9858 8.21922 5.45406C10.6806 2.92232 14.019 1.5 17.5 1.5C20.981 1.5 24.3194 2.92232 26.7808 5.45406C29.2422 7.9858 30.625 11.4196 30.625 15Z" stroke="#285E98" stroke-width="1.5" stroke-linejoin="round"/>
<path d="M17.5 19.5C19.9162 19.5 21.875 17.4853 21.875 15C21.875 12.5147 19.9162 10.5 17.5 10.5C15.0838 10.5 13.125 12.5147 13.125 15C13.125 17.4853 15.0838 19.5 17.5 19.5Z" stroke="#285E98" stroke-width="1.5" stroke-linejoin="round"/>
</svg>
                    css: {
                        width: 35; height:  2.25rem;
                        icon #FFFFFF on link hover
                    }

Block has it's own global setting where the entire form configured (copying fields from acf/theme-options/theme-parts.contact-forms.php) ensure there are ability to configure also the decoration image for the from in this block. The map, email and adress should be loaded from the contacts glboal setting. 