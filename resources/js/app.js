
// @ts-check

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


/* import Vue from 'vue/types/umd'; */

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

/* import * as $ from 'jquery';
window.$ = window.jQuery = $;

import 'jquery-ui/ui/widgets/datepicker.js'; */

const app = new Vue({
    el: '#myVue',
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

 



function init(){
  alertHide();
  showMessage();
  navbar();

 

  $(".showFooter").on("click", function () {
    /* console.log("sto click") */
    
    $("footer").toggleClass("d-none");
    if ($("footer").hasClass("d-none") == false) {
      $(this).html("<i class='fas fa-times mr-2'></i> Chiudi")
      $("main").addClass("my_margin_bottom")
     

        window.scrollBy({
          top: 1000,
          left: 0,
          behavior: 'smooth'
        });
     
    } else {
      $("main").removeClass("my_margin_bottom")
      $(this).html("<i class='fas fa-info-circle mr-2'></i> Termini,privacy e altro");
      
    }
  })

  // eventi
  $("#create-aptm-btn").click(function(event) {
    // la sottomissione del form viene abortita
    event.preventDefault();
    geocode($("#address").val(), "#create-aptm-form");
  });

  $("#mySearch button").click(function(event) {
    event.preventDefault();    
    geocode($("#address-to-search").val(), "#mySearch");
  });

  $("#mySearch #address-to-search").keyup(delay(function () {
      $("#addressesList").empty();
      if (($("#address-to-search").val()).length >= 3) {
        autoComplete($("#address-to-search").val());
      }
    }, 500)
  );
  
  $(document).on("click", "li", function () {
    $("#address-to-search").val($(this).text());
    $("#addressesList").fadeOut();
  });
  
  function delay(callback, ms) {
    var timer = 0;
    return function () {
      var context = this,
      args = arguments;
      clearTimeout(timer);
      timer = setTimeout(function () {
        callback.apply(context, args);
      }, ms || 0);
    }
  }

  function geocode(query, formId) {
    $.ajax({
      "url": "https://api.tomtom.com/search/2/geocode/" + query + ".json",
      "method": "GET",
      "data": {
        "key": "PkKS2dAj8BrmI6ki7jkQEXlEbn5AkjKp",
        "limit": "1", // opzione per farsi restituire solo 1 risultato
        // TODO: aggiugnere altri paesi?
        "countrySet": "IT,FR"
      },
      "success": function (data) {
        $(formId)
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
  }
  
  function autoComplete(query) {
      $.ajax({
        "url": "https://api.tomtom.com/search/2/geocode/" + query + ".json",
        "method": "GET",
        "data": {
          "key": "PkKS2dAj8BrmI6ki7jkQEXlEbn5AkjKp",
          "limit": "5", // opzione per farsi restituire solo 1 risultato
          // TODO: aggiugnere altri paesi?
          "countrySet": "IT"
        },
        "success": function (data) {
          console.log(data)
          if (data.results.length !== 0){
            $("#addressesList").fadeIn();
            $("#addressesList").append(
              '<ul class="dropdown-menu" style="display:block; position:absolute">'
            );
              for (var i = 0; i < data.results.length ; i++) {
                $("#addressesList ul").append("<li>" + data.results[i].address.freeformAddress + "</li>");
              }
            $("#addressesList").append("</ul>");
          }
        },
        "error": function (iqXHR, textStatus, errorThrown) {
          alert(
            "iqXHR.status: " + iqXHR.status + "\n" +
            "textStatus: " + textStatus + "\n" +
            "errorThrown: " + errorThrown
          );
        }
      });
  }
}



 



//funzione per personalizzare la nav in base all'indirizzo
function navbar() {
  console.log(window.location.href)

  var url = window.location.href;

  
  var page3000 = "http://localhost:3000/";
  var page3000_1 = "http://localhost:3000/?page=1";
  var page3000_2 = "http://localhost:3000/?page=2";
  var page3000_3 = "http://localhost:3000/?page=3";
  var page3000_4 = "http://localhost:3000/?page=4";
  var page3000_5 = "http://localhost:3000/?page=5";
  var page8000 = "http://localhost:8000/";
  var page8000_1 = "http://localhost:8000/?page=1";
  var page8000_2 = "http://localhost:8000/?page=2";
  var page8000_3 = "http://localhost:8000/?page=3";
  var page8000_4 = "http://localhost:8000/?page=4";
  var page8000_5 = "http://localhost:8000/?page=5";
  if (url == page3000 || url == page3000_1 || url == page3000_2 || url == page3000_3 || url == page3000_4 || url == page3000_5 || url == page8000 || url == page8000_1 || url == page8000_2 || url == page8000_3 || url == page8000_4 || url == page8000_5) {
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


$(document).ready(init);
