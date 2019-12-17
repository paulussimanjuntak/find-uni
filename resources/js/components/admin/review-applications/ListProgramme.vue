<template>
  <div class="container-fluid">
    <!-- Table -->
    <div class="row">
      <div class="col-12 m-b-20">

        <!--/LIST PROGRAMME-->
        <div class="card shadow mt-7">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">List Programme</h3>
              </div>
            </div>
          </div><!--/card-header-->

          <div class="card-body">
            <div class="table-responsive">
              <table class="table align-items-center">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">
                      No
                    </th>
                    <th scope="col">
                      Programme Name
                    </th>
                    <th scope="col">
                      Closing Date
                    </th>
                    <th scope="col">
                      Number of Applicant
                    </th>
                    <th scope="col" class="modif">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(programme,index) in programmes">
                    <td>{{index + 1}}</td>
                    <th scope="row">{{programme.name}}</th>
                    <td>{{programme.closingDate}}</td>
                    <td>{{programme.application.length}}</td>
                    <td v-if="programme.application.length > 0">
                      <button type="button" class="btn btn-outline-warning btn-sm" @click="showApplicant(programme.id)">
                        <i class="far fa-eye"></i> Show
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div><!--/card-body-->
        </div><!--/card-->
        <!--/LIST PROGRAMME-->

      </div><!--/col-->
    </div>

  </div><!--/container-fluid-->
</template>

<script>

export default{
  props:['home','univ_id'],
  data(){
    return{
      programmes:[],
      numbers:[]
    }
  },
  methods:{
    getData(){
      axios.get('/admin/get-programme/'+this.univ_id).then(res =>{
        this.programmes = res.data
      })
    },
    showApplicant(id){
      location.href = this.home + '/admin/review-applications/'+id
    },
  },
  mounted(){
    this.getData()
  }
}
</script>

<style scoped>
.tableFixHead{ 
  overflow-y: auto; height: 200px; 
}
.tableFixHead thead th{ 
  position: sticky; top: 0; 
}

table{ 
  border-collapse: collapse; width: 100%; 
}
.modif{
  z-index: 999999;
}
</style>
