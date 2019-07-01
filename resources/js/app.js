require ('./bootstrap.js');

import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuetify from 'vuetify'
import routes from './routes';
import store from './store';
import 'vuetify/dist/vuetify.min.css';

Vue.use(Vuetify);
Vue.use(VueRouter);

Vue.component('topnav',require('./components/Topnav').default);
Vue.component('v-datetime-picker',require('./components/DateTimePicker').default);

let app = new Vue({
    el: '#app',
    store,
    router: new VueRouter(routes)
});

