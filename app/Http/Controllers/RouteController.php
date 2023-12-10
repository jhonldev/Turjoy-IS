<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function homeIndex (){
        $travels = Route::get()->count();
        return view('home',[
            'countTravels' => $travels,
        ]);
    }

    public function originIndex (){
        $origins = Route::distinct()->orderBy('origin', 'asc')->pluck('origin');
        return response()->json([
            'origins' =>$origins,
        ]);
    }

    public function searchDestinations($origin){
        $destinations = Route::where('origin', $origin)->orderBy('destination', 'asc')->pluck('destination');
        return response()->json([
            'destination' =>$destinations,
        ]);
    }

    public function seatings($origin, $destination, $date)
    {
        // Obtenemos el viaje segun el origen y destino ingresado.
        $travel = Route::where('origin', $origin)->where('destination', $destination)->first();

        if ($travel) {
            $tickets = Reservation::where('idroute', $travel->id)->where('reservation_date', $date)->sum('quantity_seats');
            $seatNow = $travel->available_seats - $tickets;


            return response()->json([
                'seats' => $seatNow, 'travel' => $travel,
            ]);
        }

    }

    public function dailyRoutes(){

    $routes = Route::paginate(6);
    $allRoutes = Route::all();

    foreach ($routes as $route) {
        $tickets = Reservation::where('idroute', $route->id)->where('reservation_date', today())->sum('quantity_seats');
        $route->available_seats = $route->available_seats - $tickets;
    }

    return view('daily', [
        'routes' => $routes,
        'allRoutes' => $allRoutes
    ]);

}

}
