<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Route;
use Illuminate\Http\Request;



class ReservationController extends Controller
{
    public function store(Request $request)
    {
        // Generar el numero de reserva
        $code = generateReservationNumber();
        // Modificar request
        $request->request->add(['code' => $code]);

        // Validar
        $makeMessages = makeMessages();
        $this->validate($request, [
            'seat' => ['required'],
            'total' => ['required'],
            'date' => ['date', 'required'],
        ], $makeMessages);

        //  Verificamos si la fecha ingresada es mayor a la fecha actual.
        $invalidDate = validDate($request->date);
        if ($invalidDate) {
            return back()->with('message', 'La fecha debe ser igual o mayor a '.date('d-m-Y'));
        }

        // Obtener viaje
        $travel = Route::where('origin', $request->origin)->where('destination', $request->destination)->first();

        // Crear la reserva
        $ticket = Reservation::create([
        'code' => $request->code,
        'seat' => $request->seat,
        'date' => $request->date,
        'total' => $request->total,
        'travel_id' => $travel->id,
        ]);

        return redirect()->route('generate.pdf', [
            'id' => $ticket->id,
        ]);
    }
    public function reservation(Request $request){
        //dd($request);
    }
}
