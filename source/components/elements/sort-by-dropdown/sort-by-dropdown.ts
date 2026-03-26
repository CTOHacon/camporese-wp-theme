import Component from "~/library/scripts/Components/Component";
import { useOutsideClickListener } from "~/library/scripts/Composables/useOutsideClickListner";

export default class SortByDropdown extends Component {
    static readonly componentName = "sort-by-dropdown";

    private trigger: HTMLButtonElement | null = null;

    public init(): void {
        this.trigger = this.el.querySelector('.sort-by-dropdown__trigger');

        this.trigger?.addEventListener('click', () => this.toggleDropdown());
        useOutsideClickListener().addListener(this.el, () => this.closeDropdown());
    }

    private toggleDropdown(): void {
        const isOpen = this.el.classList.toggle('_open');
        this.trigger?.setAttribute('aria-expanded', String(isOpen));
    }

    private closeDropdown(): void {
        this.el.classList.remove('_open');
        this.trigger?.setAttribute('aria-expanded', 'false');
    }
}
