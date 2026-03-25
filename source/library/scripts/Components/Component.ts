export default abstract class Component {
    protected readonly el: HTMLElement;

    constructor(element: HTMLElement) {
        this.el = element;
    }

    abstract init(): void;

    static initAll<T extends Component>(
        this: { new(element: HTMLElement): T; readonly componentName: string },
    ): void {
        document
            .querySelectorAll<HTMLElement>(`[data-component="${this.componentName}"]`)
            .forEach(element => new this(element).init());
    }
}