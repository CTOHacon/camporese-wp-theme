import SingletonComponent from "~/library/scripts/Components/SingletonComponent";
import { fadeIn, fadeOut } from "~/library/scripts/Animations/fadeEffect";
import { AppModalsStore } from "~/library/scripts/Stores/AppModalsStore";

export default class MobileMenuModal extends SingletonComponent {
    static readonly componentName = "mobile-menu-modal";

    private toggleButton: HTMLButtonElement | null = null;
    private previouslyFocusedElement: HTMLElement | null = null;

    protected init(): void {
        this.toggleButton = document.querySelector("#mobile-menu-toggle-button");

        AppModalsStore.registerModalWindow("mobile-menu-modal", {
            onOpen: () => this.open(),
            onClose: () => this.close(),
        });

        this.toggleButton?.addEventListener("click", () => {
            AppModalsStore.toggleModalWindow("mobile-menu-modal");
        });

        document.addEventListener("keydown", (e) => {
            if (!AppModalsStore.isModalOpen("mobile-menu-modal")) return;
            if (e.key === "Escape") {
                AppModalsStore.closeModalWindow("mobile-menu-modal");
            }
        });

        this.initAccordions();
    }

    private initAccordions(): void {
        const toggles = this.el.querySelectorAll<HTMLButtonElement>(
            ".mobile-menu-modal__nav-link--toggle"
        );

        toggles.forEach((toggle) => {
            toggle.addEventListener("click", () => {
                const item = toggle.closest(".mobile-menu-modal__nav-item--expandable");
                if (!item) return;

                const isOpen = item.classList.contains("_open");

                // Close all other accordions
                this.el
                    .querySelectorAll(".mobile-menu-modal__nav-item--expandable._open")
                    .forEach((openItem) => {
                        openItem.classList.remove("_open");
                        openItem
                            .querySelector(".mobile-menu-modal__nav-link--toggle")
                            ?.setAttribute("aria-expanded", "false");
                    });

                if (!isOpen) {
                    item.classList.add("_open");
                    toggle.setAttribute("aria-expanded", "true");
                }
            });
        });
    }

    public open(): void {
        this.previouslyFocusedElement = document.activeElement as HTMLElement;
        this.el.setAttribute("aria-hidden", "false");
        this.toggleButton?.classList.add("_active");
        document.body.style.overflow = "hidden";

        fadeIn(this.el, {
            duration: 200,
            display: "block",
            onEnd: () => this.el.classList.add("_open"),
        });
    }

    public close(): void {
        this.el.setAttribute("aria-hidden", "true");
        this.toggleButton?.classList.remove("_active");
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
