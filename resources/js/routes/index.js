
import VueRouter from 'vue-router'
import Vue from 'vue'
import BlogComponent from '../pages/BlogComponent.vue'
import CategoryComponent from '../pages/CategoryComponent.vue'
import SinglePostComponent from '../pages/SinglePostComponent.vue'

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
    },
    {
      path: '/posts/:id',
      name: 'single-component',
      component: SinglePostComponent
    }
  ]
})