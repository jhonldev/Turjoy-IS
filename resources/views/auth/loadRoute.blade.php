@extends('layouts.app')

@section ('content')
<h1 class="text-center mt-11 text-4xl font-bold text-grey-custom-dark"> Registro de tramos cargados</h1>
    <div class="flex p-6 space-y-4 md:space-y-6 sm:p-11">
        <div class="w-2/3 relative overflow-x-auto rounded-lg overflow-y-auto " style="max-height: 700px; overflow-y: auto;" >

            @vite('resources/css/app.css')
            <table class="w-full text-sm text-left ">
                <thead class="border-b-2 uppercase dark:bg-grey-custom-darkSmoke dark:text-grey-custom-dark sticky top-0 border-grey-custom-light"style="background-color: #EAEAEA;">
                    <tr>
                        <th scope="col" class="px-6 py-3 border-r-2 border-grey-custom-light ";>
                            origen
                        </th>
                        <th scope="col" class="px-6 py-3 border-r-2 border-grey-custom-light ">
                            Destino
                        </th>
                        <th scope="col" class="px-6 py-3 border-r-2 border-grey-custom-light ">
                            Asientos disponibles
                        </th>
                        <th scope="col" class="px-6 py-3 border-r-2 border-grey-custom-light ">
                            Tarifa base
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($validRoutes) > 0)
                        @foreach ($validRoutes as $validRoute)
                            <tr class="border-b-2 border-grey-custom-light dark:bg-green-custom-validate ">
                                <td class="px-6 py-4 text-grey-custom-dark border-r-2 border-grey-custom-light whitespace-nowrap">
                                    {{ $validRoute->origin}}
                                </td>
                                <td class="px-6 py-4 text-grey-custom-dark border-r-2 border-grey-custom-light whitespace-nowrap">
                                    {{ $validRoute->destination}}
                                </td>
                                <td class="px-6 py-4 text-grey-custom-dark border-r-2 border-grey-custom-light whitespace-nowrap">
                                    {{$validRoute->available_seats}}
                                </td>
                                <td class="px-6 py-4 text-grey-custom-dark border-r-2 border-grey-custom-light whitespace-nowrap">
                                    {{'$'. $validRoute->base_rate . ' CLP'}}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    @if (count($invalidRoutes) > 0)
                        @foreach ($invalidRoutes as $invalidRoute)
                        <tr class="border-b-2  dark:bg-red-custom-invalidate">
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
        <style>
            ::-webkit-scrollbar {
                width: 8px;
            }

            ::-webkit-scrollbar-track {
                background-color: rgba(51, 51, 51, 0.19);
            }

            ::-webkit-scrollbar-thumb {
                background-color: rgba(51, 51, 51, 0.7);
                border-radius: 5px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background-color: rgba(51, 51, 51, 0.4);
            }
        </style>
        <div class="w-1/3 m1-4">
            <h2 class="text-center text-2xl font-bold text-grey-custom-dark ml-12">Simbología</h2>

            <div class="bg-green-custom-validate p-4 ml-11 m-3 rounded-lg">
                <p class="text-grey-custom-dark text-center">Se carga correctamente</p>
            </div>

            <div class="bg-red-custom-invalidate p-4 ml-11 m-3 rounded-lg">
                <p class="text-grey-custom-dark text-center">
                    No se pudieron cargar debido a:
                </p>
                <p class="text-grey-custom-dark text-center">
                    # Origen y destino repetidos
                </p>
                <p class="text-grey-custom-dark text-center">
                    # Datos faltantes en origen,
                    destino, cantidad de
                    asientos o tarifa base
                </p>
                <p class="text-grey-custom-dark text-center">
                    # Valores no numéricos
                </p>
                <p class="text-grey-custom-dark text-center">
                    # Valores negativos
                </p>
            </div>

            <div class="bg-yellow-custom-clone p-4 ml-11 m-3 rounded-lg">
                <p class="text-grey-custom-dark text-center">
                    No se pudieron cargar debido a que ya existen anteriormente. El primer registro correcto entre Origen y Destino se considera válido, el resto incorrectos.</p>
            </div>


        </div>
    </div>
@endsection
