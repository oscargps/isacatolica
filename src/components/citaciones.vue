<template>
  <div>
    <div class="card">
      <div class="card-header text-center">
        <h2 class="float-left">Citaciones</h2>
        <b-button variant="success" size="" class="float-right" :to="{ name:'newcitacion'}">+ Nuevo</b-button>
      </div>
      <div class="card-body">
        <div>
          <!--Tabla-->
          <tableTemplate v-bind:serv='url' v-bind:field="fields" ref="table" v-bind:permisos="true"
            @print="print($event)" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import JQuery from 'jquery'
  let $ = JQuery
  import axios from 'axios'
  import tableTemplate from '@/components/tableTemplate'
  export default {
    data() {
      return {
        url: `${process.env.BASE_URI}citaciones.php`,
        hoy: '',
        last : this.$route.params.id,
        citacion: {},
        fields: [{
            key: 'id',
            label: 'Id',
            sortable: true,
            sortDirection: 'desc'
          }, {
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
            key: 'grado',
            label: 'Grado',
            sortable: true,
            sortDirection: 'desc'
          },
          {
            key: 'acudiente',
            label: 'Acudiente',
            sortable: true,
            sortDirection: 'desc'
          },
          {
            key: 'fecha',
            label: 'Fecha',
            sortable: true,
            sortDirection: 'desc'
          },
          {
            key: 'hora',
            label: 'Hora',
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
    props:{
      id:Number
    },
    mounted() {
      var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre",
        "Octubre", "Noviembre", "Diciembre");
      var f = new Date();
      this.hoy =f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
      if(this.last){
        this.print(this.last)
      }
    },
    components: {
      tableTemplate
    },
    methods: {
      print(id) {
        console.log(id);
        let serv = this.url + '?id=' + id;
        axios.get(serv).then((response) => {
          this.citacion = response.data[0]
          this.ImprimirOrden();

        }).catch((error) => {
          console.log(error)
        })

      },
      ImprimirOrden() {
        let fecha = this.citacion.fecha.split(' ')
        let creado = this.citacion.creado.split(' ')
        $('<iframe>', {
            name: 'myiframe',
            class: 'printFrame'
          })
          .appendTo('body')
          .contents().find('body')
          .append(`
          <style>
        table, th, td {font-size:12 ;border-collapse: collapse;}
            
        th, td {padding: 5px;text-align: left;}
        .sign{border-top:1pt solid black;}
        .imgCenter {display: block;margin-left: auto;margin-right: auto;width: 40%;}                  
    
        .centerText { text-align: center}
        .rightText { text-align: right}
        .boldText {font-weight: bol d;}
        </style>    
    
    <img class="imgCenter" src='static/icons/logoisa.png'/> 
    <h3 class="centerText">Institución Educativa Isabel La Católica</h3> 
    <h4 class="centerText boldText">Citación</h4> 
 
    <table style="fontsize">
        <tr><td><strong>Montería,  </strong>${creado[0]}</td></tr>
        <tr><td><strong>Señor(a):  </strong>${this.citacion.acudiente}</td></tr>
        <tr><td><strong>La institución requiere su presencia el día: </strong>${this.citacion.fecha}</td><td><strong>Hora: </strong></td><td>${this.citacion.hora}</td></tr>
        <tr><td> <strong>Para tratar conjuntamente aspectos sobre disciplina de su hijo(a):  </strong>${this.citacion.estudiante}</td></tr>
        <tr><td><strong>quien cursa el grado:  </strong>${this.citacion.grado}</td></tr>
        <hr>
        <tr><td><strong>Gracias por su atención.</strong></td></tr>
        <tr><td><br></td></tr>
        <tr><td><br></td></tr>
      </table>
    <table>
        <tr><td class="sign">Atte. Coordinación</td><td></td><td  class="sign">Padre de Familia</td></tr>
    </table>    

    <hr>
          
        `);

        // window.frames['myiframe'].focus();
        window.frames['myiframe'].print();

        setTimeout(() => {
          $(".printFrame").remove();
        }, 1000);
      }

    }
  }

</script>
