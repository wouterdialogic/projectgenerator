import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
import About from './views/About.vue'
import Lalala from './views/Lalala.vue'
import Projects from './views/Projects.vue'
import MultipleViews from './views/MultipleViews.vue'
import Dragging from './views/Dragging.vue'

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
      path: '/dragging',
      name: 'Dragging',
      component: Dragging
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
