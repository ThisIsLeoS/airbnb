
// @ts-check

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');


/* import Vue from 'vue/types/umd'; */

/* window.Vue = require('vue'); */

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/* Vue.component('example-component', require('./components/ExampleComponent.vue').default); */

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/* import * as $ from 'jquery';
window.$ = window.jQuery = $;

import 'jquery-ui/ui/widgets/datepicker.js'; */

/* const app = new Vue({
    el: '#myVue',
});
 */



function showMessage(){
  $('.sender').on('click', function () {
    /* console.log("sto cliccando") */
    if ($(this).siblings(".body_message").hasClass("d-none")){
      $(this).find("i").removeClass("fa-caret-down");
      $(this).find("i").removeClass("d-none");
      $(this).siblings(".body_message").fadeIn();
      $(this).siblings(".body_message").toggleClass("d-none");
    }else{
      $(this).find("i").addClass("fa-caret-down")
      $(this).find(".fa-caret-up").addClass("d-none");
      $(this).siblings(".body_message").fadeOut();
      $(this).siblings(".body_message").toggleClass("d-none");
    }
  })
}

function init(){
  $(".apt-user-show-card.0").addClass("inactive");
  $(".apt-user-show-card.0").find(".visibilityBtn").prop("checked", false);
  
  alertHide();
  showMessage();
  navbar();

  $("#date_of_birth").on("input", function () {
    var ymdArray = $(this).val().split("-");
    if (getAge(ymdArray[0], ymdArray[1], ymdArray[2]) < 18) {
      this.setCustomValidity("You must be at least 18 years old to have an account");
    }
    else {
      this.setCustomValidity("");
    }
  });

  function getAge(year, month, day) {
    var today = new Date();
    var birthDate = new Date(year, month, day);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
      age--;
    }
    return age;
  }

  $("#password-confirm").on("input", function () {
    console.log("prova");
    
    var passField = document.getElementById("password-signup");
    var confirmPassField = this;
    if (passField.value !== confirmPassField.value) {
      console.log("if"); 
      confirmPassField.setCustomValidity("Passwords must match");
    }
    else {
      console.log("else");
      confirmPassField.setCustomValidity("");
    }
  });

  $("#password-signup").on("input", function () {
    console.log("prova");
    
    var passField = this;
    var confirmPassField = document.getElementById("password-confirm");
    if (passField.value !== confirmPassField.value) {
      console.log("if"); 
      confirmPassField.setCustomValidity("Passwords must match");
    }
    else {
      console.log("else");
      confirmPassField.setCustomValidity("");
    }
  });

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

  $("#update-aptm-btn").click(function(event) {
    // la sottomissione del form viene abortita
    event.preventDefault();
    geocode($("#update-address").val(), "#update-aptm-form");
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

  $("#create-aptm-form #address").keyup(delay(function () {
      $("#create-aptm-form #addressesList").empty();
      if (($(this).val()).length >= 3) {
        autoComplete($(this).val());
      }
    }, 500)
  );

  $("#update-address").keyup(delay(function () {
    $("#addressesList").empty();
    if (($(this).val()).length >= 3) {
      autoComplete($(this).val());
    }
  }, 500));

  $(document).on("click", "li.autocompleteLi", function () {
    $("#address-to-search").val($(this).text());
    $("#addressesList").fadeOut();
    $("#create-aptm-form #address").val($(this).text());
    $("#create-aptm-form #addressesList").fadeOut();
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
      },
      "success": function (data) {
        // al form vengono aggiunti i campi contenenti longitudine e latitudine
        $(formId).append(
          "<input type='hidden' name='lat' value='" + data.results[0].position.lat + "'/>",
          "<input type='hidden' name='lon' value='" + data.results[0].position.lon + "'/>",
        );
        /* 
        viene fatta la validazione dell'HTML 5 e, se passata, viene sottomesso il form (nota: non
        viene usato il metodo submit di jQuery perchè sottomette il form senza la validazione 
        dell'HTML5, viene invece creato un elemento input di tipo submit su cui viene scatenato 
        l'evento click) 
        */
        $(formId).append(
          "<input type='submit' id='input-type-submit' style='display:none;'></input>"
        );
        $('#input-type-submit').click();
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
              '<ul class="dropdown-menu my_style_drop" style="display:block; position:absolute;">'
            );
              for (var i = 0; i < data.results.length ; i++) {
                $("#addressesList ul").append("<li class='autocompleteLi'>" + data.results[i].address.freeformAddress + "</li>");
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

  $("#searchByFiltersForm").submit(function(event) {
    console.log("prova");

    event.preventDefault();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    // throw ($("input[name='services[]']:checked").serialize());
    $.ajax({
      "url": '/apartament/search',
      "method": "POST",
        contentType: "application/json",
        dataType: "json",
        "data": {
        "rooms": $("input[name='rooms']").val(),
        "beds": $("input[name='beds']").val(),
        "radius": $("input[name='radius']").val(),
        "services": $("input[name='services[]']:checked").serialize()
      },
      "success": function (data) {
        $('.aptFilteredOutput').empty();
        console.log(data);
        return false;
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
  var page3000_6 = "http://localhost:3000/?page=6";
  var page3000_7 = "http://localhost:3000/?page=7";
  var page8000 = "http://localhost:8000/";
  var page8000_1 = "http://localhost:8000/?page=1";
  var page8000_2 = "http://localhost:8000/?page=2";
  var page8000_3 = "http://localhost:8000/?page=3";
  var page8000_4 = "http://localhost:8000/?page=4";
  var page8000_5 = "http://localhost:8000/?page=5";
  var page8000_6 = "http://localhost:3000/?page=6";
  var page8000_7 = "http://localhost:3000/?page=7";
  if (url == page3000 || url == page3000_1 || url == page3000_2 || url == page3000_3 || url == page3000_4 || url == page3000_5 || url == page3000_6 || url == page3000_7 || url == page8000 || url == page8000_1 || url == page8000_2 || url == page8000_3 || url == page8000_4 || url == page8000_5 || url == page8000_6 || url == page8000_7) {
    
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
