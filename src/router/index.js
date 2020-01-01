import Vue from 'vue'
import Router from 'vue-router'
import hola from '@/components/hola'
import estudiantes from '@/components/estudiantes'
import docentes from '@/components/docentes'
import newpermiso from '@/components/newpermiso'
import permisos from '@/components/permisos'
import newcitacion from '@/components/newcitacion'
import citaciones from '@/components/citaciones'
import newcompromiso from '@/components/newcompromiso'
import compromisos from '@/components/compromisos'

Vue.use(Router)

export default new Router({
  mode:"history",
  routes: [
    {
      path: '/',
      name: 'hola',
      component: hola
    },
    {
      path: '/estudiantes',
      name: 'estudiantes',
      component: estudiantes
    },
    {
      path: '/docentes',
      name: 'docentes',
      component: docentes
    },
    {
      path: '/newpermiso',
      name: 'newpermiso',
      component: newpermiso
    },
    {
      path: '/permisos',
      name: 'permisos',
      component: permisos
    },
    {
      path: '/newcitacion',
      name: 'newcitacion',
      component: newcitacion
    },
    {
      path: '/citaciones',
      name: 'citaciones',
      component: citaciones
    },
    {
      path: '/newcompromiso',
      name: 'newcompromiso',
      component: newcompromiso
    },
    {
      path: '/compromisos',
      name: 'compromisos',
      component: compromisos
    }

  ]
})
