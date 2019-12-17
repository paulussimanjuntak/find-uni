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
                  <h3 class="mb-0">List of Qualification</h3>
                </div>
                <div class="col-auto align-self-end">
                  <button class="btn btn-icon btn-3 btn-primary btn-sm" type="button" @click="modal_add = !modal_add">
                    <span class="btn-inner--text"><i class="far fa-plus"></i></span> Add</span>
                  </button>
                </div><!--/col-->
              </div>
            </div><!--/card-header-->
          </div><!--/card-->
          <!--/SETUP QUALIFICATION-->

        </div><!--/col-->
      </div><!--/row-->

      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6" v-for="data in datas">
          <app-quals :name="data.name" :minimum="data.minimumScore" :maximum="data.maximumScore" :calculation="data.resultCalcDescription" :id="data.id" @refreshQuals="updateQuals">
          </app-quals>
        </div><!--/col-->
      </div><!--/row-->

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
                    placeholder="Qualification Name" v-model="quals.name">
                    <div class="invalid-feedback" v-if="errors.name">
                      {{errors.name[0]}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="minimumScore">Minimum Score</label>
                        <input type="text" class="form-control"  :class="[errors.minimum ? 'is-invalid' : '']"
                        placeholder="Minimum Score" v-model="quals.minimum">
                        <div class="invalid-feedback" v-if="errors.minimum">
                          {{errors.minimum[0]}}
                        </div>
                      </div>
                    </div><!--/col-6-->
                    <div class="col-6">
                      <div class="form-group">
                        <label for="maximumScore">Maximum Score</label>
                        <input type="text" class="form-control"  :class="[errors.maximum ? 'is-invalid' : '']"
                        placeholder="Maximum Score" v-model="quals.maximum">
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
                      v-model="quals.grade">
                      <div class="input-group-append">
                        <button class="btn btn-default" type="button" id="button-addon2" @click="addQuals">Add</button>
                      </div>
                      <div class="invalid-feedback" v-if="errors.list_grade">
                        {{errors.list_grade[0]}}
                      </div>
                    </div><!--/input-group-->

                    <select class="custom-select">
                      <option selected disabled>List Grade</option>
                      <option :value="grade" v-for="grade in quals.list_grade">{{grade}}</option>
                    </select>
                  </div><!--/form-group-->

                  <div class="form-group">
                    <label for="result">Calculation of Overall Result</label>
                    <textarea class="form-control" :class="[errors.calculation ? 'is-invalid' : '']"
                      rows="3" placeholder="Calculation of Overall Result" 
                      v-model="quals.calculation"></textarea>
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

    </div><!--/container-fluid-->
  </div>
</template>

<script>
import NProgress from 'nprogress'
import Qualification from './Qualification.vue'

export default{
  data(){
    return{
      modal_add: false,
      quals:{
        name:'',
        minimum:'',
        maximum:'',
        grade:'',
        list_grade:[],
        calculation:''
      },
      errors:[],
      datas:[]
    }
  },
  methods:{
    getData(){
      axios.get('/admin/data-quals').then(res => {
        this.datas = res.data
      })
    },
    addQuals(){
      this.quals.list_grade.push(this.quals.grade)
      this.quals.grade = ''
    },
    saveQuals(){
      axios.post('/admin/save-quals',this.quals).then(res => {
        swal('','Successfully to add qualification','success').then((value) => {
          this.errors = []
          this.quals.name = ''
          this.quals.minimum = ''
          this.quals.maximum = ''
          this.quals.grade = ''
          this.quals.list_grade = []
          this.quals.calculation = ''
          this.modal_add = false
          this.getData()
        })
      }).catch(err => {
        this.errors = err.response.data
        NProgress.done()
      })
    },
    updateQuals(){
      this.getData()
    }
  },
  components:{
    appQuals:Qualification
  },
  mounted(){
    this.getData()
  }
}
</script>
