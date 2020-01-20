<template>
  <div class="">
      <div class="card">
          <div class="card-header text-center">
            <h2 class="float-left">Permisos</h2>
            <b-button variant="success" size="" class="float-right" :to="{ name:'newpermiso'}">+ Nuevo</b-button>
          </div>
          <div class="card-body">
            <div>
              <!--Tabla-->
              <tableTemplate v-bind:serv='url' v-bind:field="fields"    ref="table" v-bind:permisos="true"  @print="print($event)" />
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
        permiso:{},
        last : this.$route.params.id,
        url: `${process.env.BASE_URI}newper.php`,
        fields: [
        {
            key: 'id',
            label: 'Id',
            sortable: true,
            sortDirection: 'desc'
          },
          {
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
            key: 'fecha',
            label: 'Para',
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
    components:{
        tableTemplate
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
    methods:{
      print(id) {
        this.last=''
        let serv = this.url + '?id=' + id;
        axios.get(serv).then((response) => {
          this.permiso = response.data[0]
          this.ImprimirOrden();

        }).catch((error) => {
          console.log(error)
        })

      },
      ImprimirOrden() {
        let fecha = this.permiso.fecha.split(' ')
        let creado = this.permiso.creado.split(' ')
        $('<iframe>', {
            name: 'myiframe',
            class: 'printFrame'
          })
          .appendTo('body')
          .contents().find('body')
          .append(`
          <style>
          .sign{border-top:1pt solid black;}
    table, th, td {font-size:12 ;border-collapse: collapse;}
        
    th, td {padding: 5px;text-align: left;}

    .imgCenter {display: block;margin-left: auto;margin-right: auto;width: 82px; height:75px}                  

    .centerText { text-align: center}
    .rightText { text-align: right}
    .boldText {font-weight: bol d;}
    </style>    

<h3 class="centerText">Institución Educativa Isabel La Católica</h3> 
<h4 class="centerText boldText">Solicitud de permiso</h4> 
<hr>
<table style="fontsize">
    <tr><td><strong>Montería,  </strong>${creado[0]}</td></tr>
    <tr><td><strong>El estudiante:  </strong>${this.permiso.estudiante}, <strong>del grado: </strong>${this.permiso.grado}</td></tr>
    <tr><td><strong>Solicita permiso para ausentarse de la institución el día: </strong> ${this.permiso.fecha}</td></tr>
    </table>
    <table>
    <tr><td> <strong>Por motivo de: </strong></td></tr>
    <tr><td>${this.permiso.motivo}</td></tr>
    <tr><td><br></td></tr>
  </table>
    <table>
    <tr><td class="sign" >Firma del Alumno</td><td></td><td class="sign">Firma padre de Familia</td><td></td><td class="sign">V°B° Coordinación</td></tr>
</table>    

<hr>
          
        `);

        window.frames['myiframe'].focus();
        window.frames['myiframe'].print();

        setTimeout(() => {
          $(".printFrame").remove();
        }, 1000);
      }

    }
  }

</script>
