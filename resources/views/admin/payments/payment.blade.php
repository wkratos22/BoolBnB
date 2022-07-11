@extends('layouts.app')

@section('content')

    @include('includes.validation.errors')
    
    <div class="container">
        <div class="row justify-content-center align-items-center">

            <form method="POST" id="payment-form" action="{{route('admin.pay.checkout', [$habitation, $sponsorship])}}">
                @csrf

                <div class="form-group">
                  <label for="amount">Amount</label>
                  <input class="form-control" type="number" name="price" id="amount" min="1" step="0.01" value="{{$sponsorship->price}}" readonly>
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>

                <div class="container">
                    <div id="bt-dropin"></div>
                </div>

                <input type="hidden" name="payment_method_nonce" id="nonce">

                <button type="submit" class="btn btn-primary">Submit</button>
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
            } //else
            form.addEventListener( 'submit', function(event){
                event.preventDefault();

                // metodo custom per validare la richiesta di pagamento
                instance.requestPaymentMethod( function(err,payload){
                    if (err) {
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