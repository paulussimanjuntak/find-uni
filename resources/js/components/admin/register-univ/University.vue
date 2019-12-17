<template>
  <div>
    <!--LIST UNIVERSITY-->
     <div class="card w-100">
       <!-- Card body -->
       <div class="card-body p-t-5 p-b-0 p-r-10 p-l-10">
         <div class="pt-2 text-center">
           <h5 class="h3 title">
             <span class="d-block">{{name}}</span>
           </h5>
           <div class="mt-1 m-b-15">
             <center>
               <a class="btn btn-default btn-sm m-r-0 text-secondary" @click="modal_add = !modal_add">Add Admin</a>
               <a class="btn btn-primary btn-sm m-r-0 text-secondary" @click="modal_show = !modal_show">Show Admin</a>
             </center>
           </div>
         </div>
       </div>
     </div><!--/card-->
    <!-- /LIST UNIVERSITY-->

    <transition enter-active-class="animated slideInDown fast" leave-active-class="animated slideOutUp fast" mode="out-in">
    <!-- Modal Add University Admin-->
    <div class="modal fade show dis-block" v-if="modal_add">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add {{name}} Admin</h5>
            <button type="button" class="close" @click="modal_add = !modal_add">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" :class="[errors.username ? 'is-invalid' : '']"
                placeholder="Username" v-model="admin.username">
                <div class="invalid-feedback" v-if="errors.username">
                  {{errors.username[0]}}
                </div>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" :class="[errors.password ? 'is-invalid' : '']"
                placeholder="Password" v-model="admin.password">
                <div class="invalid-feedback" v-if="errors.password">
                  {{errors.password[0]}}
                </div>
              </div>
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" :class="[errors.name ? 'is-invalid' : '']"
                placeholder="Name" v-model="admin.name">
                <div class="invalid-feedback" v-if="errors.name">
                  {{errors.name[0]}}
                </div>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" :class="[errors.email ? 'is-invalid' : '']"
                placeholder="Email" v-model="admin.email">
                <div class="invalid-feedback" v-if="errors.email">
                  {{errors.email[0]}}
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="modal_add = !modal_add">Close</button>
            <button type="button" class="btn btn-primary" @click="addAdmin">Save university admin</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Add University Admin-->
    </transition>

    <transition enter-active-class="animated slideInDown fast" leave-active-class="animated slideOutUp fast" mode="out-in">
    <!-- Modal Show University Admin-->
    <div class="modal fade show dis-block" v-if="modal_show">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">List {{name}} Admin</h5>
            <button type="button" class="close" @click="modal_show = !modal_show">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="table-responsive">
              <div>
                <table class="table align-items-center">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Username</th>
                      <th scope="col">Email</th>
                    </tr>
                  </thead>
                  <tbody class="list">
                    <tr v-for="user in admins">
                      <td class="status">{{user.username}}</td>
                      <td class="status">{{user.email}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div><!--/table-responsive-->
          </div><!--/modal-body-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="modal_show = !modal_show">Close</button>
          </div>
        </div>
      </div>
    </div>
    </transition>
    <!-- Modal Show University Admin-->
  </div>
</template>

<script>
import NProgress from 'nprogress'

export default{
  props:['name','id'],
  data(){
    return{
      modal_add:false,
      modal_show:false,
      errors:[],
      admins:[],
      admin:{
        username:'',
        password:'',
        name:'',
        email:'',
        univ_id:this.id
      }

    }
  },
  methods:{
    addAdmin(){
      axios.post('/admin/add-admin',this.admin).then(res => {
        swal('','Successfully to add admin','success').then((value) => {
          this.modal_add = false
          this.errors = []
          this.admin.username = ''
          this.admin.password = ''
          this.admin.name = ''
          this.admin.email = ''
        })
      }).catch(err => {
        this.errors = err.response.data
        NProgress.done()
      })
    }
  },
  watch:{
    modal_add(){
      this.errors = []
      this.admin.username = ''
      this.admin.password = ''
      this.admin.name = ''
      this.admin.email = ''
    },
    modal_show(val){
      if(val == true){
        axios.get('/admin/show-admin/'+this.id).then(res => {
          this.admins = res.data
        })
      }
    }
  }
}
</script>
