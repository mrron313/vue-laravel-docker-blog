
import VueRouter from 'vue-router'
import Vue from 'vue'
import BlogComponent from '../pages/BlogComponent.vue'
import CategoryComponent from '../pages/CategoryComponent.vue'
import SinglePostComponent from '../pages/SinglePostComponent.vue'
import CreatePostComponent from '../pages/CreatePostComponent.vue'
import MyPostComponent from '../pages/MyPostComponent.vue'
import MyProfileComponent from '../pages/MyProfileComponent.vue'
import PasswordChangeComponent from '../pages/PasswordChangeComponent.vue'

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
      name: 'category-post-component',
      component: CategoryComponent
    },
    {
      path: '/posts/:id',
      name: 'single-component',
      component: SinglePostComponent
    },
    {
      path: '/create-post',
      name: 'create-post-component',
      component: CreatePostComponent
    },
    {
      path: '/my-posts',
      name: 'my-post-component',
      component: MyPostComponent
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
    }
  ]
})