import Component from "~/library/scripts/Components/Component";
import Swiper from "swiper";
import { Autoplay } from "swiper/modules";

export default class StepsTabs extends Component {
    static readonly componentName = "steps-tabs";

    private swiper!: Swiper;
    private controls: HTMLButtonElement[] = [];
    private progressFill: HTMLElement | null = null;
    private progressRafId = 0;
    private progressStartTime = 0;
    private readonly AUTO_SWITCH_DELAY = 10000;

    public init(): void {
        this.controls = Array.from(this.el.querySelectorAll('.steps-tabs__control-item'));
        this.progressFill = this.el.querySelector('.steps-tabs__progress-fill');

        const swiperEl = this.el.querySelector<HTMLElement>('.swiper');
        if (!swiperEl) return;

        this.swiper = new Swiper(swiperEl, {
            modules: [Autoplay],
            direction: 'vertical',
            slidesPerView: 1,
            autoHeight: false,
            speed: 350,
            autoplay: {
                delay: this.AUTO_SWITCH_DELAY,
                disableOnInteraction: false,
            },
            on: {
                slideChange: () => this.onSlideChange(),
            },
        });

        this.controls.forEach((control, index) => {
            control.addEventListener('click', () => {
                this.swiper.slideTo(index);
            });
        });

        this.animateProgressBar();
    }

    private onSlideChange(): void {
        const activeIndex = this.swiper.activeIndex;

        this.controls.forEach((control, index) => {
            control.classList.toggle('_active', index === activeIndex);
        });

        this.animateProgressBar();
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
}
