import ConocenosMW from '@/components/ConocenosMW.vue'
import HomeMW from '@/components/HomeMW.vue'
import InicioMW from '@/components/InicioMW.vue'
import LoginMW from '@/components/LoginMW.vue'
import RegisterMW from '@/components/RegisterMW.vue'
import CategoriasMW from '@/components/CategoriasMW.vue'
import { createRouter, createWebHistory } from 'vue-router'
import CategoriaEspecifica from '@/components/CategoriaEspecifica.vue'
import FavoritoMW from '@/components/FavoritoMW.vue'
import UsuarioMW from '@/components/UsuarioMW.vue'
import CarritoMW from '@/components/CarritoMW.vue'
const routes = [
  {
    path: '/carrito',
    name: 'CarritoMW',
    component: CarritoMW
  },
  {
    path: '/usuario',
    name: 'UsuarioMW',
    component: UsuarioMW
  },
  {
    path: '/fav',
    name: 'FavMW',
    component: FavoritoMW
  },
  {
    path: '/categorias/:id',
    name: 'CategoriasMW',
    component: CategoriaEspecifica
  },
  {
    path: '/categorias',
    name: 'CategoriaMW',
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
  mode: 'history',
  routes
})

export default router
