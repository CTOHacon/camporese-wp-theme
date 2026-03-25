type SingletonConstructor<T> = {
    new(element: HTMLElement): T;
    readonly componentName: string;
    _instance?: T;
};

export default abstract class SingletonComponent {
    protected readonly el: HTMLElement;
    public static _instance?: SingletonComponent;

    constructor(element: HTMLElement) {
        this.el = element;
    }

    protected abstract init(): void;

    static getInstance<T extends SingletonComponent>(
        this: SingletonConstructor<T>
    ): T {
        if (this._instance) {
            return this._instance as T;
        }

        const element = document.getElementById(this.componentName);
        if (!element) {
            console.error(`Element #${this.componentName} not found`);
            return null!;
        }

        const instance = new this(element);
        instance.init();
        this._instance = instance;
        return instance;
    }
}