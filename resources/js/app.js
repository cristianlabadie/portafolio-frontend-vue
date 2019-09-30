require('./bootstrap');
import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import routes from './routes'
import state from './state'
import mutations from './mutations'
import actions from './actions'
import ElementUI from 'element-ui'
import locale from 'element-ui/lib/locale/lang/es'
import Login from "./components/Login"
import App from "./components/App"

// import 'element-ui/lib/theme-chalk/index.css';
// import App from './App.vue';


Vue.config.productionTip = false



Vue.use(VueRouter)
Vue.use(Vuex)
Vue.use(ElementUI, { locale })


// Vue.component('navegacion', require('./components/Navegacion.vue'))
// Vue.component('contenido', require('./components/Contenido.vue'))
// Vue.component('pie', require('./components/Pie.vue'))
Vue.component("Login", Login)
Vue.component("App", App)






const store = new Vuex.Store({
  state,
  mutations,
  actions,
})


const router = new VueRouter({
  mode: 'history',
  routes: routes,
  scrollBehavior(to, from, savedPosition) {
    return { x: 0, y: 0 }
  },
})


const app = new Vue({
  store,
  router,
}).$mount('#app')
