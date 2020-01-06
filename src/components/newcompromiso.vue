<template>
  <div class="container">
    <div class="card mt-5">
      <div class="card-header">
        <h2>Nuevo Compromiso</h2>
      </div>
      <div class="card-body">
        <form>
          <div class="row">
            <div class="col">
              <label for>Estudiante</label>
              <model-list-select :list="estudiantes" v-model="selected" option-text="name" option-value="id"
                placeholder="Selecione Estudiante"></model-list-select>
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col">
              <b-form-textarea id="textarea" v-model.trim="form.asunto" placeholder="Asunto" rows="3" max-rows="6">
              </b-form-textarea>
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col">
              <b-form-textarea id="textarea" v-model.trim="form.compromiso" placeholder="Compromiso" rows="3" max-rows="6">
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
  import {
    ModelListSelect
  } from "vue-search-select";
  import axios from 'axios'
  export default {
    data() {
      return {
        url: `${process.env.BASE_URI}compromiso.php`,
        fecha: "",
        estudiantes: [],
        selected: {},
        form: {
          asunto: "",
          compromiso: ''
        }
      }
    },
    methods: {
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
        if (this.form.asunto == "" || this.selected.id == undefined || this.form.compromiso == "") {
          swal("¡Falta Información!", "", "warning");
        } else {
          let formData = new FormData();
          formData.append("estudiante", this.selected.id);
          formData.append("asunto", this.form.asunto);
          formData.append("compromiso", this.form.compromiso);
          console.log(formData);
          axios
            .post(this.url, formData)
            .then(response => {
              console.log(response);
              this.form.asunto = '';
              this.form.compromiso = '';
              swal("Acción Exitosa", "", "success");
            })
            .catch(error => {
              console.log(error);
              swal("Ha ocurrido un eror", "", "error");
            });
        }
      }
    },
    mounted(){
        this.getEstudiantes();
    },
    components: {
      ModelListSelect
    }
  }

</script>
