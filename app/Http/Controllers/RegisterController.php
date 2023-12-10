<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Display the registration index view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function registerIndex() {
        return view('home', [
            // Additional data can be passed to the view if needed
        ]);
    }
}

