import Component from "~/library/scripts/Components/Component";
import Swiper from "swiper";
import { Navigation, Autoplay } from "swiper/modules";

export default class AsideReviewsWidget extends Component {
	static readonly componentName = "aside-reviews-widget";

	private swiper!: Swiper;

	public init(): void {
		const swiperEl = this.el.querySelector<HTMLElement>(".swiper");
		if (!swiperEl) return;

		this.swiper = new Swiper(swiperEl, {
			modules: [Navigation, Autoplay],
			slidesPerView: 1,
			spaceBetween: 0,
			loop: true,
			autoplay: {
				delay: 5000,
				disableOnInteraction: false,
			},
			navigation: {
				prevEl: this.el.querySelector(".aside-reviews-widget__prev"),
				nextEl: this.el.querySelector(".aside-reviews-widget__next"),
			},
		});
	}
}
