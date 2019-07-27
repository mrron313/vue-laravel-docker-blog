
import VueRouter from 'vue-router'
import Vue from 'vue'
import BlogComponent from '../pages/BlogComponent.vue'
import CategoryComponent from '../pages/CategoryComponent.vue'
import SinglePostComponent from '../pages/SinglePostComponent.vue'
import CreatePostComponent from '../pages/CreatePostComponent.vue'
import SingleUserPostComponent from '../pages/SingleUserPostComponent.vue'
import MyProfileComponent from '../pages/MyProfileComponent.vue'
import PasswordChangeComponent from '../pages/PasswordChangeComponent.vue'

Vue.use(VueRouter)

export default new VueRouter({
  mode: 'history',
  routes:[
    {
      path: '/posts',
      name: 'blog-component',
      component: BlogComponent
    },
    {
      path: '/posts/categories/:id',
      name: 'category-post-component',
      component: CategoryComponent
    },
    {
      path: '/posts/:id',
      name: 'single-component',
      component: SinglePostComponent
    },
    {
      path: '/user-posts/:user_name',
      name: 'single-user-post-component',
      component: SingleUserPostComponent
    },
    {
      path: '/change-password',
      name: 'password-change-component',
      component: PasswordChangeComponent
    },
    {
      path: '/my-profile',
      name: 'my-profile-component',
      component: MyProfileComponent
    },
    {
      path: '/create-posts',
      name: 'create-post-component',
      component: CreatePostComponent
    },
  ]
})