require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import Vuetify from 'vuetify';
import Vuex from 'vuex';
import '@mdi/font/css/materialdesignicons.css'
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(Vuetify);

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => {
    Vue.component(key.split('/').slice(2).map(e =>_.upperFirst(e)).join('').split('.')[0], files(key).default)
});

const app = new Vue({
    vuetify: new Vuetify({
        icons: {
            iconfont: 'mdi', // default - only for display purposes
        },
    }),
}).$mount('#app');

