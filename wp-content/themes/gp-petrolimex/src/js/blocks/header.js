import { on, select, getScrollTop, addClass, removeClass, setStyle, setAttribute } from 'lib/dom'
import { throttle } from 'lib/utils'

export default el => {
	const STICKY_POSITION = 200
	const STICKY_HEADER_BODY_CLASS = 'has-sticky-header'
	const body = document.body

  const handleScroll = () => {
		if (getScrollTop() >= STICKY_POSITION) {
			addClass(STICKY_HEADER_BODY_CLASS, body)
		} else {
			removeClass(STICKY_HEADER_BODY_CLASS, body)
		}
	}

	handleScroll()

  on('scroll', throttle(handleScroll, 50), window)

  const callBtn = select('.js-open-call-modal') || select('.header-topbar__call-button')
  const modal = select('#vh-call-modal')

  const closeModal = () => {
    if (!modal) return
    addClass('vh-modal--hidden', modal)
    setAttribute('aria-hidden', 'true', modal)
    setStyle('overflow', '', document.body)
    document.removeEventListener('keydown', onEsc)
    callBtn?.focus()
  }

  const onEsc = e => e.key === 'Escape' && closeModal()

  const openModal = e => {
    e?.preventDefault()
    if (!modal) return
    removeClass('vh-modal--hidden', modal)
    setAttribute('aria-hidden', 'false', modal)
    setStyle('overflow', 'hidden', document.body)
    document.addEventListener('keydown', onEsc)
    select('.vh-modal__btn-call, a, button', modal)?.focus()
  }

  const modalClick = e => {
    if (
      e.target.classList.contains('vh-modal__overlay') ||
      e.target.id === 'btnCancel' ||
      e.target.closest('.vh-modal__btn-cancel')
    ) {
      e.preventDefault()
      closeModal()
    }
  }

  if (callBtn && modal) {
    on('click', openModal, callBtn)
    on('click', modalClick, modal)
    const cancelBtn = select('#btnCancel', modal)
    cancelBtn && on('click', closeModal, cancelBtn)
  }

  return {
    displayName: 'scroll-header',
    unmount: () => {
      on('scroll', null, window, true)
      if (callBtn && modal) {
        callBtn.removeEventListener('click', openModal)
        modal.removeEventListener('click', modalClick)
        document.removeEventListener('keydown', onEsc)
      }
    }
  }
}
