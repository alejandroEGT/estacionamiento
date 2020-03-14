import Outer from './components/outer.vue';
import HomeComponent from './components/Home.vue';
import NotFound from './components/404.vue';
import Cliente_servicio from './components/cliente/cliente.vue';



import Auth from './components/Auth/auth.vue';
import Index from './components/Auth/index.vue';
import Config_tiempo from './components/Auth/config_tiempo.vue';
import Lista_ingreso from './components/Auth/lista_ingreso.vue';
import Lista_egresos from './components/Auth/lista_egreso.vue';
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
        name: 'cliente_servicio',
        path: 'cliente_servicio/:id',
        component: Cliente_servicio
      },
      

      
     
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
        {
          name: 'config_tiempo',
          path: '/config_tiempo',
          component: Config_tiempo
        },
      {
        name: 'lista_ingreso',
        path: '/lista_ingreso',
        component: Lista_ingreso
      },
      {
        name: 'lista_egresos',
        path: '/lista_egresos',
        component: Lista_egresos
      },
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