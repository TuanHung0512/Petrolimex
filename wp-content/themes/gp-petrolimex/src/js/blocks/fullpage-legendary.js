import { selectAll, addClass, removeClass, select } from 'lib/dom'
import fullpage from 'fullpage.js';
import 'fullpage.js/dist/fullpage.css';

export default (el) => {
  if (!el) return;

  const sections = selectAll('.section', el);
  const bodyContent = select('body')

  new fullpage(el, {
    autoScrolling: true,
    navigation: true,
    navigationPosition: 'right',
    showActiveTooltip: true,
    scrollOverflow: false,
    afterLoad: function(origin, destination, direction) {
      try {
        const index = destination && typeof destination.index === 'number' ? destination.index : 0
        const sectionEl = destination && destination.item ? destination.item : null
        const isLight = !!(sectionEl && sectionEl.classList && sectionEl.classList.contains('bg-light'))
        if (bodyContent) {
          if (index > 0) {
            addClass('has-sticky-header', bodyContent)
          } else {
            removeClass('has-sticky-header', bodyContent)
          }
        }
        if (isLight) {
          addClass('fp-viewing-light', [document.body])
        } else {
          removeClass('fp-viewing-light', [document.body])
        }
      } catch (e) {}
    },
    onLeave: function(origin, destination, direction) {
      try {
        const index = destination && typeof destination.index === 'number' ? destination.index : 0
        const sectionEl = destination && destination.item ? destination.item : null
        const isLight = !!(sectionEl && sectionEl.classList && sectionEl.classList.contains('bg-light'))
        if (bodyContent) {
          if (index > 0) {
            addClass('has-sticky-header', bodyContent)
          } else {
            removeClass('has-sticky-header', bodyContent)
          }
        }
        if (isLight) {
          addClass('fp-viewing-light', [document.body])
        } else {
          removeClass('fp-viewing-light', [document.body])
        }
      } catch (e) {}
    }
  });
};
