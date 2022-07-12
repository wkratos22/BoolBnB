<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Models\Message;


class ContactMessageController extends Controller
{
    public function send( Request $request){

        $data = $request->all();

        // var_dump($data['idHabitation']);

        $validator = Validator::make($data, [
            'name' => 'required|min:1',
            'email' => 'required|email',
            'message' => 'required|min:1'
        ],
        [
            'name.required' => 'Il nome è obbligatorio',
            'name.required' => 'Il numero minimo di caratteri previsti per il nome è 1.',
            'email.required' => 'La mail è obbligatoria',
            'email.email' => 'La sintassi della mail è sbagliata',
            'message.required' => 'Il messaggio della mail è obbligatorio',
            'message.min' => 'Il numero minimo di caratteri previsti per il messaggio è 1.'
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()]);
        };

        $message = new Message();

        $message->habitation_id = $data['idHabitation'];
        $message->name = $data['name'];
        $message->email_sender = $data['email'];
        $message->text_message = $data['message'];

        $message->save();

        // $user = User::where('id', $data['idUser'])->get();

        // var_dump($user);

        // if($request->idUser == $user['id']){
        //     $mail = new ContactMail( $data );
        //     Mail::to($user->email)->send($mail);
        // }

        return response()->json( $data);
    }
}

