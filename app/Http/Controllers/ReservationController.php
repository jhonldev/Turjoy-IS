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
    /**
     * Store a new reservation.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        date_default_timezone_set('America/Santiago');
        $code = generateReservationNumber(); // Generate the reservation number
        $request->request->add(['code' => $code]);

        // Validate
        $makeMessages = makeMessages();
        $this->validate($request, [
            'origins' =>['required'],
            'destinations' =>['required'],
            'seat' => ['required'],
            'total' => ['required'],
            'date' => ['date', 'required'],
        ], $makeMessages);

        $invalidDate = validDate($request->date); // Check if the entered date is greater than the current date
        if ($invalidDate) {
            return back()->with('message', 'La fecha debe ser igual o mayor a '.date('d-m-Y'));
        }

        $route = Route::where('origin', $request->origins)->where('destination', $request->destinations)->first(); // Get the route

        $reservation = Reservation::create([
        'code' => $request->code,
        'quantity_seats' => $request->seat,
        'purchase_date' => date('Y-m-d H:i:s'),
        'reservation_date' => $request->date,
        'payment' => $request->total*$request->seat,
        'idroute' => $route->id,
        ]);

        return redirect()->route('generate-pdf', [
            'id' => $reservation->id,
        ]);
    }

    /**
     * Search for all reservations.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function search(Request $request) {
        $reservations = Reservation::all();
        return view('reservations.index', ['reservations' => $reservations]);
    }

    /**
     * Search for a route based on reservation code.
     *
     * @param string $routeReference
     * @return array|null
     */
    public function routeSearch($routeReference) {
        $reservations = Reservation::all();
        foreach ($reservations as $reservation){
            if($reservation->code == $routeReference){
                $idRoute = $reservation->idroute;
                $routes = Route::all();
                foreach ($routes as $route){
                    if($route->id == $idRoute){
                        $result = [
                        'origin' => $route->origin,
                        'destination' => $route->destination
                        ];
                    return $result;
                    }
                }
            }
        }

    }

    /**
     * Get reservation details by code.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function getByCode(Request $request) {

        $code = $request->code;

        if($code == null){
            return back()->with('message','Debe proporcionar un código de reserva');
        }

        $reservation = Reservation::where('code', $code)->first();

        if (!$reservation) {
            return back()->with('message', 'La reserva '. $code . ' no existe en el sistema');
        }

        $route = $this->routeSearch($code);

        if($route == null){
            return back()->with('message', 'verifique las letras mayúsculas y minúsculas del código de reserva');
        }

        $origin = $route['origin'];
        $destination = $route['destination'];
        $code = $reservation->code;
        $quantity_seats = $reservation->quantity_seats;
        $reservation_date_es = date('d-m-Y', strtotime($reservation->reservation_date));
        $purchase_date_es = date('d-m-Y H:i:s', strtotime($reservation->purchase_date));
        $payment = number_format($reservation->payment, 0, ',', '.');

        return view('voucher.voucher', [
            'origin' => $origin,
            'destination' => $destination,
            'code' => $code,
            'quantity_seats' => $quantity_seats,
            'reservation_date_es' => $reservation_date_es,
            'purchase_date_es' => $purchase_date_es,
            'payment' => $payment,
            'reservation' => $reservation
        ]);
    }

    /**
     * Download PDF for a reservation.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function downloadPDF($id) {
        $reservation = Reservation::findOrFail($id);

        $path = storage_path('app\public\\'.$reservation->uri);

        $filename = $reservation->pdf_name;

        $mimeType = Storage::mimeType($path);

        return response()->download($path, $filename, ['Content-Type' => $mimeType]);
    }

    /**
     * Generate PDF for a reservation.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function generatePDF($id) {
        $reservation = Reservation::findOrFail($id);

        $route = $this->routeSearch($reservation->code);
        $origin = $route['origin'];
        $destination = $route['destination'];
        $code = $reservation->code;
        $quantity_seats = $reservation->quantity_seats;
        $reservation_date_es = date('d-m-Y', strtotime($reservation->reservation_date));
        $purchase_date_es = date('d-m-Y H:i:s', strtotime($reservation->purchase_date));
        $payment = number_format($reservation->payment, 0, ',', '.');
        $domPDF = new Dompdf();

        $data = [
            'origin' => $origin,
            'destination' => $destination,
            'code' => $code,
            'quantity_seats' => $quantity_seats,
            'reservation_date_es' => $reservation_date_es,
            'purchase_date_es' => $purchase_date_es,
            'payment' => $payment,
            'date' => date('Y-m-d H:i:s'),
        ];

        $view_html = view('voucher.pdf', $data)->render();

        $domPDF->loadHtml($view_html);

        $domPDF->setPaper('A4', 'portrait');

        $domPDF->render();

        $filename = $code.'.pdf';

        $path = 'pdfs\\'.$filename;
        Storage::disk('public')->put($path, $domPDF->output());

        Reservation::Where('id', $id)->update([
            'pdf_name' => $filename,
            'uri' => $path,
        ]);

        return view('voucher.voucher', [
            'origin' => $origin,
            'destination' => $destination,
            'code' => $code,
            'quantity_seats' => $quantity_seats,
            'reservation_date_es' => $reservation_date_es,
            'purchase_date_es' => $purchase_date_es,
            'payment' => $payment,
            'reservation' => $reservation
        ]);
    }

    /**
     * Display the reservation report index view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function reservationReportIndex() {
        $reservations = Reservation::all();

        return view('admin.reservations.reports', [
            'reservations' => $reservations,
        ]);
    }

    /**
     * Display the reservation report search index view.
     *
     * @param int $reservations
     * @return \Illuminate\Contracts\View\View
     */
    public function reservationReportSearchIndex($reservations) {
        $reservationSearch = Reservation::find($reservations);

        return view('admin.reservations.reports', [
            'reservations' => $reservationSearch,
        ]);
    }

    /**
     * Search reservations by date range.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function searchToDate(Request $request) {
        $messages = makeMessages();
        $this->validate($request, [
            'initialDate' => ['required', 'date'],
            'finishDate' => ['required', 'date', 'after:initialDate'],
        ], $messages);

        $initialDate = $request->initialDate;
        $finishDate = $request->finishDate;

        $reservations = Reservation::whereBetween('reservation_date', [$initialDate, $finishDate])->get();

        if ($reservations->count() === 0) {
            return back()->with('message', 'no se encontraron reservas dentro del rango seleccionado');
        } 

        return view('admin.reservations.reports', [
            'reservations' => $reservations,
        ]);
    }
}
