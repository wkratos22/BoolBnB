<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;


class ContactMessageController extends Controller
{
    public function send( Request $request){

        // $data = $request->all();

        // $data = $request->validate([
        //     'field' => 'request|string|max:255',
        // ]);

        $data = $request->all();

        var_dump($data);

        // $name = $data['name'];
        // $email = $data['email'];
        // $message = $data['message'];

        //var_dump($message);

        // $user = Auth::user();

        $validator = Validator::make($data, [
            'name' => 'required',
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

        $user = User::all();

        if($request->idUser == $user['id']){
            $mail = new ContactMail( $data );
            Mail::to($user->email)->send($mail);
        }



        return response()->json( $data);
    }
}

