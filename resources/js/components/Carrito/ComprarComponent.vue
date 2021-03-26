<template>
  <div class="container">
    <div class="row">
      <div class="col-6">
        <ol class="list-group list-group-numbered" >

          <li class="list-group-item d-flex justify-content-between align-items-start" v-for="(item, index) in datacategorias" :key="index">
            <div class="ms-2 me-auto" @click="getProductos(item.id)">
              <div class="fw-bold"> <strong>{{ item.nombre }}</strong> </div>
              {{ item.descripcion }}
            </div>
            <span class="badge bg-primary rounded-pill">14</span>
          </li>
          
        </ol>
      </div>
      <div class="col-6">
        <div class="list-group" v-for="(item, index) in dataproductos" :key="index">
          <label class="list-group-item">
            <input class="form-check-input me-1" type="checkbox" value="">
              {{ item.nombre }}
          </label>
          
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    import axios from 'axios'
    import Vue from "vue";
   

  export default {
      
   name:'comprar',
    data(){
      return {
        form: {
            producto:null,
            categoria: null,
            total: null

        },
        isLoading: false,
        isSuccess: false,
        
        datacategorias: null,
        dataproductos: null,

      }
    },

    created() {
        
          axios.get('categorias')
                .then(res => {
                    this.datacategorias=res.data;
                
            })

    },

    methods: {

      getProductos(id){
            axios.get('categorias/getproductos/'+id)
                .then(res => {
                    this.dataproductos=res.data;
                console.log(this.dataproductos);
            })
      },

     
   

    
     
    }
  }
</script>