<template>
  <div class>
    <div class="card">
      <div class="card-header text-center">
        <h2 class="float-left">Compromisos</h2>
        <b-button variant="success" size class="float-right" :to="{ name:'newcompromiso'}">+ Nuevo</b-button>
      </div>
      <div class="card-body">
        <div>
          <!--Tabla-->
          <tableTemplate
            v-bind:serv="url"
            v-bind:field="fields"
            ref="table"
            v-bind:compromisos="true"
            @print="print($event)"
            v-bind:permisos="true"
          />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import JQuery from "jquery";
let $ = JQuery;
import axios from "axios";
import tableTemplate from "@/components/tableTemplate";
export default {
  data() {
    return {
      compromiso: {},
      last: this.$route.params.id,
      url: `${process.env.BASE_URI}compromiso.php`,
      fields: [
        {
          key: "id",
          label: "Id",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "creado",
          label: "Creación",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "estudiante",
          label: "Estudiante",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "actions",
          label: "Acciones",
          sortable: true,
          sortDirection: "desc"
        }
      ]
    };
  },
  components: {
    tableTemplate
  },
  props: {
    id: Number
  },
  mounted() {
    var meses = new Array(
      "Enero",
      "Febrero",
      "Marzo",
      "Abril",
      "Mayo",
      "Junio",
      "Julio",
      "Agosto",
      "Septiembre",
      "Octubre",
      "Noviembre",
      "Diciembre"
    );
    var f = new Date();
    this.hoy =
      f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
    if (this.last) {
      this.print(this.last);
    }
  },
  methods: {
    print(id) {
      this.last = "";
      let serv = this.url + "?id=" + id;
      console.log(this.last);
      
      console.log(id);
      
      
      axios
        .get(serv)
        .then(response => {
          this.compromiso = response.data[0];
          console.log(response.data);
          
          
          this.ImprimirOrden();
        })
        .catch(error => {
          console.log(error);
        });
    },
    ImprimirOrden() {
      let fecha = this.compromiso.creado.split(" ");
      console.log(this.compromiso);
      
      $("<iframe>", {
        name: "myiframe",
        class: "printFrame"
      })
        .appendTo("body")
        .contents()
        .find("body").append(`
<style>
    table,
    th,
    td {
        font-size: 16;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 5px;
        text-align: left;
    }

    .ta{
        border: 1px solid;
    }

    .imgCenter {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 82px;
        height: 75px
    }

    .centerText {
        text-align: center
    }

    .rightText {
        text-align: right
    }

    .boldText {
        font-weight: bol d;
    }
</style>

    <img class="imgCenter" src='static/icons/logoisa.png' />
    <h2 class="centerText">Institución Educativa Isabel La Católica</h2>
    <p>
        <center>
            <span>Reconocimiento de carácter Oficial Res. No. 1669 del 18 de abril del 2006</span><BR>
            <span>NIT-900004711-1</span><BR>
            <span>Dane No. 123001001820</span><BR>
            <span>Montería - Córdoba</span>
        </center>
    </p>
    <hr>
    <div>
        <strong>FECHA: </strong><u>${fecha[0]}</u>
    </div>
    <br>
    <div>
        <strong>ESTUDIANTE: </strong><u>${this.compromiso.estudiante}</u>
    </div>

    <table style="width: 100%;">
        <tr>
            <td> <strong>ASUNTO:</strong></td>
        </tr>
        <tr class="ta">
            <TD><textarea name="" id="" style="width:100%;border:none;" rows="10">${this.compromiso.asunto}</textarea>
            </TD>
        </tr>
        <tr>
            <td> <strong>COMPROMISOS: </strong></td>
        </tr>
        <tr class="ta">
            <TD><textarea name="" id="" style="width:100%;border:none;"
                    rows="10">${this.compromiso.compromiso}</textarea>
            </TD>
        </tr c>
        <tr>
            <td><br></td>
        </tr>
        <br>
    </table>
    <hr>
    <br>
    <div>
        <strong>FIRMA DEL ALUMNO: </strong>___________________________________
    </div>
    <br>
    <div>
        <strong>FIRMA DEL PADRE DE FAMILIA: </strong>___________________________________
    </div>
    <br>
    <div>
        <strong>FIRMA DEL DIRECTIVO DOCENTE: </strong>___________________________________
    </div>
    <br>
    <div>
        <strong>Docente: </strong>___________________________________
    </div>
          
        `);

      window.frames["myiframe"].focus();
      window.frames["myiframe"].print();

      setTimeout(() => {
        $(".printFrame").remove();
      }, 1000);
    }
  }
};
</script>
