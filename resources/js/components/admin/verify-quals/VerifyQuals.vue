<template>
  <div>
    <div class="container-fluid">
      <!-- Table -->
      <div class="row">
        <div class="col-12 m-b-20">

          <!--/SETUP QUALIFICATION-->
          <div class="card shadow mt-7">
            <div class="card-header">
              <div class="row">
                <div class="col">
                  <h3 class="mb-0">Request of Qualification</h3>
                </div>
              </div>
            </div><!--/card-header-->
          </div><!--/card-->
          <!--/SETUP QUALIFICATION-->

        </div><!--/col-->
      </div><!--/row-->

      <div class="row">
        <div class="col-lg-4 col-sm-6 m-b-15" v-for="item in verifys">
          <app-verify :name="item.name" :min="item.minimumScore" :max="item.maximumScore" :gradelist="item.gradelist"
            :calculation="item.resultCalcDescription" :idd="item.id" @refresh="refreshData">
          </app-verify>
        </div><!--/col-->
      </div><!--/row-->

    </div><!--/container-fluid-->

  </div>
</template>

<script>
import Verify from './Verify.vue'

export default{
  data(){
    return{
      verifys:[]
    }
  },
  methods:{
    getData(){
      axios.get('/admin/get-verifyquals').then(res => {
        this.verifys = res.data
      })
    },
    refreshData(){
      this.getData()
    }
  },
  components:{
    appVerify:Verify
  },
  mounted(){
    this.getData()
  }
}
</script>
