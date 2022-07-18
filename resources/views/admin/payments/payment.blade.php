@extends('layouts.app')

@section('title')
    Pagamento
@endsection

@section('content')

    @include('includes.validation.errors')
    
    <div id="loaderWrapper">
        <div class="bg-light d-flex justify-content-center align-items-center" style="height: 90vh;">
            <img src="/img/loader-house.png" alt="house loader">
        </div>
    </div>

    <div class="container d-flex align-items-start justify-content-center h-100">
        <div class="row justify-content-center align-items-center mt-5">

            <form method="POST" id="payment-form" action="{{route('admin.pay.checkout', [$habitation, $sponsorship])}}">
                @csrf

                <div class="form-group mb-2 d-none" id="amountWrapper">
                    <small>Costo Sponsorizzazione</small>
                    <input class="form-control bg-white c_border" type="number" name="price" id="amount" min="1" step="0.01" value="{{$sponsorship->price}}" readonly>
                </div>

                {{-- form di Braintree --}}
                <div id="bt-dropin" class="c_border"></div>
 

                <input type="hidden" name="payment_method_nonce" id="nonce">
                <div class="text-center pt-3">
                    <button type="submit" class="btn color_button d-none" id="sendPayment">Sponsorizza</button>   
                </div>
                
            </form>

        </div>
    </div>

@endsection

@section('scripts')

    <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>  

    <script>


        // salvare il form in una variabile
        var form = document.querySelector('#payment-form');

        // salvare il token generato nel controller e passato alla view attraverso il compact -> richiesta al server di braintree
        var client_token = '{{$token}}';

        // funzione custom di braintee per creare il form
        braintree.dropin.create({
            // settare "authorization" con il token generato
            authorization: client_token,
            // btn con id custom di braintree
            selector: '#bt-dropin',
        }, function(createErr, instance){

            // in caso di errore messaggio in console
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            } 
            let btnPayment = document.getElementById('sendPayment');
            let amountPayment = document.getElementById('amountWrapper');
            // loader
            let loader = document.getElementById('loaderWrapper')

            btnPayment.classList.remove('d-none')
            amountPayment.classList.remove('d-none')
            loader.classList.add('d-none')

            form.addEventListener( 'submit', function(event){                
                event.preventDefault();


                btnPayment.classList.add('d-none')
                amountPayment.classList.add('d-none')

                
                // metodo custom per validare la richiesta di pagamento
                instance.requestPaymentMethod( function(err,payload){
                    if (err) {
                        btnPayment.classList.remove('d-none')
                        amountPayment.classList.remove('d-none')
                        
                        console.log('Request Payment Method Error', err);
                        return;
                    }

                    // aggiungere il valore di "nonce" al form ed effettuare il submit
                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();
                });
            });
        });
    </script>
@endsection