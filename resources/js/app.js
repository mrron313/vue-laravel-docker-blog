
require('./bootstrap');
import store from './store/index.js'
import BootstrapVue from 'bootstrap-vue'
import VueRouter from 'vue-router'
import router from './routes/index.js'
import PostComponent from './components/PostComponent.vue';
import SidebarComponent from './components/SidebarComponent.vue';

window.Vue = require('vue');

Vue.use(BootstrapVue)
Vue.use(VueRouter)

Vue.component('post-component', PostComponent);
Vue.component('sidebar-component', SidebarComponent);
Vue.component('pagination', require('laravel-vue-pagination'));

var filter = function(text, length, clamp){
  clamp = clamp || '...';
  var node = document.createElement('div');
  node.innerHTML = text;
  var content = node.textContent;
  return content.length > length ? content.slice(0, length) + clamp : content;
};

Vue.filter('truncate', filter);

Vue.filter('capitalize', function (value) {
  if (!value) return ''
  value = value.toString()
  return value.charAt(0).toUpperCase() + value.slice(1)
})

const app = new Vue({
  el: '#app',
  router,
  store
});
