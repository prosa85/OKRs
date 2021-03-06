/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import UsersComponent from "./components/UsersComponent";

require('./bootstrap');


import 'bootstrap-vue/dist/bootstrap-vue.css'

window.Vue = require('vue');
import Vuex from 'vuex'
import VueRouter from 'vue-router'
import mutations from './store/mutations'
import * as actions from './store/actions'
import * as getters from './store/getters'
import routes from "./commons/routes.js";
window.moment = require('moment')
import BootstrapVue from 'bootstrap-vue'

window.routes = routes;


const debug = process.env.NODE_ENV !== 'production';

Vue.use(BootstrapVue)
Vue.use(Vuex)
Vue.use(VueRouter)
Vue.prototype.moment = moment

const store = new Vuex.Store({
    state: {
        // array of grocery items
        items: [],
        expanded:{view:false, tasks:false},
        token: "ASASDADsdfsdfSADFA!@#",
        // array of ongoing tasks. We keep track of the tasks to show/hide the
        // activity indicator in the groceries page.
        processingTasks: [],
        users: [],
        okrs: [],
        okr:{},
        okrs_statuses:[]
    },
    mutations,
    actions,
    getters,
    strict: debug
});


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.mixin({
  methods: {
    getData(route, model = 'default',action) {
      console.log('calling getData')
      let data = [];
      axios.get(route)
          .then(response => {
              console.log('set data to' + model  )
              data = response.data
              store.dispatch(action,response.data)
          })
          .catch(response => {console.log('there was an error',response) })

        return data;
      },
      addBr(text){
        if (text)
        return text.replace(/;/g,'\n')
      },
      postData(route,  data, isComment = false){
        self = this
          return new Promise((resolve, reject)=> {

              axios.post(route, data).then(function(response) {
                  if (isComment === true) {
                      self.$store.dispatch('setOkrComment', response.data)
                  }
                  self.$bvToast.toast(`Data Saved`, {
                      title: 'Server Response: Create',
                      autoHideDelay: 2000,
                      variant: 'primary',
                      solid: true
                  })
                  resolve()
              }).catch(function(response) {
                  self.$bvToast.toast(`Something went wrong`, {
                      title: 'Server Response',
                      autoHideDelay: 2000,
                      variant: 'danger',
                      solid: true
                  })
                  console.log('error' + response)
              })
          })
      },
      putData(route,  data){
          self = this
          return new Promise((resolve, reject)=> {
              axios.put(route, data).then(function(response) {
                  self.$bvToast.toast(`Data Updated`, {
                      title: 'Server Response: Update',
                      autoHideDelay: 2000,
                      variant: 'success',
                      solid: true
                  })
                  resolve()
              }).catch(function(response) {
                  console.log('error' + response)
              })
          })
      },
      deleteData(route, id){
        axios.delete(route, id).then(function(response){
            console.log('deleted')
        })
      },
      getStyle(status){
          return 'status-' +  status.toLowerCase()
      },
      copyComputed(comp){
          return JSON.parse(JSON.stringify(comp))
      },
      getCardBorderStatus(status) {
            let border = {
                Active: 'primary',
                Hold:'danger',
                Completed:'success'
            }
            return border[status]
      },

  }
});
import okrs from './components/okrs.vue';
import users from './components/UsersComponent.vue';
import okrview from './components/okrView.vue';

const vr = [
    {path:'/', component: okrs, name:'home'},
    { path: '/okrs', component: okrs , name:'okrs'},
    { path: '/okrs/:id', component: okrview, name:'okrs.show' },
    { path: '/users', component: users }
];
const vrouter = new VueRouter({
    routes: vr,
    mode: 'history',
    linkActiveClass:'active'
});


const app = new Vue({
    store,
    router: vrouter

}).$mount('#app');
