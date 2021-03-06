import Vue from 'vue'
import VueResource from 'vue-resource'

import $ from 'jquery';
var jQuery = require('jquery');
window.$ = window.jQuery = jQuery;

import swal from 'sweetalert';
import App from './App.vue'

Vue.use(VueResource);

require('bootstrap/dist/css/bootstrap.min.css');
require('bootstrap');

require('font-awesome/css/font-awesome.css');

Vue.http.options.root = 'http://eduzz.api/api/v1';

new Vue({
  el: '#app',
  render: h => h(App)
})
