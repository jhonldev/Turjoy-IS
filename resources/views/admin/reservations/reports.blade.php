@extends('layouts.app')

@section('content')
    <h3 class="my-6 font-bold text-center text-3xl uppercase">Reservas del sistema turjoy</h3>

    @if ($reservations->count() > 0)
        <div class="flex justify-center gap-4">
            <a href="{{ route('report-reservation.index') }}"
                class="bg-yellow-300 transition-all my-auto py-4 px-4 text-white rounded-lg">
                <svg class="w-5 h-5 hover:animate-spin text-gray-800 " aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 1v5h-5M2 19v-5h5m10-4a8 8 0 0 1-14.947 3.97M1 10a8 8 0 0 1 14.947-3.97" />
                </svg>
            </a>

            <form action="{{ route('searchToDate') }}" method="GET">
                @csrf
                <div class="flex justify-center gap-4 my-4">
                    <div class="relative max-w-sm">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 " aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input datepicker type="date" name="initialDate" value="{{ old('initialDate') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                            placeholder="Select date">
                    </div>

                    <div class="relative max-w-sm">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input datepicker type="date" name="finishDate" value="{{ old('finishDate') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                            placeholder="Select date">
                    </div>

                    <button type="submit"
                        class="bg-green-500 hover:bg-green-700 transition-all py-2 px-4 text-white rounded-lg">
                        Buscar
                    </button>
                </div>
            </form>
        </div>

        <div class="max-w-sm mx-auto">
            @error('initialDate')
                <p class="bg-red-400 font-semibold text-lg text-red-800 p-2 my-2 rounded-lg">{{ $message }}</p>
            @enderror

            @if (session('message'))
                <p class="bg-red-500 text-white my-2 rounded-xl text-sm text-center p-2">
                    {{ session('message') }}</p>
            @endif
            @error('finishDate')
                <p class="bg-red-400 font-semibold text-lg text-red-800 p-2 my-2 rounded-lg">{{ $message }}</p>
            @enderror
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-10/12 mx-auto text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Código de la reserva
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Día de la reserva
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha de la reserva
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ciudad de origen
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ciudad de destino
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cantidad de asientos
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Valor total
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr class="bg-white border-b">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $reservation->code }}
                            </th>
                            <td class="px-6 py-4">
                                {{ date('d/m/Y h:i:s', strtotime($reservation->purchase_date)) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ date('d/m/Y', strtotime($reservation->reservation_date)) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $reservation->route->origin }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $reservation->route->destination }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $reservation->quantity_seats }}
                            </td>
                            <td class="px-6 py-4">
                                ${{ number_format($reservation->payment, 0, '', '.') }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>no hay reservas en sistema</p>
    @endif
@endsection
