@extends('layouts.app')

@section('title')
    Turjoy | Rutas del día
@endsection


@section('content')
<div class="flex items-center justify-center">
    <a href="{{ route('dailyRoutes') }}" class="bg-yellow-custom-clone transition-all my-auto py-4 px-4 text-white rounded-lg mr-4" title= "Recargar busqueda">
        <svg class="w-5 h-5 hover:animate-spin text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 1v5h-5M2 19v-5h5m10-4a8 8 0 0 1-14.947 3.97M1 10a8 8 0 0 1 14.947-3.97" />
        </svg>
    </a>
    <h3 class="my-6 font-bold text-center text-3xl uppercase">Rutas del día</h3>
</div>

@if ($routes->isEmpty())
<h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
    No hay rutas disponibles para el día de hoy
</h1>
@else
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

        <a href="{{ route('home') }}" class="bg-green-custom-100 text-white px-4 py-2 rounded-md ml-2">Ir a reservar pasajes</a>

    </div>
    <div>
        @if ($routes->hasMorePages())
            <a href="{{ $routes->nextPageUrl() }}" class="bg-blue-custom-100 text-white px-4 py-2 rounded-md ml-2">Siguiente</a>
        @endif
    </div>
</div>
@endif


@endsection
