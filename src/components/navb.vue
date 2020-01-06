<template lang="html">
  <nav class="navbar navbar-expand-lg " id="nab">
    <img src="static/icons/logoisa.png" alt="" class="p-2">
   <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor01"
      aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <b-button variant="link" class="mx-1" :to="{ name:'hola'}">Inicio</b-button>
    <div class="navbar-collapse collapse" id="navbarColor01" >
      <b-dropdown text="Nuevo" variant="link" class="">
        <b-dropdown-item>
          <router-link to="/newpermiso" class="dropdown-item">Permiso</router-link>
        </b-dropdown-item>
        <b-dropdown-item>
          <router-link to="/newcompromiso" class="dropdown-item">Compromiso</router-link>
        </b-dropdown-item>
        <b-dropdown-item>
          <router-link to="/newcitacion" class="dropdown-item">Citación</router-link>
        </b-dropdown-item>
      </b-dropdown>

      <ul class="navbar-nav ">
        <li class="nav-item active ">
          <router-link to="/docentes" class="nav-link">
            Docentes
          </router-link>
        </li>
        <li class="nav-item active">
          <router-link to="/estudiantes" class="nav-link">
            Estudiantes
          </router-link>
        </li>
        <li class="nav-item active">
          <router-link to="/compromisos" class="nav-link">
            Compromisos
          </router-link>
        </li>
        <li class="nav-item active">
          <router-link to="/permisos" class="nav-link">
            Permisos
          </router-link>
        </li>
        <li class="nav-item active">
          <router-link to="/citaciones" class="nav-link">
            Citaciones
          </router-link>
        </li>
      </ul>
      <b-dropdown :text="user" variant="link" class="">
        <b-dropdown-item>
          <router-link to="/options" class="dropdown-item">Opciones</router-link>
        </b-dropdown-item>
          <b-dropdown-item>
              <b-button @click="logout()" variant="link">Cerrar sesión</b-button>
            </b-dropdown-item>
      </b-dropdown>
    </div>
  </nav>
</template>

<script>
  export default {
    data(){
      return{
        user:''
      }
    },
    mounted(){
      this.user = localStorage.getItem('Usuario')
    },
    methods:{
      logout(){
        localStorage.clear()
        location.href='/'
      }
    }
  }

</script>

<style lang="css" scoped>
  #nab{
    background: rgb(255,255,255);
background: linear-gradient(90deg, rgba(255,255,255,1) 56%, rgba(0,0,255,1) 100%);
  }
  .nav-link{
    color: black;
  }
</style>
