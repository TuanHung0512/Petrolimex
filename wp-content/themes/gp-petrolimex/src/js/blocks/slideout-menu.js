import { delegate, toggleClass } from 'lib/dom'

export default el => {
	const BODY_ACTIVE_CLASS = 'has-slideout-menu-opened'
	const body = document.body

	const toggle = () => toggleClass(BODY_ACTIVE_CLASS, body)

	delegate('click', toggle, '.js-toggle-slideout-menu', body)
}
