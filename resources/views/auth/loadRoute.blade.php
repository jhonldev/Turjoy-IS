@extends('layouts.app')

@section ('content')
<h1 class="text-center mt-11 text-4xl font-bold text-grey-custom-dark"> Registro de tramos cargados</h1>
    <div class="p-6 space-y-4 md:space-y-6 sm:p-11">
        <div class="w-2/3 relative overflow-x-auto rounded-lg overflow-y-auto" style="max-height: 700px; overflow-y: auto;" >
            @vite('resources/css/app.css')
            <table class="w-full text-sm text-left">
                <thead class="border-b-2 uppercase dark:bg-grey-custom-darkSmoke dark:text-grey-custom-dark">
                    <tr>
                        <th scope="col" class="px-6 py-3 border-r-2">
                            origen
                        </th>
                        <th scope="col" class="px-6 py-3 border-r-2">
                            Destino
                        </th>
                        <th scope="col" class="px-6 py-3 border-r-2">
                            Asientos disponibles
                        </th>
                        <th scope="col" class="px-6 py-3 border-r-2">
                            Tarifa base
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($validRoutes) > 0)
                        @foreach ($validRoutes as $validRoute)
                            <tr class="border-b-2 dark:bg-green-custom-validate ">
                                <td class="px-6 py-4 text-grey-custom-dark border-r-2 whitespace-nowrap">
                                    {{ $validRoute->origin}}
                                </td>
                                <td class="px-6 py-4 text-grey-custom-dark border-r-2 whitespace-nowrap">
                                    {{ $validRoute->destination}}
                                </td>
                                <td class="px-6 py-4 text-grey-custom-dark border-r-2 whitespace-nowrap">
                                    {{$validRoute->available_seats}}
                                </td>
                                <td class="px-6 py-4 text-grey-custom-dark border-r-2 whitespace-nowrap">
                                    {{'$'. $validRoute->base_rate . ' CLP'}}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    @if (count($invalidRoutes) > 0)
                        @foreach ($invalidRoutes as $invalidRoute)
                        <tr class="border-b-2 dark:bg-red-custom-invalidate">
                            <td class="px-6 py-4 text-grey-custom-dark border-r-2 whitespace-nowrap">
                                {{ $invalidRoute->origin}}
                            </td>
                            <td class="px-6 py-4 text-grey-custom-dark border-r-2 whitespace-nowrap">
                                {{ $invalidRoute->destination}}
                            </td>
                            <td class="px-6 py-4 text-grey-custom-dark border-r-2 whitespace-nowrap">
                                {{$invalidRoute->available_seats}}
                            </td>
                            <td class="px-6 py-4 text-grey-custom-dark border-r-2 whitespace-nowrap">
                                {{'$'. $invalidRoute->base_rate . ' CLP'}}
                            </td>
                            </tr>

                        @endforeach

                    @endif
                    @if (count($cloneRoutes) > 0)
                        @foreach ($cloneRoutes as $cloneRoute)
                        <tr class="border-b-2 dark:bg-yellow-custom-clone ">
                            <td class="px-6 py-4 text-grey-custom-dark border-r-2 whitespace-nowrap">
                                {{ $cloneRoute->origin}}
                            </td>
                            <td class="px-6 py-4 text-grey-custom-dark border-r-2 whitespace-nowrap">
                                {{ $cloneRoute->destination}}
                            </td>
                            <td class="px-6 py-4 text-grey-custom-dark border-r-2 whitespace-nowrap">
                                {{$cloneRoute->available_seats}}
                            </td>
                            <td class="px-6 py-4 text-grey-custom-dark border-r-2 whitespace-nowrap">
                                {{'$'. $cloneRoute->base_rate . ' CLP'}}
                            </td>
                            </tr>
                        @endforeach

                    @endif

                </tbody>
            </table>
        </div>
    </div>
@endsection
