@extends('layouts.app')

@section('title')
    Datos de reserva
@endsection


    @section('content')

    <section class="bg-grey-custom-light">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

                    <table class= "items-center mx-auto my-auto">
                        <th class="text-xl font-bold leading-tight  text-gray-900 md:text-2xl">
                            Datos de la reserva:
                        </th>
                        <tr class="data-row">
                            <td class="bg-green-custom-validate rounded-tl-md">Código de reserva:</td>
                            <td>{{ $reservation->code }}</td>
                        </tr>
                        <tr class="data-row">
                            <td class= "bg-green-custom-validate">Dia de la reserva:</td>
                            <td>{{ $reservation->reservation_date }}</td>
                        </tr>
                        <tr class="data-row">
                            <td class= "bg-green-custom-validate">Cantidad de asientos:</td>
                            <td>{{ $reservation->quantity_seats }}</td>
                        </tr>
                        <tr class="data-row">
                            <td class= "bg-green-custom-validate">Fecha de la compra:</td>
                            <td>{{ $reservation->purchase_date }}</td>
                        </tr>
                        <tr class="data-row">
                            <td class= "bg-green-custom-validate rounded-bl-md">Valor de la reserva:</td>
                            <td>$ {{ $reservation->payment }} CLP</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
      </section>
    @endsection


    <hr>

</body>
</html>