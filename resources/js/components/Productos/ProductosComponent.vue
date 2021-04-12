<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="alert alert-primary" role="alert">
            <center>Listado Productos  <span class="badge badge-light">{{ productos.length}}</span></center> 
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <b-button v-b-modal.modal1 @click.prevent="modal1=true" variant="primary" @click="getRegistrar()"> <i class="fas fa-user-plus"></i> Registrar</b-button>
        </div>
        <div class="col">
          <input type="text" v-model="buscardato" class="form-control" placeholder="Buscar Producto" /> 
        </div> 
          <div class="col">
            <button type="submit" class="btn btn-secondary" @click="search"> <i class="fas fa-search"></i> Buscar</button>
          </div>  
      </div>
      <hr>
      <div class="row">
        <div class="col">
     
          <table class="table table-bordered table-hover table-striped table-responsive">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Categoria</th>
                    <th>Cantidad</th>
                    <th>Puntos</th>
                    <th>Precio</th>
                 
                  <th colspan="3"></th>     
                </tr>
            </thead>
            <tbody>
                  <tr v-for="(item, index) in productos" :key="index">
                    <td v-text="item.id"></td>
                    <td v-text="item.nombre"></td>
                    <td v-text="item.descripcion"></td>
                    <td v-text="item.categoria_id"></td>
                    <td v-text="item.cantidad"></td>
                    <td v-text="item.puntos"></td>
                    <td v-text="item.precio"></td>
                    
                    <td><button type="submit" v-b-modal.modal1 @click.prevent="modal1=true"  class="btn btn-warning" @click="edit(item)" > <i class="fas fa-user-edit"></i></button></td>

                    <td><button type="submit" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg" @click="view(item)" > <i class="fas fa-eye"></i></button></td>

                    <td><button type="submit" class="btn btn-danger" @click="deleete(item.id)" > <i class="fas fa-trash-alt"></i></button></td>

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
    <b-modal id="modal1" hide-footer :v-bind="modal1" v-if="modal1" size="xl" ><div class="alert alert-dark" role="alert"> <center>{{Registrar}} Producto</center> </div>
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
                        <label for="">Producto  </label>
                        <div>
                            <input type="text" class="form-control"   maxlength ="10"  v-model="form.producto">
                        </div>
                    </div>

                    <div class="col">
                        <label for="">Descripciòn  </label>
                        <div>
                            <input type="text" class="form-control"  v-model="form.descripcion">
                        </div>
                    </div>

                    <div class="col">
                        <label for="">cantidad  </label>
                        <div>
                            <input type="number" class="form-control"  v-model="form.cantidad">
                        </div>
                    </div>
                </div>
                <br>
               
                
                <br> <br>
                <div class="row">
                    <div class="col">
                        <label for="">Puntos</label>
                        <div>
                            <input type="text" class="form-control"  v-model="form.puntos">
                        </div>
                    </div>
                    <div class="col">
                        <label for="">Precio  </label>
                        <div>
                            <input type="text" class="form-control"  v-model="form.precio">
                        </div>
                    </div>
                    <div class="col">
                        <label for="">Categoria  </label>
                        <div>
                            <select v-model="form.categoria" class="form-control mb-2" >
                                <option value="" >Seleccionar la Categoria  </option>
                                <option v-for="(item, index) in categorias" :key="index" v-bind:value="item.id" >
                                {{ item.id }} | <strong>{{ item.nombre }} </strong> 
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

            
            <template modal-footer>
              <div class="row">
                <div class="col" v-if="this.Registrar=='Registrar'">
                  
                    <input  class="btn btn-success btn-sm float-center" type="submit" value="Registrar">
                  
                </div>
                <div class="col" v-else>
                    <input  class="btn btn-success btn-sm float-center" type="submit" value="Actualizar">
                </div>
                <div class="col">
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
                    Detalles de un Producto
                </div>
              <div class="card-body" id="datos">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                
                <div class="row">
                  <div class="col">
                    <div class="card card-primary card-outline">
                      <div class="card-header">
                        <h3 class="card-title">Datos </h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body box-profile">
                        
                          <h3 class="profile-username text-center"></h3>
                          <p class="text-muted  text-center"><strong>Producto:</strong>             {{ form.producto }}</p>
                          <p class="text-muted  text-center"><strong>Descripcion:</strong>          {{ form.descripcion }}</p>
                          <p class="text-muted  text-center"><strong>Precio:</strong>               {{ form.precio }}</p>
                          <p class="text-muted  text-center"><strong>Puntos:</strong>               {{ form.puntos }} </p>
                          <p class="text-muted text-center "><strong>Cantidad:</strong>             {{ form.cantidad }}</p>
                          <p class="text-muted text-center "><strong>Categorias:</strong>           {{ form.categoria }}</p>
                         
                          
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
        producto: null,
        descripcion: null,
        cantidad: null,
        precio: null,
        puntos: null,
        categoria: null,
        

      },
      productos: [],
      contacto: null,
      telefono1: "",
      page: 0,
      url: "http://localhost/gestiones/public/listaproductos",
      errors: [],

      idContacto: null,
      categorias: null,
      cantones: null,
      sectores: null,
      buscardato: null,
      modal1: false,
      Registrar: null,
      id: 0,
      datos: null,

      // carrito datos

      datacarrito: null,
      datacarritodetalle: null
    };
  },

  created() {
    axios.get("categorias").then((res) => {
      this.categorias = res.data;
    });
  },
  mounted() {
    // console.log("Componente cliente montado.");
    this.getproductos();
    console.log(this.productos)
    
  },
  methods: {
    getproductos() {
      this.isLoading = true;
      this.isSuccess = false;
      let me = this;
      axios
        .get(`${me.url}?page=1`)
        
        .then((res) => {
          
          me.productos = res.data;
          me.page = res.data.current_page;
          
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
        .get(`${me.url}?nombre=${me.buscardato}`)
        .then((res) => {
          console.log(res.data)
          me.productos = res.data;
          me.page = res.data.current_page;
       
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
          me.productos = res.data.data;
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
          me.productos = res.data.data;
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

    getCategoria(event) {
      
       axios.get("productos/categorias/"+event).then((res) => {
          this.form.categoria = res.data;
        });
     
    },

    

    checkForm: function () {
      this.errors = [];
      if (!this.form.producto) {
        this.errors.push("El nombre del producto es obligatorio");
      }

      if (!this.form.precio) {
        this.errors.push("El precio es obligatorio");
      }

      if (!this.form.categoria) {
        this.errors.push("La categoria es obligatoria");
      }

      if (
        this.form.producto &&
        this.form.precio &&
        this.form.categoria
      ) {
        this.agregar();
      }
    },

    agregar() {
      this.isLoading = true;
      this.isSuccess = false;

      const parametros = {
        id: this.id,
        producto: this.form.producto,
        categoria: this.form.categoria,
        precio: this.form.precio,
        descripcion: this.form.descripcion,
        cantidad: this.form.cantidad,
        puntos: this.form.puntos
       
      };

      this.form.producto = "";
      this.form.categoria = "";
      this.form.precio = "";
      this.form.descripcion = "";
      this.form.cantidad = "";
      this.form.direccion = "";
      this.form.direccion = "";
      this.form.puntos = "";
    
    console.log(parametros);
       if (this.Registrar=='Registrar') {
          axios
          .post("productos/guardarproducto", parametros)
          .then((res) => {
            this.productos.push(res.data);
            this.$swal("Creado  con Exito");
            this.getproductos();
            this.modal1 = false;
          })
          .finally(() => (this.isLoading = false));
       }else{
          if (this.id>0) {
           axios
            .put("productos/actualizarproducto", parametros)
            .then((res) => {
              this.productos.push(res.data);
              swal("Actualizado con Exito");
              this.getproductos();
              this.modal1 = false;
            })
            .finally(() => (this.isLoading = false));
          }else{
            this.isLoading = false
            console.log("error id no encontrado");
          }
         }
        
     
    },

    deleete(id) {
      swal({
        title: "¿Seguro que quieres eliminar el Producto?",
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
            .get("deleteproducto/" + id)
            .then((res) => {
              this.getproductos();

              swal("Borrarlo!", "Producto eliminado.", "success");
            })
            .catch((err) => {
              console.log(err);
              let error = err.response.data;
              if (err.response.data == "Unauthorized.") {
                error = "Usuario con rol no autorizado";
              }
                this.isLoading = false
              swal("Error", error, "error");
            });
        }
      });
    },

    getRegistrar() {

      this.Registrar="Registrar";
      this.limpiar();
     
    
    },

    edit(obj) {
      this.Registrar="Actualizar";
      this.limpiar();

      this.modal1 = true;
      this.form.producto = obj.nombre;
      this.form.descripcion = obj.descripcion;
      this.form.precio = obj.precio;
      this.form.cantidad = obj.cantidad;
      this.form.puntos = obj.puntos;
      this.form.categoria = obj.categoria_id;
      this.id = obj.id;
    
      
    },
    limpiar(){
      this.form.producto = "";
      this.form.descripcion = "";
      this.form.precio = "";
      this.form.cantidad = "";
      this.form.puntos = "";
      this.form.apellidos = "";
      this.form.categoria = "";
      this.id =0;
    },
    view(obj){
      this.limpiar();
      console.log(obj)
      this.form.producto = obj.nombre;
      this.form.descripcion = obj.descripcion;
      this.form.precio = obj.precio;
      this.form.cantidad = obj.cantidad;
      this.form.puntos = obj.puntos;
      this.form.categoria = obj.categoria_id;
      this.id = obj.id;
      

    },
    

  },
};
</script>