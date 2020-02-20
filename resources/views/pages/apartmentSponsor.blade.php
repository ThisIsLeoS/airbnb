@extends('layouts.base')

@section("content")
    {{ $clientToken }}
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
                        "url": "{{ route('apartment.sponsorship') }}",
                        "method": "POST",
                        "data": {
                            "nonce": payload.nonce,
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