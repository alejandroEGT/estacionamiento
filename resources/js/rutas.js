import Outer from './components/outer.vue';
import HomeComponent from './components/Home.vue';
import NotFound from './components/404.vue';
import Cliente_servicio from './components/cliente/cliente.vue';

import Auth from './components/Auth/auth.vue';
import Index from './components/Auth/index.vue';
// import { Component } from 'react';

const routes = [
  {
    path: '/',
    component: Outer,
    name: 'Admin',
    redirect: 'home',
    iconCls: 'el-icon-message',
    meta: { auth: false },

    children: [
      {
        name: 'home',
        path: '/',
        component: HomeComponent
      },
      {
        name: 'cliente',
        path:'/cliente_servicio/:id',
        Component: Cliente_servicio
      }
     
    ]
  },

  {
    path: '/home',
    component: Auth,
    name: 'Administration',
    redirect: 'index',
    iconCls: 'el-icon-message',
    meta: { auth: true },
    children: [

        { path: '/index', component: Index, name: 'Index' },
        // { path: '/mi-perfil', component: MiPerfil, name: 'miPerfil' },

    ]
  },

  {
    path: '/404',
    component: NotFound,
    name: '',
    hidden: true
  },
  {
      path: '*',
      hidden: true,
      redirect: { path: '/' }
  } 

];

export default routes;