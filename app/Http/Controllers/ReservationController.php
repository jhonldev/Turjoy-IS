<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Route;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class ReservationController extends Controller
{
    public function store(Request $request)
    {
        // Generar el numero de reserva
        $code = generateReservationNumber();
        echo $code;
        // Modificar request
        $request->request->add(['code' => $code]);

        // Validar
        $makeMessages = makeMessages();
        $this->validate($request, [
            'origin' =>['required'],
            'destination' =>['required'],
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
        $route = Route::where('origin', $request->origin)->where('destination', $request->destination)->first();

        // Crear la reserva
        $reservation = Reservation::create([
        'code' => $request->code,
        'quantity_seats' => $request->seat,
        'purchase_date' => date('Y-m-d'),
        'reservation_date' => $request->date,
        'payment' => $request->total,
        'idroute' => $travel->id,
        ]);

        return redirect()->route('generate-pdf', [
            'id' => $reservation->id,
        ]);
    }
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

    }

    public function downloadPDF($id){
        $reservation = Reservation::findOrFail($id);

        $path = storage_path('app\public\\'.$reservation->uri);

        $filename = $reservation->pdf_name;

        $mimeType = Storage::mimeType($path);

        return response()->download($path, $filename, ['Content-Type' => $mimeType]);
    }

    public function generatePDF($id){
        $reservation = Reservation::findOrFail($id);

        // Crear una instacia de Dompdf
        $domPDF = new Dompdf();

        $data = [
            'reservation' => $reservation,
            'date' => date('d-m-Y'),
        ];

        $view_html = view('voucher.pdf', $data)->render();

        $domPDF->loadHtml($view_html);

        $domPDF->setPaper('A4', 'portrait');

        $domPDF->render();

        // Generar nombre de archivo aleatorio
        $filename = 'user_'.Str::random(10).'.pdf';

        // Guardar el PDF en la carpeta public
        $path = 'pdfs\\'.$filename;
        Storage::disk('public')->put($path, $domPDF->output());

        Reservation::Where('id', $id)->update([
            'pdf_name' => $filename,
            'uri' => $path,
        ]);

        return view('voucher.voucher', [
            'reservation' => $reservation
        ]);
    }
}
