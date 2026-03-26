import Component from "~/library/scripts/Components/Component";
import Swiper from "swiper";

export default class BlogPostsSlider extends Component {
    static readonly componentName = "blog-posts-slider";

    private swiper!: Swiper;

    public init(): void {
        const swiperEl = this.el.querySelector<HTMLElement>(".swiper");
        if (!swiperEl) return;

        this.swiper = new Swiper(swiperEl, {
            slidesPerView: 1,
            spaceBetween: 16,
            breakpoints: {
                768: {
                    slidesPerView: "auto",
                },
            },
        });
    }
}
