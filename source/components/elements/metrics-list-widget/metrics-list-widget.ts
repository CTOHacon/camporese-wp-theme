import Component from "~/library/scripts/Components/Component";

export default class MetricsListWidget extends Component {
    static readonly componentName = "metrics-list-widget";

    private list: HTMLElement | null = null;
    private items: HTMLElement[] = [];
    private activeItem: HTMLElement | null = null;

    public init(): void {
        this.list = this.el.querySelector('.metrics-list-widget__list');
        this.items = Array.from(this.el.querySelectorAll('.metrics-list-widget__item'));

        this.items.forEach((item) => {
            const header = item.querySelector('.metrics-list-widget__header');
            header?.addEventListener('click', () => this.toggle(item));
        });
    }

    private toggle(item: HTMLElement): void {
        if (this.activeItem === item) {
            this.close();
            return;
        }

        this.close();
        item.classList.add('_active');
        this.setItemAria(item, true);
        this.activeItem = item;
        this.updateListTransform();
    }

    private close(): void {
        if (this.activeItem) {
            this.activeItem.classList.remove('_active');
            this.setItemAria(this.activeItem, false);
        }
        this.activeItem = null;
        this.updateListTransform();
    }

    private setItemAria(item: HTMLElement, expanded: boolean): void {
        item.querySelector('.metrics-list-widget__header')?.setAttribute('aria-expanded', String(expanded));
        item.querySelector('.metrics-list-widget__content')?.setAttribute('aria-hidden', String(!expanded));
    }

    private updateListTransform(): void {
        if (!this.list) return;

        if (!this.activeItem) {
            this.list.style.transform = '';
            return;
        }

        const index = this.items.indexOf(this.activeItem);
        const itemsCount = this.items.length;
        const translateItems = Math.max(0, index + 2 - itemsCount);
        const itemHeight = this.el.offsetHeight / itemsCount;

        this.list.style.transform = translateItems > 0
            ? `translateY(${-translateItems * itemHeight}px)`
            : '';
    }
}
