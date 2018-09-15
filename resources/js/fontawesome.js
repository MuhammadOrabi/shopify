// Fontawesome

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon, FontAwesomeLayers, FontAwesomeLayersText } from '@fortawesome/vue-fontawesome'
import {
    faTrash, faTachometerAlt, faEdit, faChartBar, faCogs, faUserTie, faUsers, faEye, faCheck, faUserPlus, faArrowLeft, faListUl, faPlusSquare, faSync, faArrowRight, faImages
} from '@fortawesome/free-solid-svg-icons'

library.add(
    faTrash, faTachometerAlt, faEdit, faChartBar, faCogs, faUserTie, faUsers, faTrash, faEye, faCheck, faUserPlus,
    faArrowLeft, faListUl, faPlusSquare, faSync, faArrowRight, faImages
)

Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.component('font-awesome-layers', FontAwesomeLayers)
Vue.component('font-awesome-layers-text', FontAwesomeLayersText)
