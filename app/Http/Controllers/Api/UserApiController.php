<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserApiController extends Controller
{
    public function getUserData( Request $request){

    $data = $request->all();

    $user = $data['user'];
    $token = $data['token'];

    // var_dump($user);
    // var_dump($token);
    // $user= User::orderBy('ASC')->get();

    return response()->json( compact('user', 'token'));
    }

}
