import { select, selectAll, on, loadNoscriptContent } from 'lib/dom'
import { throttle } from 'lib/utils'
import Swiper from 'swiper'
import { Autoplay, Pagination } from 'swiper/modules'

export default (el) => {
	let loaded = false

	const initSwipers = () => {
		const swiperEls = selectAll('.js-swiper', el)
		if (!swiperEls || !swiperEls.length) return false

		swiperEls.forEach(swiperEl => {
			if (swiperEl.__inited) return
			const swiper = new Swiper(swiperEl, {
				modules: [Autoplay, Pagination],
				slidesPerView: 1,
				direction: 'vertical',
				loop: true,
				pagination: {
					el: '#swiper-pagination',
					clickable: true,
					type: 'bullets',
					renderBullet: (index, className) => {
						return `<span class="${className}">${index + 1}</span>`
					}
				}
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

	const waterItems = selectAll('.ingredient-intro__background', el)
	const maxShift = 30

	on('mousemove', (e) => {
		const centerX = window.innerWidth / 2
		const centerY = window.innerHeight / 2
		const mouseX = e.clientX - centerX
		const mouseY = e.clientY - centerY

		const shiftX = (mouseX / centerX) * maxShift
		const shiftY = (mouseY / centerY) * maxShift

		waterItems.forEach((item, index) => {
			const offset = (index + 1) * 0.5
			const translateX = shiftX * offset
			const translateY = shiftY * offset

			item.style.transform = `translate(${translateX}px, ${translateY}px)`
		})
	}, document)
}
