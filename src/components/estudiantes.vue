<template lang="html">
  <div>
    <div class="card">
      <div class="card-header text-center">
        <h2 class="float-left">Estudiantes Registrados</h2>
        <input type="image" class="refresh float-right" id="add" @click="toggle()"
          src="static/icons/agregar-usuario.png" title="Añadir cliente" />
      </div>
      <div class="card-body" id="users">
        <tableTemplate v-bind:serv='url' v-bind:field="fields" :clickDelete="deleteClient" :clickEdit="editClient"
          ref="table" v-bind:estudiante="true" />
      </div>
    </div>
    <div class="row align-items-center" id="form" v-if="showName">
      <div class="col">
        <div class="row justify-content-center">
          <form class="col-4" id="form_add">
            <div class="pb-2">
              <b-input type="text" placeholder="Id Estudiante" class="form-control" required v-model.trim="form.id"
                :disabled="put" />
              <b-input type="text" placeholder="Grado" class="form-control" required v-model.trim="form.nivel" />

              <input type="text" placeholder="Nombre de Estudiante" class="form-control " required
                v-model.trim="form.name">
              <input type="text" placeholder="Acudiente" class="form-control" v-model.trim="form.acu">
              <input type="text" placeholder="Tel de Contacto" class="form-control" v-model.trim="form.phone">
              <model-list-select :list="docentes" v-model="selected" option-text="nombre" option-value="id" placeholder="Director..."></model-list-select>
            </div>
          </form>
        </div>
        <div class="row ">
          <div class="col align-self-center">
            <button class="btn btn-primary btn-lg" v-if="put" @click='onSubmit("put")'>Actualizar</button>
            <button class="btn btn-success btn-lg" v-else @click='onSubmit("add")'>Añadir</button>
            <button type="button" class="btn btn-secondary btn-lg" @click="toggle()">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import axios from 'axios';
  import swal from 'sweetalert'
  import tableTemplate from '@/components/tableTemplate'
  import {
     ModelListSelect
   } from "vue-search-select";
  export default {
    data() {
      return {
        url: `${process.env.BASE_URI}estudiantes.php`,
        showName: false,
        dataTable: null,
        items: [],
        docentes:[],
        selected:{},
        put: false,
        fields: [{
            key: 'id',
            label: 'Identificación',
            sortable: true,
            sortDirection: 'desc'
          },
          {
            key: 'name',
            label: 'Estudiante',
            sortable: true,
            class: 'text-center'
          },
          {
            key: 'nivel',
            label: 'Grado',
            sortable: true,
            class: 'text-center'
          },
          {
            key: 'acu',
            label: 'Acudiente',
            sortable: true
          },
          {
            key: 'tel',
            label: 'Contacto',
            sortable: true
          },
          {
            key: 'actions',
            label: 'Acciones'
          }
        ],
        form: {
          id: '',
          name: '',
          phone: '',
          acu: '',
          nivel: ''
        }
      }
    },
    components: {
      tableTemplate,
      ModelListSelect
    },

    methods: {
      clearForm() {
        this.form.id = '',
          this.form.name = '',
          this.form.phone = '',
          this.form.acu = ''
        this.form.nivel = ''
      },
      toggle() {
        if (this.put) {
          this.put = !this.put
        }
        this.showName = !this.showName
        this.clearForm()
      },
      getdocentes(){
      const url = `${process.env.BASE_URI}docentes.php`;
         axios
           .get(url)
           .then(response => {
             this.docentes = response.data;
           })
           .catch(error => {
             console.log(error);
           });
      },
      deleteClient(idEstudiante) {
        swal({
            title: "¿Desea eliminar al estudiante?",
            text: "Al hacerlo, toda su información relacionada también será eliminada.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              let formData = new FormData();
              formData.append('mode', 'del')
              formData.append('id', idEstudiante)
              axios.post(this.url, formData).then((response) => {
                swal('Eliminado', '', 'success')
                this.$refs.table.getData()
              }).catch(err => {
                console.log(err);
                swal('no se pudo eliminar', '', 'error')
              })
            } else {
              swal("El estudiante NO fue eliminado");
            }
          });
      },
      editClient(idEstudiante) {
        const serv = this.url + `?id=` + idEstudiante
        axios.get(serv).then((res) => {
          this.toggle()
          this.put = true
          this.form.id = res.data[0].id
          this.form.name = res.data[0].name
          this.form.phone = res.data[0].tel
          this.form.acu = res.data[0].acu
          this.form.nivel = res.data[0].nivel
        }).catch((error) => {
          console.log(error)
        })
      },
      onSubmit(mode) {
        if ((this.form.id == '') || (this.form.name == '') || (this.selected.id == undefined)) {
          swal('¡Falta Información!', '', 'warning')
        } else {
          let formData = new FormData();
          formData.append('mode', mode)
          formData.append('id', this.form.id)
          formData.append('name', this.form.name)
          formData.append('nivel', this.form.nivel)
          formData.append('phone', this.form.phone)
          formData.append('acu', this.form.acu)
          formData.append('dir', this.selected.id)
          console.log(formData);
          axios.post(this.url, formData).then((response) => {
              console.log(response)
              this.$refs.table.getData()
              this.clearForm()
              this.toggle()
              swal('Acción Exitosa', '', 'success')
            })
            .catch((error) => {
              console.log(error)
              swal('Ha ocurrido un eror', '', 'error')
            })
        }
      }
    },
      mounted(){        
      this.getdocentes()
    }
  }

</script>

<style lang="css" scoped>
  #form {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    z-index: 2;
  }

  input[type=text] {
    margin: 2em auto;
  }

</style>
