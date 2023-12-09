@extends('layouts.app')

@section('title')
    Datos de reserva
@endsection


    @section('content')
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0" style="min-height: 85vh">

            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

                    <table class= "items-center mx-auto my-auto">
                        <th class="text-xl font-bold leading-tight  text-gray-900 md:text-2xl">
                            Detalles de la reserva:
                        </th>
                        <tr class="data-row">
                            <td class="bg-green-custom-validate rounded-tl-md">Origen:</td>
                            <td>{{ $origin }}</td>
                        </tr>
                        <tr class="data-row">
                            <td class="bg-green-custom-validate rounded-tl-md">Destino:</td>
                            <td>{{ $destination }}</td>
                        </tr>
                        <tr class="data-row">
                            <td class="bg-green-custom-validate rounded-tl-md">Código de reserva:</td>
                            <td>{{ $code }}</td>
                        </tr>
                        <tr class="data-row">
                            <td class= "bg-green-custom-validate">Día de la reserva:</td>
                            <td>{{ $reservation_date_es }}</td>
                        </tr>
                        <tr class="data-row">
                            <td class= "bg-green-custom-validate">Cantidad de asientos:</td>
                            <td>{{ $quantity_seats }}</td>
                        </tr>
                        <tr class="data-row">
                            <td class= "bg-green-custom-validate">Fecha de la compra:</td>
                            <td>{{ $purchase_date_es }}</td>
                        </tr>
                        <tr class="data-row">
                            <td class= "bg-green-custom-validate rounded-bl-md">Valor de la reserva:</td>
                            <td>${{ $payment }} CLP</td>
                        </tr>
                    </table>
                </div>

            </div>
            <div class="flex items-center justify-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <a href="{{ route('pdf.download', ['id' => $reservation->id]) }}" class="inline-flex items-center mx-auto my-4 px-3 py-2 text-sm font-medium text-center text-white bg-cyan-700 rounded-lg hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Imprimir
                </a>
                <a href="{{ route('home') }}" type="button"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    Finalizar
                </a>
            </div>
        </div>
    @endsection
    <hr>

</body>
</html>
