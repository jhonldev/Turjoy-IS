@extends('layouts.app')

@section('content')
    @if ($validRows || $invalidRows || $duplicatedRows)
        <div class="flex flex-1 flex-col gap-2">
            @if (count($validRows) > 0)
                <h3 class="text-2xl text-black font-semibold uppercase text-center">Listado de viajes agregados
                    correctamente
                </h3>
                <div class="relative overflow-x-auto sm:rounded-lg mb-2">
                    <table class="w-1/2 mx-auto text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-green-600 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-white font-bold">
                                Origen
                            </th>
                            <th scope="col" class="px-6 py-3 text-white font-bold">
                                Destino
                            </th>
                            <th scope="col" class="px-6 py-3 text-white font-bold">
                                Cantidad de asientos
                            </th>
                            <th scope="col" class="px-6 py-3 text-white font-bold">
                                Tarifa base
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($validRows as $validRow)
                            <tr class="bg-green-400 border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white">
                                    {{ $validRow[0] }}
                                </th>
                                <td class="px-6 py-4 text-white font-medium">
                                    {{ $validRow[1] }}
                                </td>
                                <td class="px-6 py-4 text-white font-medium">
                                    {{ $validRow[2] }}
                                </td>
                                <td class="px-6 py-4 text-white font-medium">
                                    {{ $validRow[3] }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            @if (count($invalidRows) > 0)
                <h3 class="text-2xl text-black font-semibold uppercase text-center">
                    Listado de viajes que presentaron errores
                </h3>
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <table class="w-1/2 mx-auto text-sm text-left text-gray-500 dark:text-gray-400 mb-2">
                        <thead class="text-xs text-gray-700 uppercase bg-red-600 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-white font-bold">
                                Origen
                            </th>
                            <th scope="col" class="px-6 py-3 text-white font-bold">
                                Destino
                            </th>
                            <th scope="col" class="px-6 py-3 text-white font-bold">
                                Cantidad de asientos
                            </th>
                            <th scope="col" class="px-6 py-3 text-white font-bold">
                                Tarifa base
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($invalidRows as $invalidRow)
                            <tr class="bg-red-400 border-b dark:bg-gray-900 dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-white">
                                    {{ $invalidRow[0] ? $invalidRow[0] : '---' }}
                                </td>
                                <td class="px-6 py-4 text-white font-medium">
                                    {{ $invalidRow[1] ? $invalidRow[1] : '---' }}
                                </td>
                                <td class="px-6 py-4 text-white font-medium">
                                    {{ $invalidRow[2] ? $invalidRow[2] : '---' }}
                                </td>
                                <td class="px-6 py-4 text-white font-medium">
                                    {{ $invalidRow[3] ? $invalidRow[3] : '---' }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            @if (count($duplicatedRows) > 0)
                <h3 class="text-2xl text-black font-semibold uppercase text-center">
                    Listado de viajes que se encuentran duplicados
                </h3>
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <table class="w-1/2 mx-auto text-sm text-left text-gray-500 dark:text-gray-400 mb-2">
                        <thead class="text-xs text-gray-700 uppercase bg-amber-600 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-white font-bold">
                                Origen
                            </th>
                            <th scope="col" class="px-6 py-3 text-white font-bold">
                                Destino
                            </th>
                            <th scope="col" class="px-6 py-3 text-white font-bold">
                                Cantidad de asientos
                            </th>
                            <th scope="col" class="px-6 py-3 text-white font-bold">
                                Tarifa base
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($duplicatedRows as $duplicatedRow)
                            <tr class="bg-yellow-400 border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white">
                                    {{ $duplicatedRow[0] }}
                                </th>
                                <td class="px-6 py-4 text-white font-medium">
                                    {{ $duplicatedRow[1] }}
                                </td>
                                <td class="px-6 py-4 text-white font-medium">
                                    {{ $duplicatedRow[2] }}
                                </td>
                                <td class="px-6 py-4 text-white font-medium">
                                    {{ $duplicatedRow[3] }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    @else
        <h1 class="text-center mt-3 mb-4 text-2xl font-bold text-grey-custom-dark"> Cargar archivo excel para importación de datos</h1>
        <div class="flex items-center justify-center w-full">
            <form class="flex flex-col items-center w-full" action="{{ route('routes.check') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">XLSX (MAX. 5Mb)</p>
                </div>
                <input type="file" id="dropzone-file" name="file" class="unhidden">
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
