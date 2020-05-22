/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import $ from 'jquery';
// window.$ = window.jQuery = $;

window.Vue = require('vue');
Vue.component('pagination', require('laravel-vue-pagination'));
// import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'
// // Install BootstrapVue
// Vue.use(BootstrapVue);
// // // Optionally install the BootstrapVue icon components plugin
// Vue.use(IconsPlugin);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('index-component', require('./components/IndexComponent.vue').default);
Vue.component('favorite-component', require('./components/FavoriteComponent.vue').default);
Vue.component('my-books-component', require('./components/MyBooksComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

$(document).ready(function () {


    $('.rate').on('click', function (e) {

        console.log($(this).data('rate'));
        console.log($(this).data('book'));
        let val = $(this).data('rate');
        let id = $(this).data('book');
        axios.post('/bookRate ', {
            rate: val,
            book_id: id
        })
            .then(response =>{
                console.log(response);
                $(this).removeClass('fa-star-o').addClass('fa-star');
                $(this).prevAll('i').removeClass('fa-star-o').addClass('fa-star');
                $(this).nextAll('i').addClass('fa-star-o');
            })
            .catch(function (error) {
                console.log(error);
            });
    })

    $('.like').on('click', function (e) {

        let book_id = $(this).data('book');
        let user_id = $(this).data('user');
        axios.post("/api/makeLike", {
            book_id: book_id,
            user_id: user_id
        })
            .then(response => {
                $(this).toggleClass('fa-heart fa-heart-o');
                console.log(response);
            })
            .catch(error => {
                console.log(error);
            })

    })


}) 
