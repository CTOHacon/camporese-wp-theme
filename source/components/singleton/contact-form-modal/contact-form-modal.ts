import SingletonComponent from "~/library/scripts/Components/SingletonComponent";
import { fadeIn, fadeOut } from "~/library/scripts/Animations/fadeEffect";
import { AppModalsStore } from "~/library/scripts/Stores/AppModalsStore";

export default class ContactFormModal extends SingletonComponent {
    static readonly componentName = "contact-form-modal";

    private closeButton: HTMLButtonElement | null = null;
    private backdrop: HTMLElement | null = null;
    private triggers: HTMLElement[] = [];
    private previouslyFocusedElement: HTMLElement | null = null;

    protected init(): void {
        this.closeButton = this.el.querySelector(".contact-form-modal__close");
        this.backdrop = this.el.querySelector(".contact-form-modal__backdrop");
        this.triggers = Array.from(
            document.querySelectorAll<HTMLElement>('a[href="#contact-modal"]')
        );

        AppModalsStore.registerModalWindow("contact-form-modal", {
            onOpen: () => this.open(),
            onClose: () => this.close(),
        });

        this.triggers.forEach((trigger) => {
            trigger.addEventListener("click", (e) => {
                e.preventDefault();
                AppModalsStore.openModalWindow("contact-form-modal");
            });
        });

        this.closeButton?.addEventListener("click", () => {
            AppModalsStore.closeModalWindow("contact-form-modal");
        });

        this.backdrop?.addEventListener("click", () => {
            AppModalsStore.closeModalWindow("contact-form-modal");
        });

        document.addEventListener("keydown", (e) => {
            if (!AppModalsStore.isModalOpen("contact-form-modal")) return;
            if (e.key === "Escape") {
                AppModalsStore.closeModalWindow("contact-form-modal");
            }
            if (e.key === "Tab") this.trapFocus(e);
        });
    }

    private trapFocus(e: KeyboardEvent): void {
        const focusableElements = this.el.querySelectorAll<HTMLElement>(
            'button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), a[href], [tabindex]:not([tabindex="-1"])'
        );
        const first = focusableElements[0];
        const last = focusableElements[focusableElements.length - 1];

        if (e.shiftKey) {
            if (document.activeElement === first) {
                e.preventDefault();
                last?.focus();
            }
        } else {
            if (document.activeElement === last) {
                e.preventDefault();
                first?.focus();
            }
        }
    }

    private open(): void {
        this.previouslyFocusedElement = document.activeElement as HTMLElement;
        this.el.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden";

        fadeIn(this.el, {
            duration: 200,
            display: "flex",
            onEnd: () => {
                this.el.classList.add("_open");
                const firstFocusable = this.el.querySelector<HTMLElement>(
                    'input:not([type="hidden"]), button, a[href]'
                );
                firstFocusable?.focus();
            },
        });
    }

    private close(): void {
        this.el.setAttribute("aria-hidden", "true");
        document.body.style.overflow = "";

        fadeOut(this.el, {
            duration: 200,
            onEnd: () => {
                this.el.classList.remove("_open");
                this.previouslyFocusedElement?.focus();
            },
        });
    }
}
