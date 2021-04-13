<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-lg-6 mb-4">
          <div class="alert alert-primary" role="alert">
            <center>Listado clientes  <span class="badge badge-light">{{ clientes.length}}</span></center> 
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 mb-2">
          <b-button v-b-modal.modal1 @click.prevent="modal1=true" variant="primary" @click="getRegistrar()"> <i class="fas fa-user-plus"></i> Registrar</b-button>
        </div>
        <div class="col-lg-4 mb-2">
          <input type="text" v-model="buscardato" class="form-control" placeholder="Buscar por cedula del cliente" /> 
        </div> 
          <div class="col-lg-4 mb-2">
            <button type="submit" class="btn btn-secondary" @click="search"> <i class="fas fa-search"></i> Buscar</button>
          </div>  
      </div>
      <hr>
      <div class="row">
        <div class="col-lg-12 mb-6 ">
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped table-responsive">
              <thead>
                  <tr>
                      <th>Id</th>
                      <th>cedula</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Telefono Whatsapp</th>
                      <th>Direcciòn</th>
                      <th>Mz</th>
                      <th>Villa</th>
                      <th>Referencia</th>
                      <th>Puntos</th>
                    <th colspan="3"></th>     
                  </tr>
              </thead>
              <tbody>
                    <tr v-for="(item, index) in clientes" :key="index">
                    <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" @click="view(item)" > <td v-text="item.id"></td></a>
                      <td v-text="item.cedula"></td>
                      <td v-text="item.nombres"></td>
                      <td v-text="item.apellidos"></td>
                      <td v-text="item.telefonoWhatsapp"></td>
                      <td v-text="item.direccion"></td>
                      <td v-text="item.mz"></td>
                      <td v-text="item.villa"></td>
                      <td v-text="item.referencia"></td>
                      <td v-text="item.puntos"></td>
                      <td><button type="submit" v-b-modal.modal1 @click.prevent="modal1=true"  class="btn btn-warning" @click="edit(item)" > <i class="fas fa-user-edit"></i></button></td>

                      <td><button type="submit" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg" @click="view(item)" > <i class="fas fa-eye"></i></button></td>

                      <td><button type="submit" class="btn btn-danger" @click="deleete(item.id)" > <i class="fas fa-trash-alt"></i></button></td>

                    </tr>
              </tbody>         
            </table>
          </div>
           <ul class="pagination">
                <button class="btn btn-primary" @click="lastPage">
                    <span>Anterior</span>
                </button>
                &nbsp;
                <button class="btn btn-primary" @click="nextPage">
                    <span>Siguiente</span>
                </button>
            </ul>
        </div>
      </div>
    </div>
    <!-- MODAL ---->
    <b-modal id="modal1" hide-footer :v-bind="modal1" v-if="modal1" size="xl" ><div class="alert alert-dark" role="alert"> <center>{{Registrar}} Cliente</center> </div>
      <div class="row">
        <loading :active.sync="isLoading" />
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
                    <div class="col-lg-6 mb-4">
                        <label for="">Cedula  </label>
                        <div>
                            <input type="text" class="form-control"   maxlength ="10"  v-model="form.cedula">
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <label for="">Nombres  *</label>
                        <div>
                            <input type="text" class="form-control"  v-model="form.nombre">
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <label for="">Apellidos  *</label>
                        <div>
                            <input type="text" class="form-control"  v-model="form.apellidos">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">

                    <div class="col-lg-6 mb-4">
                        <label for="">Telefono WhatsApp *</label>
                        <div>
                            <input type="text" class="form-control" id="jack" maxlength ="10"   v-model="form.telefonowhatsapp">
                        </div>
                    </div>
                

                    <div class="col-lg-6 mb-4">
                        <label for="">Telefono 2 </label>
                        <div>
                            <input type="text" class="form-control" maxlength ="10"   v-model="form.telefonoCelular">
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <label for="">Convencional</label>
                        <div>
                            <input type="text" class="form-control" maxlength ="10"   v-model="form.telefonoConvencional">
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label for="">Correo  </label>
                        <div>
                            <input type="email" class="form-control"  v-model="form.email">
                        </div>
                    </div>
                </div>
                
                <br> <br>
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <label for="">Dirección  *</label>
                        <div>
                            <input type="text" class="form-control"  v-model="form.direccion">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <label for="">Manzana  </label>
                        <div>
                            <input type="text" class="form-control"  v-model="form.mz">
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label for="">Villa  </label>
                        <div>
                            <input type="text" class="form-control"  v-model="form.vl">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-6 mb-4">
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

                    <div class="col-lg-6 mb-4">
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

                    <div class="col-lg-6 mb-4">
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

                    <div class="col-lg-6 mb-4">
                        <label for="">Referencia  </label>
                        <div>
                            <input type="text" class="form-control"  v-model="form.referencia">
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <label for="">Ubicación  </label>

                        <div>
                            <input type="text" class="form-control"  v-model="form.ubicacion">
                        </div>
                    </div>

                </div>

            
            <template modal-footer>
              <div class="row">
                <div class="col-lg-4 mb-2" v-if="this.Registrar=='Registrar'">
                  
                    <input  class="btn btn-success btn-sm float-center" type="submit" value="Registrar">
                  
                </div>
                <div class="col-lg-4 mb-2" v-else>
                    <input  class="btn btn-success btn-sm float-center" type="submit" value="Actualizar">
                </div>
                <div class="col-lg-4 mb-2">
                  <b-button
                    variant="primary"
                    size="sm"
                    class="float-right"
                    @click.prevent="modal1=false"
                  >
                    Cerrar
                  </b-button>
                </div>

              </div>
           
            </template>
                
            </form>
        </div>
      </div>
    </b-modal>

      <!-- / MODAL ---->


    
      <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="card text-center">
                <div class="card-header">
                    Detalles de un cliente
                </div>
              <div class="card-body" id="datos">
                <h5 class="card-title">{{ form.apellidos }} {{ form.nombre }}</h5>
                <p class="card-text"></p>
                
                <div class="row">
                  <div class="col-lg-4 mb-4">
                    <div class="card card-primary card-outline">
                      <div class="card-header">
                        <h3 class="card-title">Datos Personales</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body box-profile">
                        
                          <h3 class="profile-username text-center"></h3>
                          <p class="text-muted  text-center"><strong>Cedula:</strong>         {{ form.cedula }}               </p>
                          <p class="text-muted  text-center"><strong>WhatsApp:</strong>       {{ form.telefonowhatsapp }}     </p>
                          <p class="text-muted  text-center"><strong>Telefono2:</strong>      {{ form.telefonoCelular }}      </p>
                          <p class="text-muted  text-center"><strong>Convencional:</strong>   {{ form.telefonoConvencional }} </p>
                          <p class="text-muted text-center "><strong>Direccion:</strong>       {{ form.direccion }}            </p>
                          <p class="text-muted text-center "><strong>Provincia:</strong>       {{ form.provincia }}            </p>
                          <p class="text-muted text-center "><strong>Canton:</strong>          {{ form.canton }}            </p>
                          <p class="text-muted text-center "><strong>Sector:</strong>          {{ form.sector }}               </p>
                          <p class="text-muted text-center "><strong>Referencia:</strong>      {{ form.referencia }}           </p>
                          <p class="text-muted text-center "><strong>Mz:</strong>      {{ form.mz }}           </p>
                          <p class="text-muted text-center "><strong>Villa:</strong>      {{ form.vl }}           </p>
                          <div v-if="form.ubicacion">
                              <a :href="form.ubicacion" class="btn btn-primary" target="_blank" ><i class="fas fa-map-marked"></i> <small>{{form.ubicacion}}</small> </a>
                          </div>
                          <hr>
                          <p class="text-muted text-center "><strong>Email:</strong>  {{ form.email }}   </p>

                          
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-8 mb-4">
                    <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-offset="0" tabindex="0">
                      <div class="row">
                        <div class="col">
                        
                          <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped table-responsive">
                              <thead>
                                  <tr>
                                      <th>Fecha</th>
                                      <th>Productos</th>
                                      <th>Total</th>
                                      <th>Puntos</th>
                                    <th></th>     
                                  </tr>
                              </thead>
                              <tbody>
                                    <tr v-for="(item, index) in datacarrito" :key="index">
                                      <td v-text="item.created_at"></td>
                                      <td v-text="item.productos"></td>
                                      <td >${{item.total}}</td>
                                      <td >{{item.puntos}}</td>
                                      <td><button type="submit" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter" @click="viewDetalle(item)" > <i class="fas fa-eye"></i></button></td>
                                      
                                    </tr>
                              </tbody>         
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
               
              </div>
            
            </div>

          </div>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Detalle de Pedido</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table-responsive">
                      <thead>
                          <tr>
                              <th>Categoria</th>
                              <th>Producto</th>
                              <th>Precio</th>
                              <th>Puntos</th>
                            
                          </tr>
                      </thead>
                      <tbody>
                            <tr v-for="(item, index) in datacarritodetalle" :key="index">
                              <td v-text="item.categoria"></td>
                              <td v-text="item.producto"></td>
                              <td >${{item.precio}}</td>
                              <td >{{item.puntos}}</td>
                            </tr>
                      </tbody>         
                    </table>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              
            </div>
          </div>
        </div>
      </div>
  </div>

</template>

<script>
import Vue from "vue";
// Import component
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import swal from "sweetalert2";
Vue.use(Loading);
export default {
  name: "lista",
  components: {
    Loading,
  },
  data() {
    return {
      isLoading: false,
      isSuccess: false,
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
        cantonname:null,
        sectorname: null,
        referencia: null,
        email: null,

        ubicacion: null,

      },
      clientes: [],
      contacto: null,
      telefono1: "",
      page: 0,
      url: "http://app.datamarketingplus.ec/listaclientes",
      errors: [],

      idContacto: null,
      provincias: null,
      cantones: null,
      sectores: null,
      buscardato: null,
      modal1: false,
      Registrar: null,
      id:0,
      datos: null,

      // carrito datos

      datacarrito: null,
      datacarritodetalle: null
    };
  },

  created() {
    axios.get("http://app.datamarketingplus.ec/getprovincia").then((res) => {
      this.provincias = res.data;
    });
  },
  mounted() {
    // console.log("Componente cliente montado.");
    this.getClientes();
  },
  methods: {
    getClientes() {
      this.isLoading = true;
      this.isSuccess = false;
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
        .finally(() => (this.isLoading = false))
        .catch((err) => {
          console.error(err.message);
        })
        .finally(() => (this.isLoading = false));
    },

    search() {
      let me = this;

      axios
        .get(`${me.url}?cedula=${me.buscardato}`)
        .then((res) => {
          me.clientes = res.data.data;
          me.page = res.data.current_page;
          console.log(res.data.current_page);
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
      console.log(this.idContacto);
      axios.get("consultarcontacto/" + item.id).then((res) => {
        this.contacto = res.data;
      });
    },

    getCanton(event) {
      axios.get("contactos/getcanton/" + event).then((res) => {
        this.cantones = res.data;

          console.log(res.data.canton);

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

        console.log(res.data);

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
      this.isLoading = true;
      this.isSuccess = false;

      const parametros = {
        id: this.id,
        telefonoWhatsapp: this.form.telefonowhatsapp,
        telefonoCelular: this.form.telefonoCelular,
        telefonoConvencional: this.form.telefonoConvencional,
        cedula: this.form.cedula,
        nombres: this.form.nombre,
        apellidos: this.form.apellidos,
        direccion: this.form.direccion,
        mz: this.form.mz,
        villa: this.form.vl,
        provincia: this.form.provincia,
        canton: this.form.canton,
        sector: this.form.sector,
        referencia: this.form.referencia,
        idContacto: this.idContacto,
        email: this.form.email,
        ubicacion: this.form.ubicacion,
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
      this.form.email = "";
      this.form.ubicacion = "";
    
       if (this.Registrar=='Registrar') {
          axios
          .post("guardarcliente", parametros)
          .then((res) => {
            this.clientes.push(res.data);
            this.$swal("Creado  con Exito");
            this.getClientes();
            this.modal1 = false;
          })
          .finally(() => (this.isLoading = false));
       }else{
          if (this.id>0) {
           axios
            .put("actualizarcliente", parametros)
            .then((res) => {
              this.clientes.push(res.data);
              swal("Actualizado con Exito");
              this.getClientes();
              this.modal1 = false;
            })
            .finally(() => (this.isLoading = false));
          }else{
            console.log("error id no encontrado");
          }
         }
        
     
    },

    deleete(id) {
      swal({
        title: "¿Seguro que quieres eliminar el Cliente?",
        text: "No podrás revertir esta acción luego",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, borrarlo!",
      }).then((result) => {
        if (result.value) {
          axios
            .delete("deletecliente/" + id)
            .then((res) => {
              this.getClientes();

              swal("Borrarlo!", "Pago eliminado.", "success");
            })
            .catch((err) => {
              console.log(err);
              let error = err.response.data;
              if (err.response.data == "Unauthorized.") {
                error = "Usuario con rol no autorizado";
              }

              swal("Error", error, "error");
            });
        }
      });
    },

    getRegistrar() {

      this.Registrar="Registrar";
      this.limpiar();
     
      this.getCanton(this.form.provincia);
      this.getSector(this.form.canton);
    },

    edit(obj) {
      this.Registrar="Actualizar";
      this.limpiar();

      this.modal1 = true;
      this.form.cedula = obj.cedula;
      this.form.telefonowhatsapp = obj.telefonoWhatsapp;
      this.form.telefonoCelular = obj.telefonoCelular;
      this.form.telefonoConvencional = obj.telefonoCasa;
      this.form.cedula = obj.cedula;
      this.form.nombre = obj.nombres;
      this.form.nombre = obj.nombres;
      this.form.apellidos = obj.apellidos;
      this.form.direccion = obj.direccion;
      this.form.mz = obj.mz;
      this.form.vl = obj.villa;
      this.form.provincia = obj.codigo_provincia;
      this.form.canton = obj.codigo_canton;
      this.form.sector = obj.codigo_sector;
      this.form.referencia = obj.referencia;
      this.form.email = obj.email;
      this.form.ubicacion = obj.ubicacion;
      this.id = obj.id;
      this.getCanton(obj.codigo_provincia);
      this.getSector(obj.codigo_canton);
      console.log(obj);
    },
    limpiar(){
      this.form.telefonowhatsapp = "";
      this.form.telefonoCelular = "";
      this.form.telefonoConvencional = "";
      this.form.cedula = "";
      this.form.nombre = "";
      this.form.apellidos = "";
      this.form.direccion = "";
      this.form.mz = "";
      this.form.vl = "";
      this.form.sector = "";
      this.idContacto = "";
      this.form.email = "";
      this.form.ubicacion = "";
      this.form.referencia = "";

      this.id =0;
    },
    view(obj){
      this.limpiar();
      
      this.form.cedula = obj.cedula;
      this.form.telefonowhatsapp = obj.telefonoWhatsapp;
      this.form.telefonoCelular = obj.telefonoCelular;
      this.form.telefonoConvencional = obj.telefonoCasa;
      this.form.cedula = obj.cedula;
      this.form.nombre = obj.nombres.toUpperCase();
      this.form.apellidos = obj.apellidos.toUpperCase();
      this.form.direccion = obj.direccion;
      this.form.mz = obj.mz;
      this.form.vl = obj.villa;
      this.form.provincia = obj.provincia;
      this.form.canton = obj.canton;
      this.form.sector = obj.sector;
      this.form.referencia = obj.referencia;
      this.form.email = obj.email;
      this.form.ubicacion = obj.ubicacion;
      this.id = obj.id;
       axios.get("clientecarrito/"+obj.id).then((res) => {
            this.datacarrito = res.data;
          });

    },
    viewDetalle(obj){
          axios.get("clientecarritodetalle/"+obj.id).then((res) => {
            this.datacarritodetalle = res.data;
          });
          console.log( this.datacarritodetalle)
    }

  },
};
</script>