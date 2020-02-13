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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});



function showMessage(){
  $('.sender').on('click', function () {
    /* console.log("sto cliccando") */
    if ($(this).siblings(".body_message").hasClass("d-none")){
      $(this).siblings(".body_message").fadeIn();
      $(this).siblings(".body_message").toggleClass("d-none");
    }else{
      $(this).siblings(".body_message").fadeOut();
      $(this).siblings(".body_message").toggleClass("d-none");
    }
  })
}

//funzione per personalizzare la nav in base all'indirizzo
function navbar() {
  console.log(window.location.href)

  var homePage = window.location.href;

  if (homePage == "http://localhost:3000/" || homePage == "http://localhost:8000/") {
    $(".my_nvb").addClass("nav_home").removeClass("bg-white shadow-sm")
    $(".my_nvb svg").addClass("my_svgW")
  } else {
    $(".my_nvb").removeClass("nav_home").addClass("bg-white shadow-sm")
    $(".my_nvb svg").addClass("my_svgR")
  }
}


function alertHide() {
  $(".alert").delay(3000).slideUp(300);
}

function showFooter(){
  $(".showFooter").on("click",function(){
    console.log("sto click")
  })
}


function init(){
  alertHide();
  showMessage();
  navbar();
  
    $(".showFooter").on("click", function () {
      /* console.log("sto click") */
      
      $("footer").toggleClass("d-none");
      if ($("footer").hasClass("d-none") == false){
        $("main").removeClass("my_margin_bottom")
        $(this).html("<i class='fas fa-times mr-2'></i> Chiudi")
      }else{
        $("main").addClass("my_margin_bottom")
        $(this).html("<i class='fas fa-info-circle mr-2'></i> Termini,privacy e altro");
      }
    })
  
}





$(document).ready(init);
