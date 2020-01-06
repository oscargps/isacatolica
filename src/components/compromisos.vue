<template>
  <div class="">
    <div class="card ">
      <div class="card-header text-center">
        <h2 class="float-left">Compromisos</h2>
        <b-button variant="success" size="" class="float-right" :to="{ name:'newcompromiso'}">+ Nuevo</b-button>
      </div>
      <div class="card-body">
        <div>
          <!--Tabla-->
          <tableTemplate v-bind:serv='url' v-bind:field="fields" ref="table" v-bind:compromisos="true"
            v-bind:permisos="true" />
        </div>
      </div>
    </div>

  </div>
</template>
<script>
  import tableTemplate from '@/components/tableTemplate'
  export default {
    data() {
      return {
        url: `${process.env.BASE_URI}compromiso.php`,
        fields: [{
            key: 'creado',
            label: 'Creación',
            sortable: true,
            sortDirection: 'desc'
          },
          {
            key: 'estudiante',
            label: 'Estudiante',
            sortable: true,
            sortDirection: 'desc'
          },
          {
            key: 'actions',
            label: 'Acciones',
            sortable: true,
            sortDirection: 'desc'
          },
        ]
      }
    },
    components: {
      tableTemplate
    }
  }

</script>
