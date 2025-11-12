import { on } from 'lib/dom'

export default el => {
	if (!el) return

	on('click', e => {
		e.preventDefault()
		try {
			if (typeof window !== 'undefined' && window.fullpage_api && typeof window.fullpage_api.moveTo === 'function') {
				window.fullpage_api.moveTo(1)
				return
			}
			window.scrollTo({ top: 0, behavior: 'smooth' })
		} catch (err) {
			window.scrollTo({ top: 0, behavior: 'smooth' })
		}
	}, el)
}
