import SingletonComponent from "~/library/scripts/Components/SingletonComponent";
import { fadeIn, fadeOut } from "~/library/scripts/Animations/fadeEffect";
import { AppModalsStore } from "~/library/scripts/Stores/AppModalsStore";

export default class PracticeAreasMenuModal extends SingletonComponent {
    static readonly componentName = "practice-areas-menu-modal";

    private triggers: HTMLElement[] = [];
    private previouslyFocusedElement: HTMLElement | null = null;

    protected init(): void {
        this.triggers = Array.from(
            document.querySelectorAll('a[href="#practice-areas-menu-modal"]')
        );

        AppModalsStore.registerModalWindow("practice-areas-menu-modal", {
            onOpen: () => this.open(),
            onClose: () => this.close(),
        });

        this.triggers.forEach((trigger) => {
            trigger.addEventListener("click", (e) => {
                e.preventDefault();
                AppModalsStore.toggleModalWindow("practice-areas-menu-modal");
            });
        });

        this.el.addEventListener("click", (e) => {
            if (e.target === this.el) {
                AppModalsStore.closeModalWindow("practice-areas-menu-modal");
            }
        });

        document.addEventListener("keydown", (e) => {
            if (!AppModalsStore.isModalOpen("practice-areas-menu-modal")) return;
            if (e.key === "Escape") {
                AppModalsStore.closeModalWindow("practice-areas-menu-modal");
            }
            if (e.key === "Tab") this.trapFocus(e);
        });
    }

    private trapFocus(e: KeyboardEvent): void {
        const focusableElements = this.el.querySelectorAll<HTMLElement>(
            'button:not([disabled]), a[href], [tabindex]:not([tabindex="-1"])'
        );
        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];

        if (e.shiftKey) {
            if (document.activeElement === firstElement) {
                e.preventDefault();
                lastElement?.focus();
            }
        } else {
            if (document.activeElement === lastElement) {
                e.preventDefault();
                firstElement?.focus();
            }
        }
    }

    private open(): void {
        this.previouslyFocusedElement = document.activeElement as HTMLElement;
        this.el.setAttribute("aria-hidden", "false");
        this.triggers.forEach((t) => t.classList.add("_active"));

        fadeIn(this.el, {
            duration: 200,
            display: "block",
            onEnd: () => {
                this.el.classList.add("_open");
            },
        });
    }

    private close(): void {
        this.el.setAttribute("aria-hidden", "true");
        this.triggers.forEach((t) => t.classList.remove("_active"));

        fadeOut(this.el, {
            duration: 200,
            onEnd: () => {
                this.el.classList.remove("_open");
                this.previouslyFocusedElement?.focus();
            },
        });
    }
}
