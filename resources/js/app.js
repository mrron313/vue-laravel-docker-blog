
require('./bootstrap');

window.Vue = require('vue');
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('blog-component', require('./components/BlogComponent.vue').default);

const app = new Vue({
    el: '#app',
});

            