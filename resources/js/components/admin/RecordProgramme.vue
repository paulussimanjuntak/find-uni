<template>
  <div>
    <div class="container-fluid">
      <!-- Table -->
      <div class="row">
        <div class="col-12 m-b-20">

          <!--/UNIVERSITY PROGRAMME-->
          <div class="card shadow mt-7">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Record Programme</h3>
                </div>
              </div>
            </div><!--/card-header-->

            <div class="card-body">
                <div class="form-group">
                  <label>Add Programme Name</label>
                  <input type="text" class="form-control" :class="[errors.name ? 'is-invalid' : '']" v-model="name">
                  <div class="invalid-feedback" v-if="errors.name">
                    {{errors.name[0]}}
                  </div>
                </div><!--/form-group-->
                <div class="form-group">
                  <label>Programme Description</label>
                  <textarea class="form-control" :class="[errors.description ? 'is-invalid' : '']" rows="3" v-model="description"></textarea>
                  <div class="invalid-feedback" v-if="errors.description">
                    {{errors.description[0]}}
                  </div>
                </div><!--/form-group-->
                <div class="form-group">
                  <label>Closing Date</label>
                  <datetime :input-class="[errors.date ? 'form-control is-invalid' : 'form-control']" 
                  v-model="date"
                  format="dd MMMM, yyyy"
                  :min-datetime="minDatetime"
                  auto
                  ></datetime>
                  <small class="text-warning" v-if="errors.date">{{errors.date[0]}}</small>
                </div><!--/form-group-->
                <button class="btn btn-danger" @click="saveProgramme">Save Programme</button>

            </div><!--/card-body-->
          </div><!--/card-->
          <!--/UNIVERSITY PROGRAMME-->

        </div><!--/col-->
      </div>
    </div><!--/container-fluid-->

    <div class="container-fluid mt-5">
      <div class="header-body">
        <h3>Showing all programme</h3>
        <!-- ITEM -->
        <div class="row">

          <div class="col-sm-6 mb-2" v-for="programme in programmes">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title">{{programme.name}}</h2>
                <h4 class="card-subtitle mb-2 text-muted">Closing Date: <b class="text-black">{{programme.closingDate}}</b></h4>
                <p class="card-text">{{programme.description}}</p>
              </div>
            </div>
          </div><!--/col-->

        </div><!--/row-->

        <!-- ITEM -->
      </div><!--/header-body-->
    </div><!--/container-fluid-->

  </div>
</template>

<script>
import moment from 'moment'
import NProgress from 'nprogress'
import { Datetime } from 'vue-datetime';

Vue.extend({
  template: '...',
  components: {
    datetime: Datetime
  }
});

export default{
  props:['univ_id'],
  data(){
    return{
      date:'',
      name:'',
      description:'',
      errors:[],
      programmes:[]
    }
  },
  computed:{
    minDatetime(){
      return moment().format()
    },
  },
  methods:{
    getData(){
      axios.get('/admin/get-programme/'+this.univ_id).then(res => {
        this.programmes = res.data 
      })
    },
    saveProgramme(){
      let date = moment(this.date).format('YYYY-MM-DD')
      let data = {
        name:this.name,
        description:this.description,
        closingDate:date,
        univ_id:this.univ_id
      }
      axios.post('/admin/save-programme',data).then(res => {
        swal('','Successfully to save programme','success').then((value) => {
          this.errors = []
          this.date = ''
          this.name = ''
          this.description = ''
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
  }
}
</script>
