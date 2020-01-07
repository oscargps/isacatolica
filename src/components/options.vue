<template>
  <div>
    <div class="card mt-3">
      <div class="card-header">
        <h3>Cargar Estudiantes</h3>
      </div>
      <div class="card-body">
        <b-form>
          <div class="row">
            <div class="col-sm-1">
              <b-button
                href="static/formatos/cuenta.xlsx"
                download="estudiantes.xlsx"
                class="btn btn-success"
              >
                <font-awesome-icon icon="file-csv" />
              </b-button>
            </div>
            <div class="col">
              <b-form-file
                v-model="file"
                :state="Boolean(file)"
                placeholder="Arrastre el archivo aquí"
                drop-placeholder="Drop file here..."
              ></b-form-file>
            </div>
          </div>
        </b-form>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-header">
        <h3>Crear Usuario</h3>
      </div>
      <div class="card-body">
        <form class="form_new_user">
          <div class="form-inline">
            <input
              type="text"
              v-model.trim="user.id"
              class="form-control"
              placeholder="Identificación"
              required
            />
            <input
              type="text"
              v-model.trim="user.name"
              placeholder="Nombre y Apellido"
              class="form-control"
              required
            />
            <input type="text" v-model.trim="user.area" placeholder="Área" class="form-control" />
            <input
              type="email"
              v-model.trim="user.mail"
              placeholder="Correo electrónico"
              class="form-control"
            />
            <input type="text" v-model.trim="user.tel" placeholder="Teléfono" class="form-control" />
            <b-button variant="success" class="ml-5" @click="newUser()">Enviar</b-button>
          </div>
        </form>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-header">
        <h3>Cambiar contraseña</h3>
      </div>
      <div class="card-body">
        <form class="form_new_user form-inline">
          <input
            type="password"
            class="form-control"
            v-model.trim="actualpw"
            placeholder="Contraseña Actual"
          />
          <input
            type="password"
            class="form-control"
            v-model.trim="newpw"
            placeholder="Nueva Contraseña"
          />
          <b-button class="ml-2" @click="changePW()" variant="warning">Cambiar contraseña</b-button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import swal from "sweetalert";
export default {
  data() {
    return {
      file: null,
      newpw: "",
      actualpw: "",
      user: {
        id: "",
        name: "",
        area: "",
        mail: "",
        tel: ""
      }
    };
  },
  methods: {
      logout(){
        localStorage.clear()
        location.href='/'
      },
    newUser() {
      let url = `${process.env.BASE_URI}newUSer.php`;
      if (!this.user.name || !this.user.id) {
        swal("¡Falta Información!", "", "warning");
      } else {
        let formData = new FormData();
        formData.append("id", this.user.id);
        formData.append("name", this.user.name);
        formData.append("area", this.user.area);
        formData.append("mail", this.user.mail);
        formData.append("tel", this.user.tel);
        axios
          .post(url, formData)
          .then(response => {
            if (response.data == "ok") {
              swal("¡Usuario creado exitosamente!", "", "success");
            } else {
              swal("Ha ocurrido un eror", "", "error");
            }
          })
          .catch(error => {
              console.log(error);
            swal("Ha ocurrido un eror", "", "error");
          });
      }
    },
    changePW() {
        let url = `${process.env.BASE_URI}changepw.php`;
      if (!this.newpw || !this.actualpw) {
          swal("Falta información!!", "", "warning");
      } else {
          let formData = new FormData();
        formData.append("actual", this.actualpw);
        formData.append("new", this.newpw);
        formData.append("user", localStorage.getItem('idUser'));
        axios
          .post(url, formData)
          .then(response => {
              console.log(response);
              
            if (response.data == "ok") {
                swal("¡Acción Satisfactoria!", "Por favor, inicie sesión nuevamente", "success");
                setTimeout(()=>this.logout(),1000);
            } else {
                swal("Ha ocurrido un eror", "Verifique la información", "error");
            }
          })
          .catch(error => {
            console.log(error);
            swal("Ha ocurrido un eror", "Si el error persiste, contacte a soporte", "error");
          });
      }
    }
  }
};
</script>

<style lang="css">
input {
  margin-left: 5px;
}
.form_new_user {
  margin: 0 auto;
}
</style>