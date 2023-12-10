<?php
use Carbon\Carbon;
use App\Models\Reservation;
use Illuminate\Support\Str;

/**
 * Generate an array of error messages for validation.
 *
 * @return array
 */
function makeMessages() {

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
        'reservation.data' => 'debe llenar todos los campos para realizar la reserva',
        'initialDate.required' => 'debe seleccionar la fecha inicial para realizar la búsqueda',
        'initialDate.date' => 'debe seleccionar una fecha válida para realizar la búsqueda',
        'finishDate.required' => 'debe seleccionar la fecha final para realizar la búsqueda',
        'finishDate.date' => 'debe seleccionar una fecha válida para realizar la búsqueda',
        'finishDate' => 'la fecha de inicio a consultar no puede ser mayor que la fecha de término de la consulta',
    ];

    return $messages;
}

/**
 * Check if the given date is valid.
 *
 * @param string $date
 * @return bool
 */
function validDate($date){
    $actualDate = date('d-m-Y');
    $verifyDate = Carbon::parse($date);
    if ($verifyDate->lessThan($actualDate)) {
        return true;
    }
    return false;
}

/**
 * Generate a unique reservation number.
 *
 * @return string
 */
function generateReservationNumber(){
    do {
        $letters = generateRandomLetters(4);
        $numbers = mt_rand(10, 99);

        $code = $letters.$numbers;

        $response = Reservation::where('code', $code)->exists();
    } while ($response);
    return $code;
}

/**
 * Generate a random string of letters.
 *
 * @param int $len
 * @return string
 */
function generateRandomLetters($len)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $randomString = '';

    for ($i = 0; $i < $len; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}
