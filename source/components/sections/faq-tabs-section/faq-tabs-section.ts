import Component from "~/library/scripts/Components/Component";

export default class FaqTabsSection extends Component {
    static readonly componentName = "faq-tabs-section";

    private buttons: HTMLButtonElement[] = [];
    private panels: HTMLElement[] = [];

    public init(): void {
        this.buttons = Array.from(this.el.querySelectorAll('.faq-tabs-section__control-button'));
        this.panels = Array.from(this.el.querySelectorAll('.faq-tabs-section__panel'));

        this.buttons.forEach((button) => {
            button.addEventListener('click', () => this.switchTab(button));
        });
    }

    private switchTab(button: HTMLButtonElement): void {
        const index = button.dataset.tabIndex;

        this.buttons.forEach((btn) => {
            btn.classList.remove('_active');
            btn.setAttribute('aria-selected', 'false');
        });
        this.panels.forEach((panel) => panel.classList.remove('_active'));

        button.classList.add('_active');
        button.setAttribute('aria-selected', 'true');
        const targetPanel = this.panels.find((panel) => panel.dataset.tabPanel === index);
        targetPanel?.classList.add('_active');
    }
}
