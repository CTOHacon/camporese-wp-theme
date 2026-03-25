fancy-cards-list

We need Template, Includes, Scss, ACF Block

ul.fancy-cards-list (flex list of max 3 items in a row, min width: 10rem)
{
    display: flex;
    flex-wrap: wrap;
    padding: --1;
    border-radius: 0.25rem;
    background: #F3F6FA;

    grid; gap: 0.5rem;
}
    item (flex item)
    {
        display: flex;
        padding: 1.375rem 1.1875rem;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 0.625rem;
        align-self: stretch;
        border-radius: 0.125rem;
        background: #FFF;
        &:hover{
            background: #141528;
        }
    }
        title {
            color: #001020
            text-align: center;
            font-family: "Poltawski Nowy";
            font-size: --1-125;
            font-style: normal;
            font-weight: 400;
            line-height: 100%;
            text-transform: capitalize;

            on card hover {
                color: #FFF;
            }
        }
        separator {
            max-width: 4.875rem;
            width: 100%;
            height: 0.0625rem;
            background: #88A4CF;
            margin: --1-25 0 --1 0

            on card hover {
                color: #FFF;
            }
        }
        text {
            clamp 3 lines
            overflow: hidden;
            color: #141528;
            text-align: center;
            text-overflow: ellipsis;
            font-size: 0.875rem;
            font-weight: 300;
            line-height: 132%; /* 1.155rem */

            on card hover {
                color: #FFF;
            }
        }