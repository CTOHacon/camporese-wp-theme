import Component from "~/library/scripts/Components/Component";
import { fadeIn, fadeOut } from "~/library/scripts/Animations/fadeEffect";

export default class StepsTabs extends Component {
    static readonly componentName = "steps-tabs";

    private controls: HTMLButtonElement[] = [];
    private tabs: HTMLElement[] = [];
    private progressFill: HTMLElement | null = null;
    private wrapper: HTMLElement | null = null;
    private activeIndex = 0;
    private autoSwitchTimer: ReturnType<typeof setTimeout> | null = null;
    private progressRafId = 0;
    private progressStartTime = 0;
    private readonly AUTO_SWITCH_DELAY = 10000;

    public init(): void {
        this.controls = Array.from(this.el.querySelectorAll('.steps-tabs__control-item'));
        this.tabs = Array.from(this.el.querySelectorAll('.steps-tabs__tab'));
        this.progressFill = this.el.querySelector('.steps-tabs__progress-fill');
        this.wrapper = this.el.querySelector('.steps-tabs__wrapper');

        this.controls.forEach((control, index) => {
            control.addEventListener('click', () => this.switchTab(index));
        });

        this.updateWrapperHeight();
        this.animateProgressBar();
        this.startAutoSwitch();

        window.addEventListener('resize', () => this.updateWrapperHeight());
    }

    private switchTab(index: number): void {
        if (index === this.activeIndex) return;

        const prevTab = this.tabs[this.activeIndex];
        this.controls[this.activeIndex]?.classList.remove('_active');
        if (prevTab) {
            prevTab.classList.remove('_active');
            fadeOut(prevTab);
        }

        this.activeIndex = index;

        const nextTab = this.tabs[this.activeIndex];
        this.controls[this.activeIndex]?.classList.add('_active');
        if (nextTab) {
            nextTab.classList.add('_active');
            fadeIn(nextTab);
        }

        this.animateProgressBar();
        this.resetAutoSwitch();
    }

    private animateProgressBar(): void {
        if (!this.progressFill) return;

        cancelAnimationFrame(this.progressRafId);
        this.progressFill.style.height = '0%';
        this.progressStartTime = performance.now();

        const tick = (now: number) => {
            const elapsed = now - this.progressStartTime;
            const progress = Math.min(elapsed / this.AUTO_SWITCH_DELAY, 1);
            this.progressFill!.style.height = `${progress * 100}%`;

            if (progress < 1) {
                this.progressRafId = requestAnimationFrame(tick);
            }
        };

        this.progressRafId = requestAnimationFrame(tick);
    }

    private updateWrapperHeight(): void {
        if (!this.wrapper) return;

        let maxHeight = 0;
        this.tabs.forEach(tab => {
            tab.style.height = 'auto';
            maxHeight = Math.max(maxHeight, tab.scrollHeight);
            tab.style.height = '';
        });

        this.wrapper.style.height = `${maxHeight}px`;
    }

    private startAutoSwitch(): void {
        if (this.tabs.length <= 1) return;

        this.autoSwitchTimer = setTimeout(() => {
            const nextIndex = (this.activeIndex + 1) % this.tabs.length;
            this.switchTab(nextIndex);
        }, this.AUTO_SWITCH_DELAY);
    }

    private resetAutoSwitch(): void {
        if (this.autoSwitchTimer) {
            clearTimeout(this.autoSwitchTimer);
        }
        this.startAutoSwitch();
    }
}
