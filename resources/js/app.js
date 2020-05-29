/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./plugins/perfect-scrollbar.jquery.min');
require('./core/bootstrap-material-design.min');
require('./material-dashboard');


window.Vue = require('vue');

import VueGoogleCharts from 'vue-google-charts';
Vue.use(VueGoogleCharts);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('user-card-component', require('./components/UserCardComponent.vue').default);
Vue.component('navbar-component', require('./components/NavbarComponent.vue').default);
Vue.component('sidebar-component', require('./components/SidebarComponent.vue').default);

Vue.component('dashboard-component', require('./components/DashboardComponent.vue').default);

Vue.component('events-component', require('./components/event/EventsComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
