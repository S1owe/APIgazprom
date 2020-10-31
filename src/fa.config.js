import Vue from 'vue';
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {library} from '@fortawesome/fontawesome-svg-core'
import {} from '@fortawesome/fontawesome-free-solid'

library.add();

Vue.component('icon', FontAwesomeIcon); // registered globally