<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Braintree\Gateway;
use App\Http\Requests\Payments\PayRequest;

class PayController extends Controller
{
    public function generate(Request $request, Gateway $gateway){
        
        $token = $gateway->clientToken()->generate();

        $data = [
            'token' => $token
        ];
        //dd($gateway->clientToken()->generate());
        
        return response()->json($data,200);
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
        } else{
            $data = [
                'success' => false,
                'token' => "transazione fallita "
            ];
        }
        return response()->json($data,401);
    }
}
