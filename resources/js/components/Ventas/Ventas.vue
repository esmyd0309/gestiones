<template>
  <div class="container">

  </div>
</template>

<script>
    import axios from 'axios'
    import Vue from "vue";
    import Loading from 'vue-loading-overlay';
    import 'whatwg-fetch';
    import 'vue-loading-overlay/dist/vue-loading.css';
    import swal from 'sweetalert2'
    Vue.use(Loading);
  export default {
      
    /*
      Defines the data used by the component
    */components:{
            Loading
        },
        
    data(){
      return {
        isLoading: false,
        isSuccess: false,
        file: null,
        lista: null,
      }
    },

    created() {
        
          axios.get('aprobadasdp/lista')
                .then(res => {
                    this.lista=res.data;
                
            })

    },

    methods: {

      getlista(){
            axios.get('aprobadasdp/lista')
                .then(res => {
                    this.lista=res.data;
                
            })
      },
   

    
     
    }
  }
</script>