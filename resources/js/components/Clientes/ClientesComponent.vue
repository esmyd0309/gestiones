<template>
  <div>
    <div class="container">
      <div class="alert alert-primary" role="alert">
       <center>Listado clientes  <span class="badge badge-light">{{ clientes.length}}</span></center> 
      </div>
      <div class="row">
        <div class="col-sm">
          <b-button v-b-modal.modal1 @click.prevent="modal1=true" variant="info"> <i class="fas fa-user-plus"></i> Registrar</b-button>
        </div>
        <div class="col-sm">
          <input type="text" v-model="buscardato" class="form-control" placeholder="Buscar por cedula del cliente" /> 
        </div> 
          <div class="col-sm">
            <button type="submit" class="btn btn-info" @click="search"> <i class="fas fa-search"></i> Buscar</button>
          </div>  
      </div>
      <hr>
      <div class="row">
        <div class="col">
          <table class="table table-bordered table-hover table-striped ">
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
                  <th colspan="3"></th>     
                </tr>
            </thead>
            <tbody>
                  <tr v-for="(item, index) in clientes" :key="index">
                    <td v-text="item.id"></td>
                    <td v-text="item.cedula"></td>
                    <td v-text="item.nombres"></td>
                    <td v-text="item.apellidos"></td>
                    <td v-text="item.telefonoWhatsapp"></td>
                    <td v-text="item.direccion"></td>
                    <td v-text="item.mz"></td>
                    <td v-text="item.villa"></td>
                    <td v-text="item.referencia"></td>
                    
                    <td><button type="submit" class="btn btn-warding" @click="edit(item)" > <i class="fas fa-user-edit"></i></button></td>
                    <td><button type="submit" class="btn btn-info" @click="deleete(item.id)" > <i class="fas fa-trash-alt"></i></button></td>
                    <td><button type="submit" class="btn btn-info" > <i class="fas fa-eye"></i></button></td>
                  </tr>
            </tbody>         
          </table>
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
    <b-modal id="modal1" :v-bind="modal1" v-if="modal1" size="xl" ><div class="alert alert-dark" role="alert"> <center>Registrar Cliente</center> </div>
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
                    <div class="col">
                        <label for="">Cedula  </label>
                        <div>
                            <input type="text" class="form-control"   maxlength ="10"  v-model="form.cedula">
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
                <br>
                <div class="row">

                    <div class="col">
                        <label for="">Telefono WhatsApp *</label>
                        <div>
                            <input type="text" class="form-control" id="jack" maxlength ="10"   v-model="form.telefonowhatsapp">
                        </div>
                    </div>
                

                    <div class="col">
                        <label for="">Telefono 2 </label>
                        <div>
                            <input type="text" class="form-control" maxlength ="10"   v-model="form.telefonoCelular">
                        </div>
                    </div>

                    <div class="col">
                        <label for="">Convencional</label>
                        <div>
                            <input type="text" class="form-control" maxlength ="10"   v-model="form.telefonoConvencional">
                        </div>
                    </div>
                    <div class="col">
                        <label for="">Correo  </label>
                        <div>
                            <input type="email" class="form-control"  v-model="form.email">
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
    </b-modal>

      <!-- / MODAL ---->
  </div>

</template>

<script>
import Vue from "vue";
// Import component
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import swal from 'sweetalert2'
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
        referencia: null,
      },
      clientes: [],
      contacto: null,
      telefono1: "",
      page: 0,
      url: "http://localhost/gestiones/public/listaclientes",
      errors: [],
      idContacto: null,
      provincias: null,
      cantones: null,
      sectores: null,
      buscardato: null,
      modal1: false
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
      this.isLoading = true;
      this.isSuccess = false;
      const parametros = {
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
      axios.post("guardarcliente", parametros).then((res) => {
        this.clientes.push(res.data);
        this.$swal("Creado  con Exito");
        this.getClientes();
        this.modal1=false
      }).finally(() => (this.isLoading = false));
    },

    

    deleete(id)
    {
          swal({
              title: '¿Seguro que quieres eliminar el Cliente?',
              text: "No podrás revertir esta acción luego",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Cancelar',
              confirmButtonText: 'Si, borrarlo!'
          }).then((result) => {
              if (result.value) 
              {
                  axios.delete("deletecliente/"+id)
                  .then( res => {
                      this.getClientes();

                      swal(
                      'Borrarlo!',
                      'Pago eliminado.',
                      'success'
                      )
                  })
                  .catch( err => {
                      console.log(err)
                      let error = err.response.data
                      if (err.response.data == 'Unauthorized.') 
                      {
                          error = 'Usuario con rol no autorizado'
                      }

                      swal(
                          'Error',
                          error,
                          'error'
                      )
                  })
              }
          })
    },

    edit(obj){
        this.form.cedula=obj.cedula;
        console.log(this.form.cedula);
    }
  },
};
</script>