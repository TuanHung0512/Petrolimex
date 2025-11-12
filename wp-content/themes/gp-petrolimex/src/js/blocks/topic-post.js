import {select} from 'lib/dom'
import Swiper from 'swiper'
import {Autoplay, Navigation} from 'swiper/modules'

export default (el) => {
	let swiper = null
	const swiperEl = select('.js-swiper', el)

	if (swiperEl) {
		swiper = new Swiper(swiperEl, {
			modules: [Autoplay, Navigation],
			slidesPerView: 3,
			loop: true,
			pagination: false,
			autoplay: {
                delay: 2000,
                disableOnInteraction: false
            },
			navigation: {
				nextEl: '.post-slider__next',
				prevEl: '.post-slider__prev'
			},
			breakpoints: {
				0: {
					slidesPerView: 1,
					centeredSlides: false
				},
				1024: {
					slidesPerView: 3
				}
			}
		})
	}
}
