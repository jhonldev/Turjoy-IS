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

        if(!auth()->attempt($request->only('email','password'),$request->remember)){
            return back()->with('message','usuario no registrado o contraseña incorrecta');
        }
        return redirect()->route('routes.index');
    }

    public function logout()
    {
        Auth()->logout();
        return redirect()->route('register');
    }

}
