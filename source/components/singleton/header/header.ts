import SingletonComponent from "~/library/scripts/Components/SingletonComponent";
import { fadeIn, fadeOut } from "~/library/scripts/Animations/fadeEffect";
import { AppModalsStore } from "~/library/scripts/Stores/AppModalsStore";

type Submenu = {
    name: string;
    trigger: HTMLElement;
    panel: HTMLElement;
};

export default class Header extends SingletonComponent {
    static readonly componentName = "header";

    private hasPageHero = false;
    private submenus: Submenu[] = [];

    protected init(): void {
        this.hasPageHero = !!document.querySelector(".page-hero");

        if (this.hasPageHero) {
            this.el.classList.add("_transparent");
            this.handleScroll();
            window.addEventListener("scroll", this.handleScroll, { passive: true });
        }

        this.initSubmenus();
    }

    private initSubmenus(): void {
        const triggers = this.el.querySelectorAll<HTMLElement>(
            ".header__menu-link--has-submenu"
        );

        triggers.forEach((trigger) => {
            const menuItem = trigger.closest(".header__menu-item");
            const panel = menuItem?.querySelector<HTMLElement>(".header__submenu");
            if (!panel || !panel.id) return;

            const name = `header-submenu-${panel.id}`;
            const submenu: Submenu = { name, trigger, panel };
            this.submenus.push(submenu);

            AppModalsStore.registerModalWindow(name, {
                onOpen: () => this.openSubmenu(submenu),
                onClose: () => this.closeSubmenu(submenu),
            });

            trigger.addEventListener("click", (e) => {
                e.preventDefault();
                AppModalsStore.toggleModalWindow(name);
            });
        });

        document.addEventListener("click", (e) => {
            const target = e.target as HTMLElement;
            this.submenus.forEach((submenu) => {
                if (
                    AppModalsStore.isModalOpen(submenu.name) &&
                    !submenu.trigger.contains(target) &&
                    !submenu.panel.contains(target)
                ) {
                    AppModalsStore.closeModalWindow(submenu.name);
                }
            });
        });

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                this.submenus.forEach((submenu) => {
                    if (AppModalsStore.isModalOpen(submenu.name)) {
                        AppModalsStore.closeModalWindow(submenu.name);
                    }
                });
            }
        });
    }

    private openSubmenu(submenu: Submenu): void {
        submenu.trigger.classList.add("_active");
        submenu.panel.setAttribute("aria-hidden", "false");

        fadeIn(submenu.panel, {
            duration: 200,
            display: "block",
            onEnd: () => {
                submenu.panel.classList.add("_open");
            },
        });
    }

    private closeSubmenu(submenu: Submenu): void {
        submenu.trigger.classList.remove("_active");
        submenu.panel.setAttribute("aria-hidden", "true");

        fadeOut(submenu.panel, {
            duration: 200,
            onEnd: () => {
                submenu.panel.classList.remove("_open");
            },
        });
    }

    private handleScroll = () => {
        this.el.classList.toggle("_scrolled", window.scrollY > 0);
    };
}
