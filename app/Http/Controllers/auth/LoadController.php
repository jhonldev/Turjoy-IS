<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Route;
use Illuminate\Database\Eloquent\Collection;

class LoadController extends Controller
{
    public function route(){
        $validRoutes = [];
        $invalidRoutes = [];
        $cloneRoutes = [];

        $routes = Route::all();

        $this->filter($routes, $validRoutes, $invalidRoutes, $cloneRoutes);


        return view('auth.loadRoute',['validRoutes' => $validRoutes,'invalidRoutes' => $invalidRoutes,'cloneRoutes' => $cloneRoutes]);
    }

    public function create(){
        $validRoutes = [];
        $invalidRoutes = [];
        $cloneRoutes = [];

        $routes = Route::all();

        $this->filter($routes, $validRoutes, $invalidRoutes, $cloneRoutes);


        return view('auth.loadRoute',['validRoutes' => $validRoutes,'invalidRoutes' => $invalidRoutes,'cloneRoutes' => $cloneRoutes]);
    }

    public function filter(Collection $routes,& $validRoutes,& $invalidRoutes ,& $cloneRoutes){

        foreach ($routes as $route){


            if(!$this->verificateSyntax($route)){
                $invalidRoutes[] = $route;
            }
            elseif(!$this->verificateClone($route,$validRoutes)){
                $cloneRoutes[] = $route;
            }
            else{
                $validRoutes[] = $route;
            }

        }
    }

    public function verificateSyntax(Route $route){
        $origin = $route['origin'];
        $destination = $route['destination'];
        $available_seats = $route['available_seats'];
        $base_rate = $route['base_rate'];
        if (!preg_match("/^[A-Za-z\s]+$/", $origin)) {
            return false;
        }
        if (!preg_match("/^[A-Za-z\s]+$/", $destination)) {
            return false;
        }
        if (str_replace(' ', '', $origin) == str_replace(' ', '', $destination)) {
            return false;
        }
        if (!(is_numeric($available_seats)) || !($available_seats >= 0)) {
            return false;
        }
        if (!(is_numeric($base_rate)) || !($base_rate >= 0)) {
            return false;
        }

        return true;
    }

    public function verificateClone(Route $route, $validRoutes){
        $origin = $route['origin'];
        $destination = $route['destination'];
        foreach ($validRoutes as $validRoute){
            $validOrigin = $validRoute['origin'];
            $validDestination = $validRoute['destination'];
            if ($origin == $validOrigin && $destination == $validDestination){
                return false;
            }
        }
        return true;
    }
}
