import { select, selectAll, on, loadNoscriptContent, inViewPort } from 'lib/dom'
import { throttle } from 'lib/utils'
import Swiper from 'swiper'
import { Pagination, Autoplay, Navigation } from 'swiper/modules'

export default el => {
	let loaded = false

	const initSwipers = () => {
		const swiperEls = selectAll('.js-swiper', el)
		if (!swiperEls || !swiperEls.length) return false

		swiperEls.forEach(swiperEl => {
			if (swiperEl.__inited) return
			const swiper = new Swiper(swiperEl, {
				modules: [Pagination, Autoplay, Navigation],
				loop: false,
				slidesPerView: 4,
				autoplay: {
					delay: 4000,
					disableOnInteraction: false,
				},
				pagination: {
					el: select('.swiper-pagination', swiperEl),
					clickable: true,
				},
				navigation: {
					nextEl: select('.swiper-product-next', el),
					prevEl: select('.swiper-product-prev', el)
				},
				breakpoints: {
					0: {
						slidesPerView: 1,
					},
					576: {
						slidesPerView: 2,
					},
					992: {
						slidesPerView: 2,
					},
					1080: {
						slidesPerView: 3,
					},
					1280: {
						slidesPerView: 4,
					}
				},
			})
			swiperEl.__inited = true
		})

		loaded = true
		return true
	}

	const init = () => {
		const wrapper = select('.js-swiper-wrapper', el)
		if (!wrapper) return

		loadNoscriptContent(wrapper)

		if (initSwipers()) return

		requestAnimationFrame(() => {
			if (!loaded) initSwipers()
		})
	}

	init()

	on('scroll', throttle(init, 100), window)
}
