require('./bootstrap');
/*
window.Vue = require('vue');
import VueRouter from 'vue-router'
import Vuetify from 'vuetify/lib'
import Vuex from 'vuex';

Vue.use(Vuetify);
Vue.use(VueRouter);
Vue.use(Vuex);

const opts = {
    theme: {
        dark: false,
    },
};*/
//export default new Vuetify(opts)

/*
const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => {
    Vue.component(key.split('/').slice(2).map(e =>_.upperFirst(e)).join('').split('.')[0], files(key).default)
});
*/


/*
const app = new Vue({
    el: '#app',
});

*/
$(document).ready(function () {
    $('.date-mask').mask('00.00.0000');
});