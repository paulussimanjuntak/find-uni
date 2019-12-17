<template>
  <div class="container-fluid">
    <!-- Table -->
    <div class="row">
      <div class="col-12 m-b-20">

        <!--/LIST APPLICANT-->
        <div class="card shadow mt-7">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">List Applicant</h3>
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
                      Applicant Name
                    </th>
                    <th scope="col">
                      Applicant Status
                    </th>
                    <th scope="col">
                      Qualification Obtained
                    </th>
                    <th scope="col">
                      Score
                    </th>
                    <th scope="col">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody class="list">
                  <tr v-for="i,index in applications">
                    <td>{{index + 1}}</td>
                    <th scope="row">{{i.applicant.user.name}}</th>
                    <td>{{i.status}}</td>
                    <td>{{i.qual_obtained[0].qualification.name}}</td>
                    <td>{{i.qual_obtained[0].overallScore}}</td>
                    <td>
                      <button type="button" class="btn btn-outline-warning btn-sm" v-if="i.status == 'New'"
                        @click="getModal(i.applicant.user.name,i.qual_obtained[0].qualification.name,i.qual_obtained[0].overallScore,i.qual_obtained[0].result,i.applicant.user.email,i.id)">
                        <i class="far fa-eye"></i> Review
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div><!--/card-body-->
        </div><!--/card-->
        <!--/LIST APPLICANT-->

      </div><!--/col-->
    </div>

    <!-- Modal Show Application-->
    <transition enter-active-class="animated slideInDown fast" leave-active-class="animated slideOutUp fast" mode="out-in">
     <div class="modal fade show dis-block" v-if="modal_review">
       <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Applicant</h5>
             <button type="button" class="close" @click="modal_review = !modal_review">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             <p>Applicant Name : <span class="font-weight-bold">{{name}}</span></p>
             <p>Qualification Name : <span class="font-weight-bold">{{quals}}</span></p>
             <p>Score : <span class="font-weight-bold">{{score}}</span></p>
             <p>
               Results : <span v-for="item in result">{{item.subjectName}} {{item.grade}}, </span>
             </p>
           </div><!--/modal-body-->
           <div class="modal-footer">
             <button type="button" class="btn btn-success" @click="emailSuccess"><i class="far fa-check"></i> SUCCESSFUL</button>
             <button type="button" class="btn btn-danger" @click="emailUnsuccess"><i class="far fa-times"></i> UNSUCCESSFUL</button>
           </div>
         </div>
       </div>
     </div>
    </transition>
     <!-- Modal Show Application-->

  </div><!--/container-fluid-->
</template>

<script>
export default{
  props:['idd'],
  data(){
    return{
      modal_review:false,
      name:'',
      quals:'',
      score:'',
      email:'',
      id_application:'',
      result:[],
      applications:[]
    }
  },
  methods:{
    getData(){
      axios.get('/admin/get-application/'+this.idd).then(res => {
        this.applications = res.data
      })
    },
    getModal(name,quals,score,result,email,id){
      this.modal_review = true
      this.name = name
      this.quals = quals
      this.score = score
      this.result = result
      this.email = email
      this.id_application = id
    },
    emailSuccess(){
      axios.get('/admin/success-email/'+this.id_application).then(res => {
        swal('','Successfully to send email','success').then((value) => {
          this.modal_review = false
          this.getData()
        })
      })
    },
    emailUnsuccess(){
      axios.get('/admin/unsuccess-email/'+this.id_application).then(res => {
        swal('','Successfully to send email','success').then((value) => {
          this.modal_review = false
          this.getData()
        })
      })
    }
  },
  mounted(){
    this.getData()
  }
}
</script>
