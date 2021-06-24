/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import VueDatePicker from '@mathieustan/vue-datepicker';
import '@mathieustan/vue-datepicker/dist/vue-datepicker.min.css';

window.Vue = require('vue').default;
Vue.use(VueDatePicker);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('dolar', require('./components/dolar.vue').default);


const app = new Vue({
    el: '#app',
});
