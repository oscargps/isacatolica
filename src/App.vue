<template>
  <div id="app">
    <navb v-if="auth" />
    <div v-else>
      <div class="card" id="login">
        <div class="card-header">
          <img src="http://isacatolica.000webhostapp.com/static/icons/logoisa.png" alt="">
          <h3>Bienvenido</h3>
        </div>
        <div class="card-body">
          <form  v-on:keyup.enter="login()">
          <input type="text" class="form-control" placeholder="Usuario" v-model.trim="form.user">
          <hr>
          <input type="password" class="form-control" placeholder="Contraseña" v-model.trim="form.pw">
          <hr>
          <b-button @click="login()" variant="success" class="btn-block">Ingresar</b-button>
          </form>
        </div>
      </div>
    </div>

    <router-view v-if="auth" />
    <span v-if="auth"> (c) 2019 GPSolutions All Rights Reserved.</span>
  </div>
</template>

<script>
  import navb from '@/components/navb'
  import axios from 'axios'

  export default {
    name: 'App',
    components: {
      navb
    },
    data() {
      return {
        auth: false,

        form: {
          user: '',
          pw: ''
        }
      }
    },
    mounted() {
      localStorage.clear()
      this.verif()
    },
    methods: {
      verif() {
        if (localStorage.getItem('Usuario')) {
          this.auth = true
        }
      },
      login() {
        let url = `${process.env.BASE_URI}login.php`;
        if (this.form.user == "" || this.form.pw == "") {
          swal("¡Falta Información!", "", "warning");
        } else {
          let formData = new FormData();
          formData.append("user", this.form.user);
          formData.append("pw", this.form.pw);
          axios
            .post(url, formData)
            .then(response => {
              let resp = response.data
              let res = resp.split('-')
              console.log(resp);
              console.log(res);
              if (res[1] == 'true') {
                localStorage.setItem('Usuario', res[0])
                localStorage.setItem('idUser', res[2])
                this.verif()
              } else {

                swal("Usuario o Clave incorrecto", "", "error");

              }
            })
            .catch(error => {
              console.log(error);
              swal("Ha ocurrido un eror", "", "error");
            });
        }

      }
    }
  }

</script>

<style>
  #login {
    width: 50%;
    position: relative;
    top: 100px;
    left: 25%;
  }

  #app {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
  }

</style>
