<template>
  <div>
    <!--ADD UNIVERSITY-->
    <div class="container-fluid">
      <!-- Table -->
      <div class="row">
        <div class="col-12 m-b-20">

          <div class="card shadow mt-7">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Register University</h3>
                </div>
              </div>
            </div><!--/card-header-->

            <div class="card-body">
              <div class="form-group">
                <label>Name of University</label>
                <input type="text" class="form-control" :class="[errors.name ? 'is-invalid' : '']" v-model="name_univ">
                <div class="invalid-feedback" v-if="errors.name">
                  {{errors.name[0]}}
                </div>
              </div><!--/form-group-->

              <button type="submit" class="btn btn-danger" @click="saveUniv">Save University</button>

            </div><!--/card-body-->
          </div><!--/card-->

        </div><!--/col-->
      </div><!--/row-->
    </div><!--/container-fluid-->
    <!--/ADD UNIVERSITY-->

    <div class="container-fluid mt-5">
      <div class="header-body">
        <h3>Showing all University</h3>
      </div><!--/header-body-->
      <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 m-b-5" v-for="univ in univs" :key="univ.id">
          <app-university :name="univ.name" :id="univ.id"></app-university>
        </div><!--/col-->
      </div><!--/row-->
    </div><!--/container-fluid-->

  </div>
</template>
<script>
import University from './University.vue'
import NProgress from 'nprogress'

export default{
  data(){
    return{
      name_univ:'',
      univs:[],
      errors:[]
    }
  },
  methods:{
    getData(){
      axios.get('/admin/get-univ').then(res => {
        this.univs = res.data
      })
    },
    saveUniv(){
      axios.post('/admin/save-univ',{name:this.name_univ}).then(res => {
        swal('','Successfully to add university','success').then((value) => {
          this.name_univ = ''
          this.errors = []
          this.getData()
        })
      }).catch(err => {
        this.errors = err.response.data
        NProgress.done()
      })
    }
  },
  mounted(){
    this.getData()
  },
  components:{
    appUniversity:University
  }
}
</script>
