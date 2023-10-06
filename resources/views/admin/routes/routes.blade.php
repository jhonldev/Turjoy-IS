@extends('layouts.app')

@section('content')
    @if ($validRows || $invalidRows || $duplicatedRows)
    <h1 class="text-center mt-11 text-4xl font-bold text-grey-custom-dark"> Registro de tramos cargados</h1>
    <div class="flex p-6 space-y-4 md:space-y-6 sm:p-11">
        <div class="w-2/3 relative overflow-x-auto rounded-lg overflow-y-auto " style="max-height: 600px; overflow-y: auto;">

            @vite('resources/css/app.css')
            <table class="w-full text-sm text-left ">
                <thead class="border-b-2 uppercase dark:bg-grey-custom-darkSmoke dark:text-grey-custom-dark sticky top-0 border-grey-custom-light" style="background-color: #EAEAEA;">
                    <tr>
                        <th scope="col" class="px-6 py-3 border-r-2 border-grey-custom-light ";>
                            origen
                        </th>
                        <th scope="col" class="px-6 py-3 border-r-2 border-grey-custom-light ">
                            Destino
                        </th>
                        <th scope="col" class="px-6 py-3 border-r-2 border-grey-custom-light ">
                            Cantidad de asientos
                        </th>
                        <th scope="col" class="px-6 py-3 border-r-2 border-grey-custom-light ">
                            Tarifa base
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($validRows) > 0)
                        @foreach ($validRows as $validRow)
                            <tr class="border-b-2 border-grey-custom-light dark:bg-green-custom-validate ">
                                <td class="px-6 py-3 text-grey-custom-dark border-r-2 border-grey-custom-light whitespace-nowrap">
                                    {{ $validRow[0] }}
                                </td>
                                <td class="px-6 py-3 text-grey-custom-dark border-r-2 border-grey-custom-light whitespace-nowrap">
                                    {{ $validRow[1] }}
                                </td>
                                <td class="px-6 py-3 text-grey-custom-dark border-r-2 border-grey-custom-light whitespace-nowrap">
                                    {{ $validRow[2] }}
                                </td>
                                <td class="px-6 py-3 text-grey-custom-dark border-r-2 border-grey-custom-light whitespace-nowrap">
                                    {{'$'. $validRow[3] . ' CLP'}}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    @if (count($invalidRows) > 0)
                        @foreach ($invalidRows as $invalidRow)
                        <tr class="border-b-2  dark:bg-red-custom-invalidate">
                            <td class="px-6 py-3 text-grey-custom-dark border-r-2 whitespace-nowrap">
                                {{ $invalidRow[0]}}
                            </td>
                            <td class="px-6 py-3 text-grey-custom-dark border-r-2 whitespace-nowrap">
                                {{ $invalidRow[1]}}
                            </td>
                            <td class="px-6 py-3 text-grey-custom-dark border-r-2 whitespace-nowrap">
                                {{$invalidRow[2]}}
                            </td>
                            <td class="px-6 py-3 text-grey-custom-dark border-r-2 whitespace-nowrap">
                                {{'$'. $invalidRow[3] . ' CLP'}}
                            </td>
                            </tr>

                        @endforeach

                    @endif
                    @if (count($duplicatedRows) > 0)
                        @foreach ($duplicatedRows as $duplicatedRow)
                        <tr class="border-b-2 dark:bg-yellow-custom-clone ">
                            <td class="px-6 py-3 text-grey-custom-dark border-r-2 whitespace-nowrap">
                                {{ $duplicatedRow[0]}}
                            </td>
                            <td class="px-6 py-3 text-grey-custom-dark border-r-2 whitespace-nowrap">
                                {{ $duplicatedRow[1]}}
                            </td>
                            <td class="px-6 py-3 text-grey-custom-dark border-r-2 whitespace-nowrap">
                                {{$duplicatedRow[2]}}
                            </td>
                            <td class="px-6 py-3 text-grey-custom-dark border-r-2 whitespace-nowrap">
                                {{'$'. $duplicatedRow[3] . ' CLP'}}
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
    <div class="w-full text-center text-green-600 font-semibold mt-4" id="file-uploaded-message">Archivo cargado</div>
    @else
        <h1 class="text-center mt-11 text-4xl font-bold text-grey-custom-dark""> Cargar archivo excel para importación de datos</h1>
        <div class="flex items-center justify-center w-full">
            <form class="flex flex-col items-center w-full mt-11" action="{{ route('routes.check') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                    </svg>
                    <p class="text-xs text-gray-500 dark:text-gray-400">XLSX (MAX. 5Mb)</p>
                </div>
                <input type="file" id="dropzone-file" name="file" class="unhidden"  style="display: none">

                @error('file')
                <p class="bg-red-400 font-semibold my-4 text-lg text-center text-red-800 px-4 py-3 rounded-lg">
                    {{ $message }}</p>
                @enderror
            </label>
            <button class="lg:w-1/4 my-4 p-2 bg-green-400 rounded-sm text-white font-semibold" type="submit">
                Importar rutas
            </button>
            </form>

        </div>
    @endif
@endsection
