import Component from "~/library/scripts/Components/Component";

export default class FaqList extends Component {
    static readonly componentName = "faq-list";

    private items: HTMLElement[] = [];

    public init(): void {
        this.items = Array.from(this.el.querySelectorAll('.faq-list__item'));

        this.items.forEach(item => {
            item.addEventListener('click', () => this.toggle(item));
        });
    }

    private toggle(item: HTMLElement): void {
        const isOpen = item.classList.contains('_opened');
        this.items.forEach(i => i.classList.remove('_opened'));
        if (!isOpen) item.classList.add('_opened');
    }
}
