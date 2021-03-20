<template>
     <div class="card">
        <div class="card-header">
            <h3 class="card-title">Contactos</h3>
             <br>
          	<!--Buscar-->          
            <div class="form-group">
                <div class="row">                       
                <div></div>
                    <input type="text" v-model="telefono1" class="form-control col-lg-6" placeholder="Buscar por numero del cliente" />                                                   
                    <button type="submit" class="btn btn-info" @click="search">Buscar</button>

                </div>
            </div>
     
        </div>
        <div class="card-body table-responsive">
            <ul class="pagination">
                <button class="btn btn-primary" @click="lastPage">
                    <span>Anterior</span>
                </button>
                &nbsp;
                <button class="btn btn-primary" @click="nextPage">
                    <span>Siguiente</span>
                </button>
               
                
            </ul>
            <table class="table table-bordered table-hover table-striped ">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Descripcion</th>
                        <th>Telefono</th>
                        <th>Telefono2</th>
                        <th>Organizacion</th>
                       
                	    <th>Ver</th>     
                    </tr>
                </thead>
              <tbody>
                  	<tr v-for="(item, index) in clientes" :key="index">
                      <td v-text="item.id"></td>
                      <td v-text="item.datos"></td>
    	                <td v-text="item.telefono1"></td>
    	                <td v-text="item.telefono2"></td>
    	                <td v-text="item.organizacion"></td>
                        <td>
                            <button  class="btn btn-outline-secondary btn-sm" 
                                                @click="ejecutar(item, index)" 
                                            > 
                                                <i class="fas fa-cogs" data-toggle="modal" data-target="#exampleModalCenter"></i>
                            </button>
                        </td>
                  	</tr>
              </tbody>         
            </table>
            
          </div> 



          <!-- Modal -->
                <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary" >
                                <h5 class="modal-title" id="exampleModalLongTitle">Contacto</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table  class="table">
                                    <thead>
                                        <th>Datos</th>
                                        <th>Telf 1</th>
                                        <th>Telf 2</th>
                                        <th>Organizacion</th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in contacto" :key="index">
                                            <td> <small>{{ item.datos }}</small> </td>
                                            <td> {{ item.telefono1 }}</td>
                                            <td> {{ item.telefono2 }}</td>
                                            <td> {{ item.organizacion }}</td>
                                            </tr>
                                    </tbody>
                                </table>
                                <div class="card-body" id="validar">
                                    <p v-if="errors.length">
                                        <ul>
                                            <li v-for="(error, index) in errors" :key="index">
                                                {{ error }}
                                            </li>
                                        </ul>
                                    </p>
                                    <form  v-on:submit.prevent="checkForm">

                                        <div class="row">

                                            <div class="col">
                                                <label for="">Telefono WhatsApp *</label>
                                                <div>
                                                    <input type="number" class="form-control" id="jack"  v-model="form.telefonowhatsapp">
                                                </div>
                                            </div>
                                        

                                            <div class="col">
                                                <label for="">Telefono 2 </label>
                                                <div>
                                                    <input type="number" class="form-control"  v-model="form.telefonoCelular">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="">Convencional</label>
                                                <div>
                                                    <input type="number" class="form-control"  v-model="form.telefonoConvencional">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="">Correo  </label>
                                                <div>
                                                    <input type="email" class="form-control"  v-model="form.email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="">Cedula  </label>
                                                <div>
                                                    <input type="text" class="form-control"  v-model="form.cedula">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="">Nombres  *</label>
                                                <div>
                                                    <input type="text" class="form-control"  v-model="form.nombre">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="">Apellidos  *</label>
                                                <div>
                                                    <input type="text" class="form-control"  v-model="form.apellidos">
                                                </div>
                                            </div>
                                        </div>
                                        <br> <br>
                                        <div class="row">
                                            <div class="col">
                                                <label for="">Dirección  *</label>
                                                <div>
                                                    <input type="text" class="form-control"  v-model="form.direccion">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="">Manzana  </label>
                                                <div>
                                                    <input type="text" class="form-control"  v-model="form.mz">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="">Villa  </label>
                                                <div>
                                                    <input type="text" class="form-control"  v-model="form.vl">
                                                </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col">
                                                <label for="">Provincia  </label>
                                                <div>
                                                    <select v-model="form.provincia" class="form-control mb-2" @input="getCanton"  @click="getCanton(form.provincia)">
                                                        <option value="" >Seleccionar la Provincia  </option>
                                                        <option v-for="(item, index) in provincias" :key="index" v-bind:value="item.codigo" >
                                                        {{ item.codigo }} | <strong>{{ item.Provincia }} </strong> 
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="">Canton  </label>
                                                <div>
                                                    <select v-model="form.canton" class="form-control mb-2" @input="getSector"  @click="getSector(form.canton)">
                                                        <option value="" >Seleccione el Canton  </option>
                                                        <option v-for="(item, index) in cantones" :key="index" v-bind:value="item.codigo" >
                                                        {{ item.codigo }} | <strong>{{ item.canton }} </strong> 
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="">Sector  </label>
                                                <div>
                                                    <select v-model="form.sector" class="form-control mb-2" >
                                                        <option value="" >Seleccione el Canton  </option>
                                                        <option v-for="(item, index) in sectores" :key="index" v-bind:value="item.codigo" >
                                                        {{ item.codigo }} | <strong>{{ item.sector }} </strong> 
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="">Referencia  </label>
                                                <div>
                                                    <input type="text" class="form-control"  v-model="form.referencia">
                                                </div>
                                            </div>

                                        </div>

                                    <br>
                                    <div class="row">
                                        <div class="col">
                                            <input  class="btn btn-primary btn-sm" type="submit" value="Actualizar">
                                        </div>
                                    </div>
                                
                                        
                                    </form>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        
                    </div>
                </div>
            </div>
        </div>  

    </div>
</template>


<script>
import axios from "axios";
import Vue from "vue";
import VuePaginate from "vue-paginate";
Vue.use(VuePaginate);
export default {
  name: "lista",

  data() {
    return {
      form: {
        telefonowhatsapp: null,
        telefonoCelular: null,
        telefonoConvencional: null,
        cedula: null,
        nombre: null,
        apellidos: null,
        direccion: null,
        mz: null,
        vl: null,
        sector: null,
        provincia: 9,
        canton: 901,
        referencia: null
      },
      clientes: [],
      contacto: null,
      telefono1: "",
      page: 0,
      url: "http://localhost/gestiones/public/listacontactos",
      errors: [],
      idContacto: null,
      provincias: null,
      cantones: null,
      sectores: null,
    };
  },

  created() {
    axios.get("http://localhost/gestiones/public/getprovincia").then((res) => {
      this.provincias = res.data;
    });
  },
  mounted() {
   // console.log("Componente cliente montado.");
    this.getClientes();
  },
  methods: {
    getClientes() {
      let me = this;
      axios
        .get(`${me.url}?page=1`)
        //axios.get(`${me.url}`)
        .then((res) => {
          me.clientes = res.data.data;
          //me.clientes = res.data
          me.page = res.data.current_page;
         // console.log(me.page);
        })
        .catch((err) => {
          console.error(err.message);
        });
    },

    search() {
      let me = this;
      let url2 = "http://localhost/gestiones/public/contactos";
      axios
        .get(`${url2}?telefono1=${me.telefono1}`)
        .then((res) => {
          me.clientes = res.data.data;
          me.page = res.data.current_page;
         // console.log(me.page);
        })
        .catch((err) => {
          console.error(err.message);
        });
    },

    lastPage() {
      let me = this;
      axios
        .get(`${me.url}?page=` + (me.page - 1))
        .then((res) => {
         // console.log("Pagina:" + me.page);
          me.clientes = res.data.data;
          me.page = res.data.current_page;
         // console.log(me.page);
        })
        .catch((err) => {
          console.error(err.message);
        });
    },
    nextPage() {
      let me = this;
      axios
        .get(`${me.url}?page=` + (me.page + 1))
        .then((res) => {
         // console.log("Pagina:" + me.page);
          me.clientes = res.data.data;
          me.page = res.data.current_page;
         // console.log(me.page);
        })
        .catch((err) => {
          console.error(err.message);
        });
    },

    ejecutar(item) {
      this.idContacto = null;
      this.idContacto = item.id;
      console.log(this.idContacto );
      axios.get("consultarcontacto/" + item.id).then((res) => {
        this.contacto = res.data;
      });
    },

    getCanton(event) {
      axios.get("contactos/getcanton/" + event).then((res) => {
        this.cantones = res.data;
      });
    },

    getprovincia() {
      axios.get("/getprovincia").then((res) => {
        this.provincias = res.data;
      });
    },

    getSector(event) {
     // console.log(event);
      axios.get("contactos/getSector/" + event).then((res) => {
        this.sectores = res.data;
      });
    },

    checkForm: function () {
      this.errors = [];
      if (!this.form.telefonowhatsapp) {
        this.errors.push("El telefono de WhatsApp es obligatorio");
      }

      if (!this.form.nombre) {
        this.errors.push("El Nombre es obligatorio");
      }

      if (!this.form.direccion) {
        this.errors.push("La direccion es obligatoria");
      }

      if (
        this.form.telefonowhatsapp &&
        this.form.nombre &&
        this.form.direccion
      ) {
        this.agregar();
      }
    },

    agregar() {
      const parametros = {
        telefonoWhatsapp:     this.form.telefonowhatsapp,
        telefonoCelular:      this.form.telefonoCelular,
        telefonoConvencional: this.form.telefonoConvencional,
        cedula:               this.form.cedula,
        nombres:              this.form.nombre,
        apellidos:            this.form.apellidos,
        direccion:            this.form.direccion,
        mz:                   this.form.mz,
        villa:                this.form.vl,
        provincia:            this.form.provincia,
        canton:               this.form.canton,
        sector:               this.form.sector,
        referencia:           this.form.referencia,
        idContacto:           this.idContacto,
      };

      this.form.telefonowhatsapp = "";
      this.form.telefono2 = "";
      this.form.cedula = "";
      this.form.nombre = "";
      this.form.apellidos = "";
      this.form.direccion = "";
      this.form.mz = "";
      this.form.vl = "";
      this.form.sector = "";
      this.idContacto = "";
     // console.log(parametros);
      axios.post("guardarcontacto", parametros).then((res) => {
        this.contacto.push(res.data);
        this.$swal("Actualizado con Exito");
        this.getClientes();
      });

    },
  },
};
</script>