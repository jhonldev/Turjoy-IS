<?php
use Carbon\Carbon;
use App\Models\Reservation;
use Illuminate\Support\Str;

function makeMessages(){

    $messages = [
        'email.required' => 'debe ingresar su correo electrónico para iniciar sesión',
        'email.email' => 'usuario no registrado o contraseña incorrecta',
        'password.required' => 'debe ingresar su contraseña para iniciar sesión',
        'file.required' => 'El campo "documento" es requerido.',
        'file.mimes' => 'El archivo seleccionado no es Excel con extensión .xlsx.',
        'file.max' => 'El tamaño máximo del archivo a cargar no puede superar los 5 megabytes',
        'file.inputs' => 'El encabezado del archivo es incorrecto.',
        'file.empty' => 'El archivo se encuentra vacío.',
        'seat.required' => 'Debe seleccionar la cantidad de asientos antes de realizar la reserva',
        'date.required' => 'Debe seleccionar la fecha del viaje antes de realizar la reserva',
    ];

    return $messages;

}
function validDate($date){
    $fechaActual = date("d-m-Y");
    $fechaVerificar = Carbon::parse($date);
    if ($fechaVerificar->lessThan($fechaActual)) {
        return true;
    }
    return false;
}

function generateReservationNumber(){
    do {
        $letters = Str::random(4); // Genera 4 letras aleatorias
        $numbers = mt_rand(10, 99); // Genera 2 números aleatorios

        $code = $letters.$numbers;

        $response = Reservation::where('code', $code)->exists();
    } while ($response);
    return $code;
}
