<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(Request $request){

        $messages = makeMessages();

        $this->validate($request, [

            'email' => ['required', 'email'],
            'password' => ['required']

        ], $messages);

    }

}
