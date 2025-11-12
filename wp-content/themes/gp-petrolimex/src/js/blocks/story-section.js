import { select, selectAll, on, hasClass, toggleClass, getTopPosition } from 'lib/dom'

export default el => {
	const hiddenScreenEl = select('.js-hidden-screen', el)
	const thirdScreenEl = select('.story-section__screen--2', el)
	const VISIBLE_CLASS = 'story-section--visible-content'
	const viewMoreButtonEls = selectAll('.js-view-more-trigger', el)

	if (viewMoreButtonEls) {
		on('click', (e) => {
			const isCloseButton = e.target.closest('.story-section__close-button')

			if (isCloseButton) {
				window.scrollTo(0, getTopPosition(thirdScreenEl))

				setTimeout(() => {
					toggleClass(VISIBLE_CLASS, el)
				}, 200)
			} else {
				const targetEl = hasClass(VISIBLE_CLASS, el) ? el : hiddenScreenEl

				window.scrollTo(0, getTopPosition(targetEl))

				setTimeout(() => {
					toggleClass(VISIBLE_CLASS, el)
				}, 200)
			}
		}, viewMoreButtonEls)
	}
}
