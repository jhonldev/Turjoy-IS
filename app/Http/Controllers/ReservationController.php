<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function search(Request $request)
    {

        $reservations = Reservation::all();


        return view('reservations.index', ['reservations' => $reservations]);
    }

    public function getByCode(Request $request)
    {
        $code = $request->code;

        if($code == null){
            return back()->with('message','Debe proporcionar un código de reserva');
        }


        $reservation = Reservation::where('code', $code)->first();


        if (!$reservation) {
            return back()->with('message', 'La reserva '. $code . ' no existe en el sistema');
        }


        return view('voucher.voucher', ['reservation' => $reservation]);
        // o

    }
}

