
require('./bootstrap');
import BootstrapVue from 'bootstrap-vue'

window.Vue = require('vue');
Vue.component('sidebar-component', require('./components/SidebarComponent.vue').default);
Vue.component('blog-component', require('./components/BlogComponent.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

Vue.use(BootstrapVue)

const app = new Vue({
    el: '#app',
});

            