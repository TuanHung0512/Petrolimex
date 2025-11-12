import { select, loadNoscriptContent, on } from 'lib/dom'
import { throttle } from 'lib/utils'
import Swiper from 'swiper'
import { Pagination, Navigation } from 'swiper/modules'

export default (el) => {
	const BREAKPOINT = 782
	let swiper = null


	const updateInstance = () => {
		loadNoscriptContent(el)

		if (window.innerWidth < BREAKPOINT) {
			updateMobileSlider()
		}
	}

	const updateMobileSlider = () => {
		const swiperEl = select('.js-swiper', el)

		if (!swiperEl) return

		swiper = new Swiper(swiperEl, {
			modules: [Pagination, Navigation],
			slidesPerView: 1,
			loop: true,
			pagination: {
				el: select('.swiper-pagination', el)
			},
			navigation: {
				nextEl: select('.swiper-button-next', el),
				prevEl: select('.swiper-button-prev', el)
			}
		})
	}

	updateInstance()

	on('scroll', throttle(updateInstance, 100), window)
}
