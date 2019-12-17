<template>
  <div>
    <div class="container-fluid">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search programme" v-model="search">
        <div class="input-group-append">
          <span class="input-group-text text-default"><i class="far fa-search"></i></span>
        </div><!--/input-group-append-->
      </div><!--/input-group-->

      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6" v-for="programme in programmes">
          <app-programme :university="programme.university.name" :name="programme.name" :description="programme.description"
            :closingDate="programme.closingDate" :auth="auth" :home="home" :check="check" :programme_id="programme.id">
          </app-programme>   
        </div><!--/col-->
      </div><!--/row-->

    </div><!--/container-fluid-->

  </div>
</template>

<script>
import CardProgramme from './CardProgramme.vue'

export default{
  props:['auth','home','check'],
  data(){
    return{
      search:'',
      programmes:[]
    }
  },
  methods:{
    getProgramme(){
      axios.get('/get-programme').then(res => {
        this.programmes = res.data
      })
    }
  },
  watch:{
    search(val){
      if(val.length > 2){
        axios.get('/get-programme?s='+val).then(res => {
          this.programmes = res.data
        })
      }else this.getProgramme()
    }
  },
  components:{
    appProgramme:CardProgramme
  },
  mounted(){
    this.getProgramme()
  }
}
</script>
