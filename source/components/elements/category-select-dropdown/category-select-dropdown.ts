import Component from "~/library/scripts/Components/Component";
import { useOutsideClickListener } from "~/library/scripts/Composables/useOutsideClickListner";

export default class CategorySelectDropdown extends Component {
    static readonly componentName = "category-select-dropdown";

    private trigger: HTMLButtonElement | null = null;

    public init(): void {
        this.trigger = this.el.querySelector('.category-select-dropdown__trigger');

        this.trigger?.addEventListener('click', () => this.toggleDropdown());
        useOutsideClickListener(this.el, () => this.closeDropdown());
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
