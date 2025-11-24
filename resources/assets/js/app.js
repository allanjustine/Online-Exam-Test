//require('./bootstrap');
require( "smartwizard/dist/css/smart_wizard_all.css");
const smartWizard = require("smartwizard");

window.Vue = require('vue').default;
var VueResource = require('vue-resource');
Vue.use(VueResource); 

import question from './components/Questions.vue';

Vue.http.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
window.App = new Vue({
    el: '#app',
    components: { question}
});
