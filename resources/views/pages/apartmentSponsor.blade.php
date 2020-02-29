@extends('layouts.base')

@section("content")

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-12">
            <div class="card-header">
            <h4 class="m-3 text-center">Sponsorizza il tuo appartamento</h4>
        </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            
        
    
            <h4 class=" text-center mt-4">Scegli il piano più adatto alle tue esigenze</h4>
        <form class="d-flex flex-column justify-content-center text-center align-items-center" id="sponsorships-form" action="{{ route("apartment.sendNonce") }}" class="d-flex flex-column" method="POST">
            @csrf
            @method("POST")
                    <div class="sponsorship_style">

                        <input type="radio" id="plan24h" name="plan" value="2.99">
                        <label for="plan24h"><strong>2,99 €</strong> per <strong>24 ore</strong>  di sponsorizzazione</label>
                    </div>
                
                
                    <div class="sponsorship_style">

                        <input type="radio" id="plan72h" name="plan" value="5.99">
                        <label for="plan72h"><strong>5,99 €</strong>  per <strong>72 ore</strong>  di sponsorizzazione</label>
                    </div>
                
                
                    <div class="sponsorship_style">

                        <input type="radio" id="plan144h" name="plan" value="9.99">
                        <label for="plan144h"><strong>9,99 €</strong>  per <strong>144 ore</strong>  di sponsorizzazione</label>
                    </div>
                
                <input id="nonce" name="nonce" type="hidden" />
                <input id="aptId" name="aptId" type="hidden" />
            </form>
            <script>
                $("input[type='radio']").click(function(){
               
                
                var test = $('input[name="plan"]:checked').val()
                if($('input[name="plan"]:checked')){
                   $("#dropin-container").fadeIn().addClass("d-flex flex-column");
                }else{
                   $("#dropin-container").fadeOut().removeClass("d-flex flex-column"); 
                }

                console.log(test) 
                })
            </script>
        </div>
        <div class="col-12">
    
            <div id="dropin-container" ></div>
        </div>
    </div>
</div>
    {{-- <button id="submit-button">Request payment method</button> --}}
     <script>
        

        var button = document.createElement("BUTTON");
        button.innerHTML = "Request payment method";
        $(button).attr("id", "submit-button");
        // $("<button id='submit-button'>Request payment method</button>");
        braintree.dropin.create({
            authorization: '{{ $clientToken }}',
            container: '#dropin-container'
        }, function (createErr, instance) {  


             

            $("[data-braintree-id='card']").append(button);
            button.addEventListener('click', function () {
                instance.requestPaymentMethod(function (err, payload) {
                    var payBtn = document.createElement("BUTTON");
                    payBtn.innerHTML = "Completa Pagamento";
                    $(payBtn).attr("id", "pay-button");
                    $(payBtn).addClass("btn btn-primary")
                    
                        $("#pay-button").remove(); 
                        $("#dropin-container").append(payBtn);
                    
                    payBtn.addEventListener('click', function () {
                        $("#nonce").val(payload.nonce);
                        $("#aptId").val("{{ $aptId }}");
                        $("#sponsorships-form").submit();
                    });
                    // if (err) alert("C'è stato un errore");
                    // console.log(payload.nonce);
                    // $.ajax({
                    //     "url": "{{ route('apartment.sendNonce') }}",
                    //     "method": "POST",
                    //     "data": {
                    //         "nonce": payload.nonce,
                    //         "aptId": "{{ $aptId }}",
                    //         "plan" : $('input[name="plan"]:checked').val()
                            
                    //     },
                    //     "headers": {
                    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    //     },
                    //     "success": function (data) {
                            
                    //         console.log(data);
                    //     },
                    //     "error": function (iqXHR, textStatus, errorThrown) {
                    //         alert(
                    //             "iqXHR.status: " + iqXHR.status + "\n" +
                    //             "textStatus: " + textStatus + "\n" +
                    //             "errorThrown: " + errorThrown
                    //         );
                    //     }
                    // });
                });
            });
        });
    </script>

    @if(session()->has('message'))
            <div class="alert alert-success my_message">
                {{ session()->get('message') }}
            </div>
        @endif
@endsection