<template>
  <div class="container">
    <div class="card mt-5">
      <div class="card-header">
        <h2>Nuevo Permiso</h2>
      </div>
      <div class="card-body">
        <form>
          <div class="row">
            <div class="col">
              <label for>Fecha</label>
              <br />
              <b-form-input type="date" v-model.trim="form.fechato"></b-form-input>
            </div>
            <div class="col">
              <label for>Estudiante</label>
              <model-list-select :list="estudiantes" v-model="selected" option-text="name" option-value="id"
                placeholder="Selecione Estudiante"></model-list-select>
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col">
              <b-form-textarea id="textarea" v-model.trim="form.motivo" placeholder="Motivo" rows="3" max-rows="6">
              </b-form-textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col">
            <b-button pill block variant="success" size="lg" @click="generar()">Generar</b-button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import axios from "axios";
  import {
    ModelListSelect
  } from "vue-search-select";
  export default {
    data() {
      return {
        url: `${process.env.BASE_URI}newper.php`,
        fecha: "",
        last:'',
        estudiantes: [],
        selected: {},
        form: {
          fechato: "",
          motivo: ""
        }
      };
    },
    mounted() {
      this.getEstudiantes();
      this.getlast()
      var f = new Date();
      this.fecha = f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear();
    },
    methods: {
      getlast() {
        const url = `${process.env.BASE_URI}last.php?tab=` + 'permiso';
        axios
          .get(url)
          .then(response => {
            this.last = response.data

          })
          .catch(error => {
            console.log(error);
          });
      },
      pregunta() {
        swal({
            title: "Creación exitosa",
            text: "Si desea imprimir el documento ahora, pulse 'Ok'",
            icon: "success",
            buttons: true,
            dangerMode: false,
          })
          .then((willDelete) => {
            if (willDelete) {
              this.$router.push({
                name: 'permisos',
                params: {
                  id: this.last + 1
                }
              })
            } else {
              swal("Revise sus permisos en la pestaña 'Permisos'");
            }
          });
      },
      getEstudiantes() {
        const url = `${process.env.BASE_URI}estudiantes.php`;
        axios
          .get(url)
          .then(response => {
            this.estudiantes = response.data;
            console.log(response.data);
          })
          .catch(error => {
            console.log(error);
          });
      },
      generar() {
        if (this.form.motivo == "" || this.selected.id == undefined) {
          swal("¡Falta Información!", "", "warning");
        } else {
          let formData = new FormData();
          formData.append("estudiante", this.selected.id);
          formData.append("fecha", this.form.fechato);
          formData.append("nivel", this.selected.nivel);
          formData.append("motivo", this.form.motivo);
          console.log(formData);
          axios
            .post(this.url, formData)
            .then(response => {
              console.log(response);
              this.form.motivo = '';
              this.pregunta();
            })
            .catch(error => {
              console.log(error);
              swal("Ha ocurrido un eror", "", "error");
            });
        }
      }
    },
    components: {
      ModelListSelect
    }
  };

</script>
<style scoped>
</style>
