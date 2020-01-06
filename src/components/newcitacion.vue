 <template>
   <div class="container">
     <div class="card mt-5">
       <div class="card-header">
         <h2>Nueva Citación</h2>
       </div>
       <div class="card-body">
         <form>
           <div class="row">
             <div class="col">
               <label for>Estudiante</label>
               <model-list-select :list="estudiantes" v-model="selected" option-text="name" option-value="id"
                 placeholder="Seleccione Estudiante"></model-list-select>
             </div>
             <div class="col">
               <label for>Acudiente</label>
               <b-form-input type="text" placeholder="Acudiente" v-model="selected.acu"> </b-form-input>
             </div>
           </div>
           <hr>
           <div class="row">
             <div class="col">
               <label for>Fecha y hora de citación</label>
               <br />
               <VueCtkDateTimePicker formatted="LLLL" output-format="YYYY-MM-DD HH:mm:ss" label="Seleccione.."
                 v-model="form.fechato" />
             </div>
           </div>
           <hr>
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
   import {
     ModelListSelect
   } from "vue-search-select";
   import axios from 'axios'
   import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
   import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';

   export default {
     data() {
       return {
         url: `${process.env.BASE_URI}citaciones.php`,
         estudiantes: [],
         selected: {},
         last: '',
         date: '',
         form: {
           fechato: '',
           motivo: ''

         }
       }
     },
     methods: {
       getlast() {
         const url = `${process.env.BASE_URI}last.php?tab=` + 'citacion';
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
                 name: 'citaciones',
                 params: {
                   id: this.last + 1
                 }
               })
             } else {
               swal("Revise sus citaciones en la pestaña 'Citaciones'");
             }
           });
       },
       getEstudiantes() {
         const url = `${process.env.BASE_URI}estudiantes.php`;
         axios
           .get(url)
           .then(response => {
             this.estudiantes = response.data;
           })
           .catch(error => {
             console.log(error);
           });
       },
       generar() {
         if (this.form.fechato == "" || this.selected.id == undefined) {
           swal("¡Falta Información!", "", "warning");
         } else {
           let formData = new FormData();
           formData.append("estudiante", this.selected.id);
           formData.append("fecha", this.form.fechato);
           formData.append("nivel", this.selected.nivel);
           formData.append("acudiente", this.selected.acu);
           formData.append("motivo", this.form.motivo);
           axios
             .post(this.url, formData)
             .then(response => {
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
     mounted() {
       this.getEstudiantes();
       this.getlast();
     },
     components: {
       ModelListSelect,
       VueCtkDateTimePicker
     }

   }

 </script>
