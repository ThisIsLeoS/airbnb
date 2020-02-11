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



/* function showMessage(){

  $('.message_apt').on('click',function(){

    $(this).siblings('.bodyMessage').toggleClass('d-none');
  })

}
 */
function init(){
  /* showMessage(); */
  console.log('hello word');

  //funzione countdown per utenti non autorizzati
  function startTimer(duration, display) {
    var timer = duration, seconds;
    setInterval(function () {
      seconds = parseInt(timer % 4);
      console.log(seconds)

      /* seconds = seconds < 10 ? "3" + seconds : seconds; */

      display.textContent = seconds + " secondi";

      if (--timer < 0) {
        timer = duration;
      }
    }, 1000);
  }

  window.onload = function () {
    var threeSec = 60 * 0.05,
      display = document.querySelector('#time');
    startTimer(threeSec, display);
  };

}

$(document).ready(init);
