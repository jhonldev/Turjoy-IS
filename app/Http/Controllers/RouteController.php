<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
        /**
     * Display the home index view with the count of travels.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function homeIndex () {
        $travels = Route::get()->count();
        return view('home',[
            'countTravels' => $travels,
        ]);
    }

    /**
     * Get distinct origins and return as JSON.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function originIndex () {
        $origins = Route::distinct()->orderBy('origin', 'asc')->pluck('origin');
        return response()->json([
            'origins' =>$origins,
        ]);
    }

    /**
     * Search destinations based on origin and return as JSON.
     *
     * @param string $origin
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchDestinations($origin) {
        $destinations = Route::where('origin', $origin)->orderBy('destination', 'asc')->pluck('destination');
        return response()->json([
            'destination' =>$destinations,
        ]);
    }

    /**
     * Get available seats and travel details for a specific route, origin, destination, and date.
     *
     * @param string $origin
     * @param string $destination
     * @param string $date
     * @return \Illuminate\Http\JsonResponse
     */
    public function seatings($origin, $destination, $date) {
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

        /**
     * Display the daily routes view with paginated routes and available seats.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function dailyRoutes() {

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
