require('./bootstrap');
window.Vue = require('vue');
import Vuetify from './plugins/vuetify'
import router from './routes/routers'
import store from './vuex/store'


// import Vue from 'vue'
// import router from './routes/routers'
// import store from './vuex/store'

const app = new Vue({
    vuetify: Vuetify,
    el: '#app',
    router,
    store
    // render: h => h(App),
})