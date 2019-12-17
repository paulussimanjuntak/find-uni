<template>
  <div>
    <div class="card card-stats mb-4 mb-lg-4">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h2 class="h4 font-weight-bold mb-0">
              <span class="text-default">Name : </span>
              <span class="text-nowrap">{{name}}</span>
            </h2>
            <p class="card-title text-muted mb-0">
              <span class="text-default">Maximum Score : </span>
              <span class="text-nowrap">{{maximum}}</span>
            </p>
          </div><!--/col-->
          <button type="button" class="btn btn-outline-warning btn-sm" @click="modal_edit = !modal_edit">
            <i class="far fa-edit"></i> Edit
          </button>
        </div><!--/row-->
      </div><!--/card-body-->
    </div><!--/card-->

    <!-- Modal Edit Qualification -->
    <transition enter-active-class="animated slideInDown fast" leave-active-class="animated slideOutUp fast" mode="out-in">
      <div class="modal fade show dis-block" v-if="modal_edit">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Qualification</h5>
              <button type="button" class="close" @click="modal_edit = !modal_edit">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="qualificationName">Qualification Name</label>
                  <input type="text" class="form-control" :class="[errors.name ? 'is-invalid' : '']"
                  placeholder="Qualification Name" v-model="quals.name">
                  <div class="invalid-feedback" v-if="errors.name">
                    {{errors.name[0]}}
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="minimumScore">Minimum Score</label>
                      <input type="text" class="form-control" :class="[errors.minimum ? 'is-invalid' : '']" 
                      placeholder="Minimum Score" v-model="quals.minimum">
                      <div class="invalid-feedback" v-if="errors.minimum">
                        {{errors.minimum[0]}}
                      </div>
                    </div>
                  </div><!--/col-6-->
                  <div class="col-6">
                    <div class="form-group">
                      <label for="maximumScore">Maximum Score</label>
                      <input type="text" class="form-control" :class="[errors.maximum ? 'is-invalid' : '']"
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
                    <input type="text" class="form-control" placeholder="List of Possible Grade" aria-describedby="button-addon2"
                    :class="[errors_grade.grade ? 'is-invalid' : '']" v-model="grade" :disabled="!selected">
                    <div class="input-group-append">
                      <button class="btn btn-danger" type="button" @click="updateGrade">Update</button>
                    </div>
                    <div class="invalid-feedback" v-if="errors_grade.grade">
                      {{errors_grade.grade[0]}}
                    </div>
                  </div><!--/input-group-->

                  <select class="custom-select" v-model="selected">
                    <option selected disabled value="">List Grade</option>
                    <option :value="data.id" v-for="data in grades">{{data.grade}}</option>
                  </select>
                </div><!--/form-group-->

                <div class="form-group">
                  <label for="result">Calculation of Overall Result</label>
                  <textarea class="form-control" rows="3" :class="[errors.calculation ? 'is-invalid' : '']"
                    placeholder="Calculation of Overall Result" v-model="quals.calculation">
                  </textarea>
                  <div class="invalid-feedback" v-if="errors.calculation">
                    {{errors.calculation[0]}}
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" @click="modal_edit = !modal_edit">Close</button>
              <button type="button" class="btn btn-primary" @click="updateQuals">Update Qualification</button>
            </div>
          </div>
        </div>
      </div>
    </transition>
    <!-- Modal Edit Qualification -->
  </div>
</template>

<script>
import NProgress from 'nprogress'

export default{
  props:['name','minimum','maximum','calculation','id'],
  data(){
    return{
      modal_edit: false,
      selected:'',
      grade:'',
      grades:[],
      errors_grade:[],
      errors:[],
      quals:{
        name:this.name,
        minimum:this.minimum,
        maximum:this.maximum,
        calculation:this.calculation
      }
    }
  },
  methods:{
    getData(){
      axios.get('/admin/data-gradelist/'+this.id).then(res => {
        this.grades = res.data
      })
    },
    updateGrade(){
      if(this.selected){
        axios.put('/admin/update-grade/'+this.selected,{grade:this.grade}).then(res => {
          swal('','Successfully to update grade','success').then((value) => {
            this.getData()
            this.errors_grade = []
            this.selected = ''
            this.grade = ''
          })
        }).catch(err => {
          this.errors_grade = err.response.data
          NProgress.done()
        })
      }
    },
    updateQuals(){
      axios.put('/admin/update-quals/'+this.id,this.quals).then(res => {
        swal('','Successfully to update qualification','success').then((value) => {
          this.modal_edit = false
          this.errors = []
          this.$emit('refreshQuals')
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
        axios.get('/admin/get-grade/'+val).then(res => {
          this.grade = res.data.grade
        })
      }
    }
  },
  mounted(){
    this.getData()
  }
}
</script>
