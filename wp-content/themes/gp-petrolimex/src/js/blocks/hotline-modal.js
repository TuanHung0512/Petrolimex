import { delegate, addClass, removeClass } from 'lib/dom'

export default el => {
	const BODY_ACTIVE_CLASS = 'has-hotline-modal-opened'
	const BODY_MENU_CLASS = 'has-slideout-menu-opened'
	const body = document.body

	delegate('click', () => {
		removeClass(BODY_MENU_CLASS, body)
		addClass(BODY_ACTIVE_CLASS, body)
	}, '.js-open-hotline-modal', body)

	delegate('click', () => {
		removeClass(BODY_ACTIVE_CLASS, body)
	}, '.js-close-hotline-modal', body)
}
