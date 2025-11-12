import { select, selectAll, on, loadNoscriptContent } from 'lib/dom'
import { throttle } from 'lib/utils'
import Swiper from 'swiper'
import { Autoplay, Pagination, Navigation } from 'swiper/modules'

export default el => {
	let loaded = false

	const initSwipers = () => {
		const swiperEls = selectAll('.js-swiper', el)
		if (!swiperEls || !swiperEls.length) return false

		swiperEls.forEach(swiperEl => {
			if (swiperEl.__inited) return
			const swiper = new Swiper(swiperEl, {
				modules: [Autoplay, Pagination, Navigation],
				loop: true,
				slidesPerView: 1,
				autoplay: false,
				pagination: false,
				navigation: {
					nextEl: select('.swiper-banner-next', el),
					prevEl: select('.swiper-banner-prev', el)
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
