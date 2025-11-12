import { select, selectAll, on, loadNoscriptContent } from 'lib/dom'
import { throttle } from 'lib/utils'
import Swiper from 'swiper'
import { Autoplay, Navigation, EffectFade } from 'swiper/modules'

export default el => {
	let loaded = false
	let contentLoaded = false

	const initSwipers = () => {
		const swiperEls = selectAll('.js-swiper', el)
		if (!swiperEls || !swiperEls.length) return false

		swiperEls.forEach(swiperEl => {
			if (swiperEl.__inited) return
			const container = swiperEl.closest('.achievements-about__slide') || el
			const prevBtn = select('.achievements-about__btn--left, .swiper-button-prev, .swiper-achievements-prev', container)
			const nextBtn = select('.achievements-about__btn--right, .swiper-button-next, .swiper-achievements-next', container)

			const swiper = new Swiper(swiperEl, {
				modules: [Autoplay, Navigation, EffectFade],
				slidesPerView: 1,
				loop: false,
				rewind: true,
				autoHeight: true,
				effect: 'fade',
				fadeEffect: { crossFade: true },
				speed: 600,
				autoplay: false,
			})

			prevBtn && prevBtn.addEventListener('click', e => {
				e.preventDefault()
				e.stopPropagation()
				swiper.slidePrev()
			})
			nextBtn && nextBtn.addEventListener('click', e => {
				e.preventDefault()
				e.stopPropagation()
				swiper.slideNext()
			})

			swiperEl.__inited = true
		})

		loaded = true
		return true
	}

	const init = () => {
		const wrapper = select('.js-swiper-wrapper', el)
		if (!wrapper) return

		if (!contentLoaded) {
			loadNoscriptContent(wrapper)
			contentLoaded = true
		}

		if (loaded) return

		if (initSwipers()) return

		requestAnimationFrame(() => {
			if (!loaded) initSwipers()
		})
	}

	init()

	on('scroll', throttle(init, 100), window)
}
