@extends('layouts.app')

@section('title')
    Turjoy | Rutas del día
@endsection


@section('content')
<h3 class="my-6 font-bold text-center text-3xl uppercase">Rutas del día</h3>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <!-- Encabezado de la tabla -->
            <thead class="text-xs text-grey-custom-dark uppercase">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Origen
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Destino
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cantidad de asientos
                    </th>
                </tr>
            </thead>
            <!-- Cuerpo de la tabla -->
            <tbody>
                @foreach ($routes as $route)
                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-grey-custom-dark whitespace-nowrap">
                            {{ $route->origin }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $route->destination }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $route->available_seats }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex items-center justify-between mt-4">
        <div>
            @if ($routes->currentPage() > 1)
                <a href="{{ $routes->previousPageUrl() }}" class="bg-blue-custom-100 text-white px-4 py-2 rounded-md mr-2">Anterior</a>
            @endif
        </div>

        <div>
            @if ($routes->hasMorePages())
                <a href="{{ $routes->nextPageUrl() }}" class="bg-blue-custom-100 text-white px-4 py-2 rounded-md ml-2">Siguiente</a>
            @endif
        </div>
    </div>

@endsection
