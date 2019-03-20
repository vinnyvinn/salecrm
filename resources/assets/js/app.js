import VModal from 'vue-js-modal';
import * as VueGoogleMaps from 'vue2-google-maps';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.eventBus = new Vue();

Vue.use(VModal);

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyDB5rEKmWBsmryGshIwUP3iNOAlv3ys7AA',
        libraries: 'places',
    }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('modal-trigger', require('./components/ModalTrigger'));
Vue.component('company-selector', require('./components/CompanySelector'));
Vue.component('status-toggler', require('./components/StatusToggler'));
Vue.component('create-prospect-form', require('./components/CreateProspectForm'));
Vue.component('opportunity-editor', require('./components/OpportunityEditor'));
Vue.component('toggle', require('./components/Toggle'));
Vue.component('location-picker', require('./components/LocationPicker'));
Vue.component('status-picker', require('./components/StatusPicker'));
Vue.component('opportunity-filter', require('./components/OpportunityFilter'));

const app = new Vue({
    el: '#app'
});

