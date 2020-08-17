// require('./bootstrap');
window.Vue = require('vue');
import Vuetify from '../plugins/vuetify'
import router from './Router/router'
import User from './Helpers/User'
import VueSimplemde from 'vue-simplemde'
import 'simplemde/dist/simplemde.min.css'
import md from 'marked'

window.md = md

Vue.component('vue-simplemde', VueSimplemde)

window.User = User

window.axios = require('axios');
Vue.prototype.axios = window.axios;

window.EventBus = new Vue();

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('app-home-comp', require('./components/AppHome.vue').default);

// Passing Token
const JwtToken = `Bearer ${localStorage.getItem('token')}`
axios.defaults.headers.common['Authorization'] = JwtToken;

const app = new Vue({
    vuetify: Vuetify,
    el: '#app',
    router
});
