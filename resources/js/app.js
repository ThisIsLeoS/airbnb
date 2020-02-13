// @ts-check

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

  $('.message_apt').on('click',function(){

    $(this).siblings('.bodyMessage').toggleClass('d-none');
  })

}

function init(){
  showMessage();

  // eventi
  $("#create-apt-form").submit(function(event) {
    // la sottomissione del form viene abortita
    event.preventDefault();
    var thisForm = $(this);
    $.ajax({
      "url": "https://api.tomtom.com/search/2/structuredGeocode.json/", 
      "method": "GET",
      "data": {
        "key": "PkKS2dAj8BrmI6ki7jkQEXlEbn5AkjKp",
        "limit": "1", // opzione per farsi restituire solo 1 risultato
        "streetName": "Via Milano",
        "streetNumber": "15",
        "municipality": "Genova",
        "postalCode": "16126",
        "countrySubdivision": "Liguria",
        "countryCode": "IT"
      },
      "success": function (data) {
        thisForm
          // al form vengono aggiunti i campi contenenti longitudine e latitudine
          .append(
            "<input type='hidden' name='lat' value='" + data.results[0].position.lat + "'/>",
            "<input type='hidden' name='lon' value='" + data.results[0].position.lon + "'/>"
          )
          // il form viene sottomesso
          .submit();
      },
      "error": function (iqXHR, textStatus, errorThrown) {
        alert(
          "iqXHR.status: " + iqXHR.status + "\n" +
          "textStatus: " + textStatus + "\n" +
          "errorThrown: " + errorThrown
        );
      }
    });
  });
}

$(document).ready(init);
