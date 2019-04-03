import Vue from 'vue'
import App from './App.vue'
import router from './router'
//import Vuex from 'vuex'
import '@/assets/css/tailwind.css'
import 'es6-promise/auto'
import store from './store'
import InstantSearch from 'vue-instantsearch';

Vue.use(InstantSearch);

Vue.config.productionTip = false

// Vue.use(Vuex)

Vue.filter('capitalize', function (value) {
  if (!value) return ''
  value = value.toString()
  return value.charAt(0).toUpperCase() + value.slice(1)
})

// const store = new Vuex.Store({
//   state: {
//     count: 0
//   },
//   mutations: {
//     increment (state) {
//       state.count++
//     }
//   }
// })

new Vue({
  store,
  router,
  render: h => h(App)
}).$mount('#app')
