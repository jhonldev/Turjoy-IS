@extends('layouts.app')

@section ('content')
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <div class="relative overflow-x-auto rounded-lg">
            @vite('resources/css/app.css')
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-grey-custom-darkSmoke dark:text-grey-custom-dark">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            origen
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Destino
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Asientos disponibles
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Precio por asiento
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($routes as $route)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $route->origin }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $route->destination}}
                        </td>
                        <td class="px-6 py-4">
                            {{$route->available_seats}}
                        </td>
                        <td class="px-6 py-4">
                            {{$route->base_rate}}
                        </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
