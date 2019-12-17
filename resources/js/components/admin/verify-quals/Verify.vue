<template>
<div>
<div class="card">
  <!-- Card body -->
  <div class="card-body">
    <h5 class="h3 title">
      <span class="d-block hov-pointer text-primary" @click="modal_verify = !modal_verify">{{name}}</span>
    </h5>
    <p class="text-sm mb-0">A new qualification need to be verified.</p>
  </div>
</div><!--/card-->

 <!-- Modal -->
<transition enter-active-class="animated slideInDown fast" leave-active-class="animated slideOutUp fast" mode="out-in">
 <div class="modal fade show dis-block" v-if="modal_verify">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title">Verify Qualification</h5>
         <button type="button" class="close" @click="modal_verify = !modal_verify">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <table>
           <tr>
             <th>Qualification Name</th>
             <td>:</td>
             <td>{{name}}</td>
           </tr>
           <tr>
             <th>Minimum Score</th>
             <td>:</td>
             <td>{{min}}</td>
           </tr>
           <tr>
             <th>Maximum Score</th>
             <td>:</td>
             <td>{{max}}</td>
           </tr>
           <tr>
             <th>Grade List</th>
             <td>:</td>
             <td>
               <span v-for="item in gradelist">{{item.grade}}, </span>
             </td>
           </tr>
           <tr>
             <th>Overall Result</th>
             <td>:</td>
             <td>Average of best {{calculation}} Subjects</td>
           </tr>
         </table>
       </div><!--/modal-body-->
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" @click="modal_verify = !modal_verify">Close</button>
         <button type="button" class="btn btn-success" @click="updateQuals">Verify</button>
       </div>
     </div><!--/modal-content-->
   </div><!--/modal-dialog-->
 </div><!--/modal-->
</transition>

</div>
</template>

<script>
export default{
  props:['name','min','max','gradelist','calculation','idd'],
  data(){
    return{
      modal_verify:false
    }
  },
  methods:{
    updateQuals(){
      axios.put('/admin/update-verifyquals/'+this.idd).then(res => {
        swal('','Successfully to verify qualification','success').then((value) => {
          this.$emit('refresh')
        })
      })
    }
  }
}
</script>
