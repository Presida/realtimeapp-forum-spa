// require('./bootstrap');
window.Vue = require('vue');
import Vuetify from '../plugins/vuetify'
import router from './Router/router'
import User from './Helpers/User'

window.User = User
// window.axios = require('axios');
// Vue.prototype.axios = window.axios;

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('app-home-comp', require('./components/AppHome.vue').default);

const app = new Vue({
    vuetify: Vuetify,
    el: '#app',
    router
});
