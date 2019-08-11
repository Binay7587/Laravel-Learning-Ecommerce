/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

global.$ = global.jQuery = require('jquery');

require ('./bootstrap');
require('../assets/js/app.js');
require('../assets/vendors/summernote/summernote-bs4');


setTimeout(function(){
    $('.alert').slideUp();
},4000);
