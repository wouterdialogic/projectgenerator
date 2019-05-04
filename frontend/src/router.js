import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
import About from './views/About.vue'
import Lalala from './views/Lalala.vue'
import Projects from './views/Projects.vue'
import MultipleViews from './views/MultipleViews.vue'
import Dragging from './views/Dragging.vue'
import BasicApplication from "./views/BasicApplication.vue"
import TipTapView from "./views/TipTapView.vue"

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/multipleViews',
      name: 'MultipleViews',
      component: MultipleViews
    },
    {
      path: '/BasicApplication',
      name: 'BasicApplication',
      component: BasicApplication
    },
    {
      path: '/dragging',
      name: 'Dragging',
      component: Dragging
    },
    {
      path: '/tiptap',
      name: 'TipTapView',
      component: TipTapView
    },
    {
      path: '/projects',
      name: 'projects',
      component: Projects
    },
    {
      path: '/about',
      name: 'about',
      component: About
    },
    {
      path: '/lalala',
      name: 'lalala',
      component: Lalala
    }
  ]
})
