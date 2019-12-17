<template>
  <div>
    <transition enter-active-class="animated slideInDown fast" leave-active-class="animated slideOutUp fast" mode="out-in">
    <component :is="selected" :home="home" :univ_id="univ_id" :idd="idd"></component>
    </transition>
  </div>
</template>

<script>
import ListProgramme from './ListProgramme.vue'
import ListApplicant from './ListApplicant.vue'

export default{
  props:['idd','home','univ_id'],
  data(){
    return{
      selected:'',
    }
  },
  components:{
    appProgramme:ListProgramme,
    appApplicant:ListApplicant
  },
  mounted(){
    if(!this.idd) this.selected = 'appProgramme'
    else this.selected = 'appApplicant'
  }
}
</script>
