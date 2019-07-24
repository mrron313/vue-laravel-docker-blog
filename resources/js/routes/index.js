
import VueRouter from 'vue-router'
import Vue from 'vue'
import BlogComponent from '../components/BlogComponent.vue'
import CategoryComponent from '../components/CategoryComponent.vue'

Vue.use(VueRouter)

export default new VueRouter({
  routes:[
    {
      path: '/',
      name: 'blog-component',
      component: BlogComponent
    },
    {
      path: '/categories/:id',
      name: 'category-component',
      component: CategoryComponent
    }
  ]
})