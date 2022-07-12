<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Habitation;
use App\Models\Sponsorship;

use Carbon\Carbon;

class PaymentsController extends Controller
{
    public function generate(Habitation $habitation, Sponsorship $sponsorship){

        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $token = $gateway->clientToken()->generate();
        
        return view('admin.payments.payment', compact('token', 'habitation', 'sponsorship'));
    }

    public function makePayment(Request $request, Habitation $habitation, Sponsorship $sponsorship){

        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $data = $request->all();

        $amount = $data['price'];

        $nonce = $data['payment_method_nonce'];

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
              ]

        ]);

        if($result->success){
            $transaction = $result->transaction;
        
            $startDate = Carbon::now()->toDateTimeString();
            $endDate = Carbon::now()->addHours($sponsorship->duration)->toDateTimeString();
    

            $habitation->sponsorships()->sync([$sponsorship->id => ['start_date' => $startDate, 'end_date' => $endDate]]);

            return redirect()->route('admin.habitations.show', $habitation)->with('message', "Il tuo annuncio ora è nella sezione 'In Evidenza'. Cosa aspetti? Corri a vederlo!");
        } else{

            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error:' . $error->code . ": " . $error->message . "\n";
            }

            return back()->withErrors('Si è verificato un errore. Leggi il messaggio:' . $result->message);
        }
    }
}
