<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Route;

class LoadController extends Controller
{
    public function route(){

        $routes = Route::all();

        return view('auth.loadRoute',['routes' => $routes ]);
    }
    public function create(){
        return view('auth.loadRoute');
    }


}
