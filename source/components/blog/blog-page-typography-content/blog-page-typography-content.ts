import Component from '~/library/scripts/Components/Component';

export default class BlogPageTypographyContent extends Component {
    static readonly componentName = 'blog-page-typography-content';

    private mainContent: HTMLElement | null = null;
    private tocItems: HTMLAnchorElement[] = [];
    private headings: HTMLElement[] = [];
    private scrollTicking = false;

    public init(): void {
        this.mainContent = this.el.querySelector('.page-typography-content-base__main');
        this.tocItems = Array.from(
            this.el.querySelectorAll('.blog-page-typography-content__toc-list-item')
        );

        if (!this.mainContent || this.tocItems.length === 0) return;

        this.collectHeadings();
        this.setupClickHandlers();
        this.setupScrollTracking();
    }

    private collectHeadings(): void {
        if (!this.mainContent) return;

        this.headings = Array.from(
            this.mainContent.querySelectorAll('h2[id], h3[id]')
        ) as HTMLElement[];
    }

    private setupClickHandlers(): void {
        this.tocItems.forEach(link => {
            link.addEventListener('click', e => {
                e.preventDefault();
                const headingId = link.getAttribute('data-heading-id');
                if (headingId) {
                    this.scrollToHeading(headingId);
                }
            });
        });
    }

    private scrollToHeading(id: string): void {
        const element = document.getElementById(id);
        if (!element) return;

        const headerHeight = parseFloat(
            getComputedStyle(document.documentElement).getPropertyValue('--header-taken-space') || '0'
        );

        const elementTop = element.getBoundingClientRect().top + window.scrollY;
        const usableViewport = window.innerHeight - headerHeight;
        const targetOffset = headerHeight + usableViewport * 0.3;

        window.scrollTo({
            top: elementTop - targetOffset,
            behavior: 'smooth',
        });
    }

    private setupScrollTracking(): void {
        const onScroll = () => {
            if (!this.scrollTicking) {
                requestAnimationFrame(() => {
                    this.updateActiveItem();
                    this.scrollTicking = false;
                });
                this.scrollTicking = true;
            }
        };

        window.addEventListener('scroll', onScroll, { passive: true });
        this.updateActiveItem();
    }

    private updateActiveItem(): void {
        const headerHeight = parseFloat(
            getComputedStyle(document.documentElement).getPropertyValue('--header-taken-space') || '0'
        );
        const threshold = headerHeight + window.innerHeight * 0.4;

        let activeId: string | null = null;

        for (const heading of this.headings) {
            if (heading.getBoundingClientRect().top <= threshold) {
                activeId = heading.id;
            }
        }

        this.setActiveItem(activeId);
    }

    private setActiveItem(activeId: string | null): void {
        this.tocItems.forEach(item => {
            const headingId = item.getAttribute('data-heading-id');
            item.classList.toggle('_active', headingId === activeId);
        });
    }
}
