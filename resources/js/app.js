/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuex from 'vuex'


Vue.use(Vuex)



import mutations from './store/mutations'
import * as actions from './store/actions'
import * as getters from './store/getters'
import routes from "./commons/routes.js";

window.routes = routes;

const debug = process.env.NODE_ENV !== 'production';

const store = new Vuex.Store({
    state: {
        // array of grocery items
        items: [],
        token: "ASASDADsdfsdfSADFA!@#",
        // array of ongoing tasks. We keep track of the tasks to show/hide the
        // activity indicator in the groceries page.
        processingTasks: [],
        users: [],
        okrs: []
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
              console.log('set data to',response.data )
              data = response.data
              store.dispatch(action,response.data)
          })
          .catch(response => {console.log('there was an error',response) })

        return data;
      }

  }
})

const app = new Vue({
    store,
    el: '#app',
});
