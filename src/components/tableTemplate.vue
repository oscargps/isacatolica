<template>
  <b-container fluid>
    <!-- User Interface controls -->
    <b-row>
      <b-col md="6" class="my-1">
        <b-form-group label-cols-sm="3" label="Filtrar" class="mb-0">
          <b-input-group>
            <b-form-input v-model="filter" placeholder="Buscar.."></b-form-input>
            <b-input-group-append>
              <b-button :disabled="!filter" variant="primary" @click="filter = ''">Limpiar</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col md="6" class="">
        <b-form-group label-cols-sm="3" label="Mostrar" class="mb-1">
          <b-form-select v-model="perPage" :options="pageOptions"></b-form-select>
        </b-form-group>
      </b-col>
    </b-row>
    <hr>

    <!-- Main table element -->
    <b-table show-empty stacked="md" :items="items" :fields="fields" :current-page="currentPage" :per-page="perPage"
      :filter="filter" @filtered="onFiltered">

      <template v-slot:cell(actions)="row">
        <b-dropdown size="sm" id="dropdown-dropleft" dropleft text="+" variant="success" class="m-2" v-if="estudiante">
          <b-dropdown-item :to="{ name:'newpermiso'}">Permiso</b-dropdown-item>
          <b-dropdown-item :to="{ name:'newcitacion'}">Citación</b-dropdown-item>
          <b-dropdown-item :to="{ name:'newcompromiso'}">Compromiso</b-dropdown-item>
        </b-dropdown>
        <b-button size="sm" variant="primary" @click='clickEdit(row.item.id)' v-if="!permisos">Editar </b-button>
        <b-button size="sm" variant="danger" @click='clickDelete(row.item.id)' v-if="!permisos">Eliminar </b-button>
        <b-button size="sm" variant="info" @click="row.toggleDetails" v-if="permisos">
          {{ row.detailsShowing ? 'Cerrar' : 'Ver' }} Detalle</b-button>
        <b-button v-if="permisos" @click="$emit('print', row.item.id)" size="sm" variant="danger"> <font-awesome-icon icon="print" /></b-button>
      </template>

      <template v-slot:row-details="row" v-if="permisos">
        <b-card v-if="!compromisos">
          {{row.item.motivo}}
        </b-card>
        <b-card v-else-if="compromisos">
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-header">Asunto</div>
                <div class="card-body">{{row.item.asunto}}</div>
              </div>
            </div>
            <div class="col">
              <div class="card">
                <div class="card-header">Compromiso</div>
                <div class="card-body">{{row.item.compromiso}}</div>
              </div>
            </div>
          </div>
        </b-card>
      </template>

    </b-table>

    <b-row>
      <b-col md="6" class="my-1">
        <b-pagination v-model="currentPage" :total-rows="totalRows" :per-page="perPage" class="my-0"></b-pagination>
      </b-col>
    </b-row>


  </b-container>
</template>

<script>



  import axios from 'axios';
  export default {
    data() {
      return {
        items: [],
        fields: this.field,
        totalRows: 1,
        currentPage: 1,
        perPage: 10,
        pageOptions: [5, 10, 15],
        filter: null,
      }
    },
    computed: {
      sortOptions() {
        // Create an options list from our fields
        return this.fields
          .filter(f => f.sortable)
          .map(f => {
            return {
              text: f.label,
              value: f.key
            }
          })
      }
    },
    mounted() {

      this.getData()
      this.totalRows = this.items.length
    },
    props: {
      serv: {
        type: String
      },
      field: {
        type: Array
      },
      clickDelete: Function,
      clickEdit: Function,
      from: String,
      user: false,
      estudiante: false,
      permisos: false,
      compromisos: false
    },
    methods: {
      getData() {
        axios.get(this.serv).then((response) => {
          this.items = response.data
        }).catch((error) => {
          console.log(error)
        })
      },
      onFiltered(filteredItems) {

        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length
        this.currentPage = 1
      }
    }
  }

</script>
<style lang="css">

</style>
