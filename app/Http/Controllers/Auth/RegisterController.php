<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, 
        [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'date_of_birth' => ['date'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
        [
            'name.required' => 'Il nome è un campo obbligatorio.',
            'name.string' => 'Il nome deve essere una stringa.',
            'name.max' => "Il nome può contenere al massimo 255 caratteri.",

            'surname.required' => 'Il cognome è un campo obbligatorio.',
            'surname.string' => 'Il cognome deve essere una stringa.',
            'surname.max' => "Il cognome può contenere al massimo 255 caratteri.",
            
            'email.required' => "L' email è un campo obbligatorio.",
            'email.string' => "L' email deve essere una stringa.",
            'email.email' => "Inserisci un' email corretta.",
            'email.max' => "L' email può contenere al massimo 255 caratteri.",
            'email.unique' => "L' email inserita è già associata ad un account.",

            'date_of_birth.date' => "Inserisci una data corretta come data di nascita.",
            
            'password.required' => 'La password è un campo obbligatorio.',
            'password.string' => 'La password deve essere una stringa.',
            'password.min' => 'La password deve contenere minimo 8 caratteri.',
            'password.confirmed' => 'La password non corrisponde a quella inserita, riprova.',
        ]
        
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'date_of_birth' => $data['date_of_birth'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
