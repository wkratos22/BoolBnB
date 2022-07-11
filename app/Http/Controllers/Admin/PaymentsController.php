<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;

class PaymentsController extends Controller
{
    public function generate(Request $request, Gateway $gateway){
        
        $token = $gateway->clientToken()->generate();

        $data = [
            'token' => $token
        ];
        //dd($gateway->clientToken()->generate());
        
        return view('admin.payments.pay');
    }

    public function makePayment(PayRequest $request, Gateway $gateway){

        $result = $gateway->transaction()->sale([
            'amount' => '10',
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
              ]

        ]);

        if($result->success){
            $data = [
                'success' => true,
                'message' => "transazione eseguita"
            ];


            // Relazione habitations - sponsorships

        } else{
            $data = [
                'success' => false,
                'token' => "transazione fallita "
            ];
        }
        return view('admin.payments.pay',response()->json(compact($data, 401))); 
    }
}
