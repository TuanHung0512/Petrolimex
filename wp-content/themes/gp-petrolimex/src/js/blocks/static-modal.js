import { on, selectAll, addClass, removeClass, select } from 'lib/dom'

export default el => {
    const modalBtns = selectAll('[class^="static-modal-"]', el)
    modalBtns.forEach(btn => {
        on('click', function(e){
            e.preventDefault()
            const matches = this.className.match(/static-modal-(\d+)/)
            let currentModal = null
            if (matches && matches[1]) {
                currentModal = select('#static-modal-' + matches[1], el)
            }
            selectAll('.static-modal', el).forEach(modal => {
                if (!currentModal || modal !== currentModal) {
                    removeClass('active', modal)
                    removeClass('opacity-1', modal)
                    addClass('opacity-0', modal)
                }
            })
            if (currentModal) {
                addClass('active', currentModal)
                addClass('opacity-1', currentModal)
                removeClass('opacity-0', currentModal)
            }
        }, btn)
    })

    selectAll('.static-modal', el).forEach(modal => {
        on('click', function(event) {
            if (event.target === modal) {
                removeClass('active', modal)
                removeClass('opacity-1', modal)
                addClass('opacity-0', modal)
            }
        }, modal)
    })

    selectAll('.static-modal .btn-close', el).forEach(btn => {
        on('click', function () {
            const modal = this.closest('.static-modal')
            if (modal) {
                removeClass('active', modal)
                removeClass('opacity-1', modal)
                addClass('opacity-0', modal)
            }
        }, btn)
    })
}
