import Component from "~/library/scripts/Components/Component";
import Swiper from "swiper";
import { Autoplay } from "swiper/modules";

export default class ReviewsSection extends Component {
	static readonly componentName = "reviews-section";

	private swiper!: Swiper;

	public init(): void {
		const swiperEl = this.el.querySelector<HTMLElement>(".swiper");
		if (!swiperEl) return;

		this.swiper = new Swiper(swiperEl, {
			modules: [Autoplay],
			slidesPerView: "auto",
			spaceBetween: 16,
			loop: true,
			autoplay: {
				delay: 3000,
				disableOnInteraction: false,
				pauseOnMouseEnter: true,
			},
			allowTouchMove: true,
			breakpoints: {
				0: {
					slidesPerView: 1,
				},
				640: {
					slidesPerView: "auto",
				},
			},
		});
	}
}
