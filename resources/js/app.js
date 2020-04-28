/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import VeeValidate from 'vee-validate';
import VueTheMask from 'vue-the-mask'
require('./bootstrap');

window.Vue = require('vue');
Vue.use(VeeValidate);
Vue.use(VueTheMask)


Vue.component('ClienteForm', require('./components/Cliente.vue').default);

const app = new Vue({
    el: '#app',
});
