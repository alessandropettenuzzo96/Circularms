
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Buefy from 'buefy';
import 'buefy/lib/buefy.css';
import 'mdi/css/materialdesignicons.min.css';

Vue.use(Buefy, { defaultIconPack: 'fas' });
let DynamicRoutesEditor = require('./components/DynamicRoutesEditor.vue');
let DynamicRoutesSettingsEditor = require('./components/DynamicRoutesSettingsEditor.vue');

/** IF NEEDS JS-ROUTE
 *
 * import VueRouter from 'vue-router';
Vue.use(VueRouter);
let routes = [
    { path: '/', component: require('./components/pages/GlobalSettings.vue') },
    { path: '/routes', component: require('./components/pages/RoutesSettings.vue') },
    { path: '/media', component: require('./components/pages/MediaSettings.vue') },
];

const router = new VueRouter({
    routes
});*/

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('dynamic-routes', require('./components/DynamicRoutes.vue'));
Vue.component('dynamic-routes-editor', DynamicRoutesEditor);
Vue.component('dynamic-routes-settings-editor', DynamicRoutesSettingsEditor);
window.app = new Vue({
    el: '#app',
    //router,
    components: {},
    data: {
        searchQuery: null,
        blade: window.blade
    },
    computed: {
        filtered: function () {
            if(!this.blade || !this.blade.settingsPage || !this.blade.settingsPage.routes) return [];
            if(!this.searchQuery) return this.blade.settingsPage.routes;
            return this.blade.settingsPage.routes.filter(el => {
                return el.route.includes(this.searchQuery);
            })
        }
    },

    methods: {
        addRoutesForm() {
            this.$modal.open({
                parent: this,
                component: DynamicRoutesEditor,
                hasModalCard: true
            });
        }
    }
});


