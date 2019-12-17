<template>
  <div>
    <div class="card card-stats mb-4 mb-lg-4">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h2 class="h3 font-weight-bold">
              <span>{{university}} - {{name}}</span>
            </h2>
            <p class="card-text fs-12 text-black">{{description}}</p>
            <p class="card-subtitle mb-2 text-muted">
              <small>Closing Date: 
                <b class="text-danger">{{closingDate}}</b>
              </small></p>
          </div><!--/col-->
          <div class="col-auto">
            <button type="button" class="btn btn-warning btn-sm" @click="modal_apply = !modal_apply">Apply</button>
          </div>
        </div><!--/row-->
      </div><!--/card-body-->
    </div><!--/card-->

    <transition enter-active-class="animated slideInDown fast" leave-active-class="animated slideOutUp fast" mode="out-in">
    <!-- Modal Apply -->
    <div class="modal fade show dis-block" v-if="modal_apply">
      <div class="modal-dialog modal-dialog-centered w-600" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Applying {{name}} on {{university}}</h5>
            <button type="button" class="close" @click="modal_apply = !modal_apply">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-6">
                <div class="form-group mb-0">
                  <label for="qualificationName">Choose Qualification</label>
                  <select class="custom-select" v-model="selected">
                    <option selected disabled>Choose qualification</option>
                    <option :value="qual.id" v-for="qual in quals">{{qual.name}}</option>
                  </select>
                </div><!--/form-group-->
                <small class="form-text text-muted">Qualification not listed? <a class="text-primary hov-pointer" @click="modal_add = !modal_add">Add now</a></small>
              </div><!--/col-->
              <div class="col-6">
                <div class="form-group mb-0">
                  <label for="qualificationName">Grading List</label><br>
                  <p v-if="gradelist.length > 0">
                    <span v-for="grade in gradelist">~ {{grade.grade}} </span>
                  </p>
                  <p v-else>-</p>
                </div><!--/form-group-->
              </div><!--/col-->
            </div><!--/row-->

            <div class="row mt-3">
              <div class="col-5 p-r-0">
                <div class="form-group mb-0">
                  <label for="qualificationName">Add Subject</label>
                  <input type="text" class="form-control" placeholder="Subject Name" v-model="addSubject">
                </div><!--/form-group-->
              </div><!--/col-->
              <div class="col-5 p-r-0">
                <div class="form-group mb-0">
                  <label for="qualificationName">Add Grade</label>
                  <input type="text" class="form-control" placeholder="Grade" v-model="addGrade">
                </div><!--/form-group-->
              </div><!--/col-->
              <div class="col-2">
                <div class="form-group mb-0">
                  <label for="qualificationName" style="color:#fff;">sajhdjake</label>
                  <button class="btn btn-default" type="button" :disabled="checkSubmit" @click="submitSubject">Submit</button>
                </div><!--/form-group-->
              </div><!--/col-->
            </div><!--/row-->
            <p class="form-text text-muted fs-12 is-unselecable">
              <span>Max. Subject : <b class="text-default">{{length_data}}</b></span> &nbsp;
              <span>Min. Grade : <b class="text-default">{{min}}</b></span> &nbsp;
              <span>Max. Grade : <b class="text-default">{{max}}</b></span>
            </p>

            <div class="row mt-4">
              <div class="col-12">
                <div class="form-group mb-1">
                  <label><b>Your subject ...</b></label>
                </div><!--/form-group-->
                <div class="table-responsive">
                  <div class="tableFixHead">
                    <table class="table align-items-center table-sm">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col">Subject</th>
                          <th scope="col">Grade</th>
                        </tr>
                      </thead>
                      <tbody class="list">
                        <tr v-for="i in subjects">
                          <td>{{i.subject}}</td>
                          <td>{{i.grade}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div><!--/table-responsive-->
              </div><!--/col-->
            </div><!--/row-->
          </div><!--/modal-body-->

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="modal_apply = !modal_apply">Close</button>
            <button type="button" class="btn btn-primary" :disabled="checkReady" @click="applyProgramme">Apply</button>
          </div>
        </div>
      </div>
    </div><!--/modal-->
    <!-- Modal Apply -->
    </transition>

    <!-- Modal Add Qualification -->
    <transition enter-active-class="animated slideInDown fast" leave-active-class="animated slideOutUp fast" mode="out-in">
      <div class="modal fade show dis-block" v-if="modal_add">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Qualification</h5>
              <button type="button" class="close" @click="modal_add = !modal_add">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="qualificationName">Qualification Name</label>
                  <input type="text" class="form-control"  :class="[errors.name ? 'is-invalid' : '']"
                  placeholder="Qualification Name" v-model="qualss.name">
                  <div class="invalid-feedback" v-if="errors.name">
                    {{errors.name[0]}}
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="minimumScore">Minimum Score</label>
                      <input type="text" class="form-control"  :class="[errors.minimum ? 'is-invalid' : '']"
                      placeholder="Minimum Score" v-model="qualss.minimum">
                      <div class="invalid-feedback" v-if="errors.minimum">
                        {{errors.minimum[0]}}
                      </div>
                    </div>
                  </div><!--/col-6-->
                  <div class="col-6">
                    <div class="form-group">
                      <label for="maximumScore">Maximum Score</label>
                      <input type="text" class="form-control"  :class="[errors.maximum ? 'is-invalid' : '']"
                      placeholder="Maximum Score" v-model="qualss.maximum">
                      <div class="invalid-feedback" v-if="errors.maximum">
                        {{errors.maximum[0]}}
                      </div>
                    </div>
                  </div><!--/col-6-->
                </div><!--/row-->

                <div class="form-group">
                  <label for="grade">List of Possible Grade</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" :class="[errors.list_grade ? 'is-invalid' : '']"
                    placeholder="List of Possible Grade" aria-describedby="button-addon2"
                    v-model="qualss.grade">
                    <div class="input-group-append">
                      <button class="btn btn-default" type="button" id="button-addon2" @click="addQuals">Add</button>
                    </div>
                    <div class="invalid-feedback" v-if="errors.list_grade">
                      {{errors.list_grade[0]}}
                    </div>
                  </div><!--/input-group-->

                  <select class="custom-select">
                    <option selected disabled>List Grade</option>
                    <option :value="grade" v-for="grade in qualss.list_grade">{{grade}}</option>
                  </select>
                </div><!--/form-group-->

                <div class="form-group">
                  <label for="result">Calculation of Overall Result</label>
                  <textarea class="form-control" :class="[errors.calculation ? 'is-invalid' : '']"
                    rows="3" placeholder="Calculation of Overall Result" 
                    v-model="qualss.calculation"></textarea>
                    <div class="invalid-feedback" v-if="errors.calculation">
                      {{errors.calculation[0]}}
                    </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" @click="modal_add = !modal_add">Close</button>
              <button type="button" class="btn btn-primary" @click="saveQuals">Save Qualification</button>
            </div>
          </div>
        </div>
      </div>
    </transition>
    <!-- Modal Add Qualification -->

    <transition enter-active-class="animated slideInDown fast" leave-active-class="animated slideOutUp fast" mode="out-in">
    <!-- Modal Applicant -->
    <div class="modal fade show dis-block" v-if="modal_applicant">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Complete your data</h5>
            <button type="button" class="close" @click="modal_applicant = !modal_applicant">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>ID Type</label>
              <input type="text" class="form-control" :class="[errors_applicant.idtype ? 'is-invalid' : '']" 
              v-model="applicant.idtype" placeholder="e.g MyKad or passport">
              <div class="invalid-feedback" v-if="errors_applicant.idtype">
                {{errors_applicant.idtype[0]}}
              </div>
            </div><!--/form-group-->
            <div class="form-group">
              <label>ID Number</label>
              <input type="text" class="form-control" :class="[errors_applicant.idnumber ? 'is-invalid' : '']"
              v-model="applicant.idnumber" placeholder="ID Number">
              <div class="invalid-feedback" v-if="errors_applicant.idnumber">
                {{errors_applicant.idnumber[0]}}
              </div>
            </div><!--/form-group-->
            <div class="form-group">
              <label>Mobile No.</label>
              <input type="text" class="form-control" :class="[errors_applicant.mobile ? 'is-invalid' : '']"
              v-model="applicant.mobile" placeholder="Mobile Number">
              <div class="invalid-feedback" v-if="errors_applicant.mobile">
                {{errors_applicant.mobile[0]}}
              </div>
            </div><!--/form-group-->
            <div class="form-group">
              <label>Date of Birth</label>
              <datetime :input-class="[errors_applicant.date ? 'form-control is-invalid' : 'form-control']" 
              v-model="applicant.date"
              format="dd MMMM, yyyy"
              auto
              ></datetime>
              <small class="text-warning" v-if="errors_applicant.date">{{errors_applicant.date[0]}}</small>
            </div><!--/form-group-->
          </div><!--/modal-body-->

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="modal_applicant = !modal_applicant">Close</button>
            <button type="button" class="btn btn-primary" @click="saveApplicant">Save</button>
          </div>
        </div>
      </div>
    </div><!--/modal-->
    <!-- Modal Applicant -->
    </transition>
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
  props:['university','name','description','closingDate','auth','home','check','programme_id'],
  data(){
    return{
      selected:'',
      addSubject:'',
      addGrade:'',
      overall_score:0,
      modal_apply:false,
      modal_add:false,
      modal_applicant:false,
      applicant:{
        idtype:'',
        idnumber:'',
        mobile:'',
        date:''
      },
      errors_applicant:[],
      quals:[],
      gradelist:[],
      subjects:[],
      penentu:'',
      length_data:0,
      min:0,
      max:0,
      qualss:{
        name:'',
        minimum:'',
        maximum:'',
        grade:'',
        list_grade:[],
        calculation:''
      },
      errors:[],
    }
  },
  methods:{
    getQuals(){
      axios.get('/get-quals').then(res => {
        this.quals = res.data
      })
    },
    submitSubject(){
      if(this.subjects.length !== this.length_data){
        let grade = Number(this.addGrade)
        if(isNaN(grade)){
          swal('','Upps grade must number','error')
        }else{
          if(grade > this.min && grade <= this.max){
            this.subjects.push({'subject':this.addSubject,'grade':grade})
            this.addSubject = ''
            this.addGrade = ''
          }else swal('','Upss grade must beetween '+this.min+' - '+this.max,'error')
        }
      }
    },
    applyProgramme(){
      if(this.selected && this.subjects.length == this.length_data){
        let num = []
        _.forEach(this.subjects, val => {
          num.push(val.grade)
        })
        let score = 0
        if(this.penentu == 'Unified Examination Certificate' || this.penentu == 'International Baccalaureate') score = _.sum(num)
        else score = _.sum(num) / num.length

        this.overall_score = score.toFixed(2)

        let data = {
          programme_id:this.programme_id,
          overall_score:this.overall_score,
          qualification_id:this.selected,
          result:this.subjects
        }

        axios.post('/apply-application',data).then(res => {
          swal('','Successfully to apply programme','success').then((value) => {
            this.subjects = []
            this.gradelist = []
            this.selected = ''
            this.overall_score = 0
            this.length_data = 0
            this.min = 0
            this.max = 0
            this.penentu = ''
            this.modal_apply = false
          })
        })

      }
    },
    saveApplicant(){
      let date = moment(this.applicant.date).format('YYYY-MM-DD')
      let data = {
        idtype:this.applicant.idtype,
        idnumber:this.applicant.idnumber,
        mobile:this.applicant.mobile,
        date:date
      }
      axios.post('/save-applicant',data).then(res => {
        swal('','Successfully to register as applicant','success').then((value) => {
          location.reload()
        })
      }).catch(err => {
        this.errors_applicant = err.response.data
        NProgress.done()
      })
    },
    addQuals(){
      this.qualss.list_grade.push(this.qualss.grade)
      this.qualss.grade = ''
    },
    saveQuals(){
      axios.post('/save-quals',this.qualss).then(res => {
        swal('','Wait for response sas admin to verified','success').then((value) => {
          this.errors = []
          this.qualss.name = ''
          this.qualss.minimum = ''
          this.qualss.maximum = ''
          this.qualss.grade = ''
          this.qualss.list_grade = []
          this.qualss.calculation = ''
          this.modal_add = false
        })
      }).catch(err => {
        this.errors = err.response.data
        NProgress.done()
      })
    }
  },
  watch:{
    selected(val){
      if(val){
        this.subjects = []
        this.overall_score = 0
        axios.get('/get-gradelist/'+val).then(res => {
          this.penentu = res.data.name
          this.max = Number(res.data.maximumScore)
          this.min = Number(res.data.minimumScore)
          this.length_data = Number(res.data.resultCalcDescription)
          this.gradelist = res.data.gradelist
        })
      }
    },
    modal_add(val){
      if(val){
        this.modal_add = true
        this.modal_apply =false
      }else{
        this.modal_apply = true
        this.modal_add = false
      }
    },
    modal_apply(){
      if(!this.auth){
        this.modal_apply = false
        location.href = this.home + '/login'
      }
      if(this.auth && this.check == 0){
        this.modal_apply = false
        this.modal_applicant = true
      }
    }
  },
  computed:{
    checkReady(){
      if(this.selected && this.subjects.length == this.length_data) return false
      else return true
    },
    checkSubmit(){
      if(this.subjects.length !== this.length_data) return false
      else return true
    }
  },
  mounted(){
    this.getQuals()
  }
}
</script>

<style>
.vdatetime-overlay{
  background:transparent !important;
}
</style>

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
