<template lang="html">
  <div>
    <div class="card">
      <div class="card-header text-center">
        <h2 class="float-left">Docentes Registrados</h2>
        <input type="image" class="refresh float-right" id="add" @click="toggle()"
          src="static/icons/agregar-usuario.png" title="Añadir cliente" />
      </div>
      <div class="card-body" id="users">
        <tableTemplate v-bind:serv='url' v-bind:field="fields" :clickDelete="deleteClient" :clickEdit="editClient"
          ref="table" />
      </div>
    </div>
    <div class="row align-items-center" id="form" v-if="showName">
      <div class="col">
        <div class="row justify-content-center">
          <form class="col-4" id="form_add">
            <div class="pb-2">
              <b-input type="text" placeholder="Id Docente" class="form-control" required v-model.trim="form.id"
                :disabled="put" />
              <input type="text" placeholder="Nombre de docente" class="form-control " required
                v-model.trim="form.nombre">
              <input type="text" placeholder="Cargo" class="form-control" v-model.trim="form.cargo">
              <input type="text" placeholder="Tel de Contacto" class="form-control" v-model.trim="form.phone">
              <input type="text" placeholder="Correo de Contacto" class="form-control" v-model.trim="form.correo">

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
  export default {
    data() {
      return {
        url: `${process.env.BASE_URI}docentes.php`,
        showName: false,
        dataTable: null,
        items: [],
        put: false,
        fields: [{
            key: 'id',
            label: 'Identificación',
            sortable: true,
            sortDirection: 'desc'
          },
          {
            key: 'nombre',
            label: 'Nombre',
            sortable: true,
            class: 'text-center'
          },
          {
            key: 'cargo',
            label: 'Cargo',
            sortable: true
          },
          {
            key: 'phone',
            label: 'Contacto',
            sortable: true
          },
          {
            key: 'correo',
            label: 'Correo Electrónico',
            sortable: true
          },
          {
            key: 'actions',
            label: 'Acciones'
          }
        ],
        form: {
          id: '',
          nombre: '',
          phone: '',
          cargo: '',
          correo: ''
        }
      }
    },
    components: {
      tableTemplate
    },
    methods: {
      clearForm() {
        this.form.id = '',
          this.form.nombre = '',
          this.form.phone = '',
          this.form.cargo = '',
          this.form.correo = ''
      },
      toggle() {
        if (this.put) {
          this.put = !this.put
        }
        this.showName = !this.showName
        this.clearForm()
      },
      deleteClient(idDocente) {
        swal({
            title: "¿Desea eliminar al docente?",
            text: "Al hacerlo, toda su información relacionada también será eliminada.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              let formData = new FormData();
              formData.append('mode', 'del')
              formData.append('id', idDocente)
              axios.post(this.url, formData).then((response) => {
                swal('Eliminado', '', 'success')
                this.$refs.table.getData()
              }).catch(err => {
                console.log(err);
                swal('no se pudo eliminar', '', 'error')
              })
            } else {
              swal("El docente NO fue eliminado");
            }
          });
      },
      editClient(idDocente) {
        const serv = this.url + `?id=` + idDocente
        axios.get(serv).then((res) => {
          this.toggle()
          this.put = true
          this.form.id = res.data[0].id
          this.form.nombre = res.data[0].nombre
          this.form.phone = res.data[0].phone
          this.form.cargo = res.data[0].cargo
          this.form.correo = res.data[0].correo
        }).catch((error) => {
          console.log(error)
        })
      },
      onSubmit(mode) {
        if ((this.form.id == '') || (this.form.nombre == '')) {
          swal('¡Falta Información!', '', 'warning')
        } else {
          let formData = new FormData();
          formData.append('mode', mode)
          formData.append('id', this.form.id)
          formData.append('nombre', this.form.nombre)
          formData.append('phone', this.form.phone)
          formData.append('cargo', this.form.cargo)
          formData.append('correo', this.form.correo)
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
    margin-top: 2em;
  }

</style>
