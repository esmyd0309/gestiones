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
                <div class="col "  v-for="(item, index) in carrito" :key="index" >
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
                  <div class="card" style="width: 15rem;"  @click="getCarrito(item)">
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
                        <tr v-for="(item, index) in dataclientes" :key="index" @click="getClienteselecionado(item) " >
                
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
              </div>
            </div>
          
      </b-modal>

 
    
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
            cliente_id:null
        },
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
        addproducto: null
        

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
            text: "No podrás revertir esta acción luego, puedes revisar antes! cancelando la acción",
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
      }


     
   

    
     
    }
  }
</script>