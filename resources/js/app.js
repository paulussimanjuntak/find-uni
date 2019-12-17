
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('setup-qualification', require('./components/admin/setup-qualification/SetupQualification.vue').default);
Vue.component('register-university', require('./components/admin/register-univ/RegisterUniversity.vue').default);
Vue.component('record-programme', require('./components/admin/RecordProgramme.vue').default);
Vue.component('review-applications', require('./components/admin/review-applications/ReviewApplications.vue').default);
Vue.component('search-programme', require('./components/admin/search-programme/SearchProgramme.vue').default);
Vue.component('verify-quals', require('./components/admin/verify-quals/VerifyQuals.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import NProgress from 'nprogress'
import 'nprogress/nprogress.css'
axios.interceptors.request.use(config => {
  NProgress.start()
  return config
})
axios.interceptors.response.use(res => {
  NProgress.done()
  return res
})

import Datetime from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime.css'

Vue.use(Datetime)

const app = new Vue({
    el: '#app'
});
