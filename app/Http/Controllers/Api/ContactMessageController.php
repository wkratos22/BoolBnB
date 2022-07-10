<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ContactMessageController extends Controller
{
    public function send( Request $request){
        $data = $request->all();

        $name = $data['name'];
        $email = $data['email'];
        $message = $data['message'];

        //var_dump($message);

        $user = Auth::user();

        $validator = Validator::make($data, [
            'name' => 'required|name',
            'email' => 'required|email',
            'message' => 'required'
        ],
        [
            'name.required' => 'Il nome è obbligatorio',
            'email.required' => 'La mail è obbligatoria',
            'email.email' => 'La sintassi della mail è sbagliata',
            'message.required' => 'Il messaggio della mail è obbligatorio'
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()]);
        };

        $mail = new ContactMail( $data );
        Mail::to($user->email)->send($mail);

        return response()->json( $data);
    }
}

