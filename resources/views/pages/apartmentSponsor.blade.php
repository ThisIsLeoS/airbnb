@extends('layouts.base')

@section("content")
    {{ $clientToken }}
<div class="container">
    <div class="row">
        <div class="col-12">
            <form action="" class="d-flex flex-column">
                <p>Please select your plans:</p>
                <input type="radio" id="plan24h" name="plan" value="2.99">
                <label for="plan24h">2,99 € per 24 ore di sponsorizzazione</label>
                <input type="radio" id="plan72h" name="plan" value="5.99">
                <label for="plan72h">5,99 € per 72 ore di sponsorizzazione</label>
                <input type="radio" id="plan144h" name="plan" value="9.99">
                <label for="plan144h">9,99 € per 144 ore di sponsorizzazione</label>
            </form>
            <script>
                $("input[type='radio']").click(function(){
               
                
                var test = $('input[name="plan"]:checked').val()

                console.log(test) 
                })
            </script>
        </div>
    </div>
</div>
    <div id="dropin-container"></div>
    <button id="submit-button">Request payment method</button>
     <script>
        var button = document.querySelector('#submit-button');
        braintree.dropin.create({
            authorization: '{{ $clientToken }}',
            container: '#dropin-container'
        }, function (createErr, instance) {
            button.addEventListener('click', function () {
                instance.requestPaymentMethod(function (err, payload) {
                    if (err) alert("C'è stato un errore");
                    console.log(payload.nonce);
                    $.ajax({
                        "url": "{{ route('apartment.sendNonce') }}",
                        "method": "POST",
                        "data": {
                            "nonce": payload.nonce,
                            "aptId": "{{ $aptId }}",
                            "plan" : $('input[name="plan"]:checked').val()
                            
                        },
                        "headers": {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        "success": function (data) {
                            
                            console.log(data);
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
            });
        });
    </script> 
@endsection