import ConocenosMW from '@/components/ConocenosMW.vue'
import HomeMW from '@/components/HomeMW.vue'
import InicioMW from '@/components/InicioMW.vue'
import LoginMW from '@/components/LoginMW.vue'
import RegisterMW from '@/components/RegisterMW.vue'
import CategoriasMW from '@/components/CategoriasMW.vue'
import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/categorias',
    name: 'CategoriasMW',
    component: CategoriasMW
  },
  {
    path: '/conocenos',
    name: 'ConocenosMW',
    component: ConocenosMW
  },
  {
    path: '/inicio',
    name: 'InicioMW',
    component: InicioMW
  },
  {
    path: '/',
    name: 'HomeMW',
    component: HomeMW
  },
  {
    path: '/login',
    name: 'LoginMW',
    component: LoginMW
  },
  {
    path: '/register',
    name: 'RegisterMW ',
    component: RegisterMW
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: function () {
      return import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
    }
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
