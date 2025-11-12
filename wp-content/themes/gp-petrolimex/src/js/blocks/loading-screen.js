import { addClass } from 'lib/dom'

const DISABLE_CLASS = 'is-disabled'
const HIDE_DELAY = 400

export default (el) => {
  setTimeout(() => {
    addClass(DISABLE_CLASS, el)
  }, HIDE_DELAY)
}
