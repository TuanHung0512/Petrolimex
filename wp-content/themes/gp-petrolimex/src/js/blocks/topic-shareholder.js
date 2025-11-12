import { select } from 'lib/dom';
import Swiper from 'swiper';
import { Autoplay, Navigation } from 'swiper/modules';

export default (el) => {
	let swiper = null;
	const swiperEl = select('.js-swiper', el);

	if (swiperEl) {
		swiper = new Swiper(swiperEl, {
			modules: [Autoplay, Navigation],
			spaceBetween: 30,
			centeredSlides: true,
			roundLengths: true,
			loop: true,
			navigation: {
				nextEl: '.button-topic-next',
				prevEl: '.button-topic-prev',
			},
			breakpoints: {
				0: {
					slidesPerView: 1,
					centeredSlides: false,
				},
				1024: {
					slidesPerView: 3,
				},
			},
		});
	}
};
