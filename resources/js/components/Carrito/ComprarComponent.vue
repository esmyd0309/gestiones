<template>
  <div class="container">
    <loading :active.sync="isLoading"/>
    <div class="row">
      <div class="col">
        <div class="card text-center">
          <div class="card-header alert alert-secondary  ">
           <i class="fas fa-braille"></i> <b>CATEGORIAS</b> 
          </div>
          <div class="card-body">
            <ol class="list-group list-group-numbered" >
              <div class="row">
                <div class="col"  v-for="(item, index) in datacategorias" :key="index" @click="getProductos(item)">
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                    <button class="btn btn-outline-secondary">
                      <div class="ms-2 me-auto" >
                        <div class="fw-bold"> <strong>{{ item.nombre }}</strong> </div>
                        {{ item.descripcion }}
                      </div>
                      <span class="badge  rounded-pill bg-dark">{{ item.cantidad }}</span>
                    </button>
                  
                    
                  </li>
                </div>
              </div>
            </ol>
          </div>
        </div>
      </div>

      <div class="col" v-if="carrito.length !== 0 || carrito[0] === 0">
        <div class="card text-center">
          <div class="card-header alert alert-danger ">
            <i class="fas fa-cart-arrow-down"></i> <b>CARRITO</b> |
                <strong v-if="form.cliente"> {{ form.cliente }}</strong>
                <strong v-else>Seleccionar un Cliente</strong> 
                |
              <button type="submit" class="btn btn-info" data-toggle="modal" v-b-modal.modal1 @click.prevent="modal1=true" data-target=".bd-example-modal-lg" > <i class="fas fa-address-card"></i></button>
      
          </div>
          <div class="card-body">
            <ol class="list-group list-group-numbered" >
              <div class="row">
                <div class="col"  v-for="(item, index) in carrito" :key="index" >
                  <li class="list-group-item d-flex justify-content-between align-items-start" >
                    <button class="btn btn-outline-secondary"  >
                      <div class="ms-2 me-auto" >
                        <div class="fw-bold" > <strong @click="eliminarCarrito(index,item)">{{ item.nombre }}</strong>   <small>${{item.precio}}</small> </div>
                      
                      </div>
                    </button>
                  
                    <span class="badge bg-primary rounded-pill"></span>
                  </li>
                </div>
              </div>
            </ol>
            
          </div>
          TOTAL ${{form.total}}
        </div>
        <div class="card-footer text-muted" v-if="form.cliente">
           <button type="button" class="btn btn-success" @click="enviar()" data-bs-toggle="button" autocomplete="off" v-if="carrito.length !== 0 || carrito[0] === 0"><i class="fas fa-cart-arrow-down"></i>  Guardar Compra</button>
           <button type="button" class="btn btn-danger " @click="limpear(carrito)" data-bs-toggle="button" autocomplete="off"><i class="fas fa-trash"></i>  Limpear Carrito</button>
        </div>
      </div>

      
    </div>
    <div class="row" v-if="dataproductos">
      <div class="col-12">
        <div class="card text-center">
          <div class="card-header alert alert-primary">
           
          </div>
          <div class="card-body">
            <h5 class="card-title" v-if="categoriaSelect"> <i class="fab fa-product-hunt"></i> PRODUCTOS | <small>{{categoriaSelect}}</small> </h5>
              <div class="row">
                <div class="col" v-for="(item, index) in dataproductos" :key="index">
                  <div class="card" style="width: auto;"  @click="getCarrito(item)">
                    <img :src="item.imagen" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h6 class="card-title">{{item.nombre}}</h6>
                      <p class="card-text"><small>{{item.descripcion}}</small> </p>
                     <strong>${{item.precio}}</strong>
                    </div>
                  </div>
                </div>
                <br>
              </div>
             
            
          </div>
          <div class="card-footer text-muted">
            {{dataproductos.length}} 
          </div>
        </div>
      </div>
    </div>

      <b-modal id="modal1" hide-footer :v-bind="modal1" v-if="modal1" size="xl" >
        
            <div class="card text-center">
              <div class="card-header">
                  Buscar Cliente
              </div>
              <div class="card-body" id="datos">
                <input type="text" v-model="buscar" @input="getClientes(buscar)" class="form-control" placeholder="Buscar cliente por cedula o nombres"/>
                 <hr>
                 
                    <table class="table table-bordered table-hover table-striped table-responsive">
                      <thead>
                        <tr>
                          <th>cedula</th>
                          <th>Nombres</th>
                          <th>Telefono Whatsapp</th>
                          <th>Direcciòn</th>
                          <th>Mz</th>
                          <th>Villa</th>
                          <th>Referencia</th>
                            
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(item, index) in dataclientes" :key="index" @click="getClienteselecionado(item)">
                          <td v-text="item.cedula"></td>
                          <td v-text="item.nombres" ></td>
                          <td v-text="item.telefonoWhatsapp"></td>
                          <td v-text="item.direccion"></td>
                          <td v-text="item.mz"></td>
                          <td v-text="item.villa"></td>
                          <td v-text="item.referencia"></td>
                      
                        </tr>
                      </tbody>         
                    </table>
                
                 
                    <b-button v-b-modal.modalregistrarcliente @click.prevent="modalregistrarcliente=true" variant="primary" @click="getRegistrar()"> <i class="fas fa-user-plus"></i> Registrar</b-button>

                 
                </div>
              </div>
          
      </b-modal>

        <!-- MODAL ---->
    <b-modal id="modalregistrarcliente" hide-footer :v-bind="modalregistrarcliente" v-if="modalregistrarcliente" size="xl" ><div class="alert alert-dark" role="alert"> <center>Registrar Cliente</center> </div>
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

                    <div class="col">
                        <label for="">Ubicación  </label>

                        <div>
                            <input type="text" class="form-control"  v-model="form.ubicacion">
                        </div>
                    </div>

                </div>

            
            <template modal-footer>
              <div class="row">
                <div class="col" >
                  
                    <input  class="btn btn-success btn-sm float-center" type="submit" value="Registrar">
                  
                </div>
               
                <div class="col">
                  <b-button
                    variant="primary"
                    size="sm"
                    class="float-right"
                   
                    @click.prevent="modalregistrarcliente=false"
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
    
  </div>
</template>

<script>
    import axios from 'axios'
    import Vue from "vue";
    import swal from "sweetalert2";
    import Loading from 'vue-loading-overlay';
    import 'whatwg-fetch';
    import 'vue-loading-overlay/dist/vue-loading.css';
    Vue.use(Loading);
  export default {
      
   name:'comprar',
   components:{
            Loading
        },
    data(){
      return {
        isLoading: false,
        isSuccess: false,
        form: {
            producto:null,
            categoria: null,
            total: 0.0,
            cantidad: 1,
            cliente: null,
            cliente_id:null,

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
        id: 0,
        isLoading: false,
        isSuccess: false,
        
        datacategorias: null,
        dataproductos: null,
        cantidades: null,
        categoriaSelect: null, 
        carrito: [],
        buscar: '',
        dataclientes: null,
        modal1:false,


        modalregistrarcliente: false,
        addproducto: null,
        cantones: null,
        sectores: null,
        provincias:null,
        errors: []
        

      }
    },
    

   
    created() {
        
      axios.get('categorias')
      .then(res => {
          this.datacategorias=res.data;
      
      })

      axios.get('getclientesall')
      .then(res => {
          this.dataclientes=res.data;
      
      });

      axios.get("getprovincia").then((res) => {
        this.provincias = res.data;
      });

    },

    methods: {
      getClientes(dato){
    
        axios.get('dataclientes/'+dato)
        .then(res => {
          this.dataclientes=res.data;
        
        });
      },
      getClienteselecionado(obj){
        this.form.cliente=obj.nombres;
        this.form.cliente_id=obj.id;
        this.modal1=false;
      },

      getProductos(obj){
        this.isLoading = true;
        this.isSuccess = false;

        let id = obj.id;
        this.categoriaSelect = obj.nombre;
                
        axios.get('categorias/getproductos/'+id)
        .then(res => {
            this.dataproductos=res.data;
        }).finally(()=> this.isLoading= false)
      },
     
      getCarrito(obj){
       
         this.addproducto=obj;
          this.toastCount++
                                      
            this.$bvToast.toast(`  ${obj.nombre} $${obj.precio} `, 
            {
              title: 'Produto Agregado al carrito!',
              autoHideDelay: 3000,
              variant: 'success'

            })

         this.form.total=this.form.total+obj.precio;
            this.carrito.push({
              nombre: obj.nombre,
              producto_id: obj.id,
              precio: obj.precio,
              id: obj.id,
              categoria_id: obj.categoria_id,
              })
          
          
       
      },
      eliminarCarrito(index,obj){
        
        this.$bvToast.toast(`  ${obj.nombre} $${obj.precio} `, 
            {
              title: 'Produto Eliminado del carrito!',
              autoHideDelay: 5000,
              variant: 'danger',
               toaster:'b-toaster-bottom-left'

            })

        this.form.total=this.form.total-obj.precio;
        this.carrito.splice(index,1);
      },

      enviar(){
        
        swal({
            title: '¿Seguro que deseas ya Enviar el pedido?',
            text: "No podrás revertir esta acción luego, puedes revisar antes! cancelando la acción ",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, Enviar!'
        }).then((result) => {
            if (result.value) 
            {
                this.isLoading = true;
                this.isSuccess = false;
                  const parametros = {
                      carrito:    this.carrito,
                      cliente_id: this.form.cliente_id,
                      total:      this.form.total

                  }
                axios
                  .post("guardarcarrito", parametros)
                  .then((res) => {
                      this.limpear2(this.carrito);
                    swal(
                    'Pedido',
                    'Enviado con exito!',
                    'success'
                    )
                     
                }).finally(()=> this.isLoading= false)
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
                }).finally(()=> this.isLoading= false);
            }
        })
        
         

       
       
      },
      limpear(carrito){
        swal({
            title: '¿Seguro que quiere eliminar el pedido?',
            text: "No podrás revertir esta acción luego, puedes revisar antes! cancelando la acción",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, Limpear!'
        }).then((result) => {
            if (result.value) 
            {
               
                  
                this.carrito.splice(carrito);
                this.form.cliente=null
                this.form.cliente_id=null
                this.form.total=null
            }
        })

        
      },
      limpear2(carrito){
        this.carrito.splice(carrito);
        this.form.cliente=null
        this.form.cliente_id=null
        this.form.total=null
      },
      getRegistrar() {

       
        this.limpearcliente();
      
        this.getCanton(this.form.provincia);
        this.getSector(this.form.canton);
      },

      limpearcliente(){
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
    
      
          axios
          .post("guardarcliente", parametros)
          .then((res) => {
            
            this.dataclientes.push(res.data);
            console.log(this.dataclientes);
            this.$swal("Creado  con Exito");
            this.modalregistrarcliente = false;
            
          })
          .finally(() => (this.isLoading = false));
        
          axios.get('getclientesall')
          .then(res => {
              this.dataclientes=res.data;
              this.modalregistrarcliente = false;
          });
     
      },

     
   

    
     
    }
  }
</script>