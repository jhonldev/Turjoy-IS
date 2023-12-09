@extends('layouts.app')

@section('title')
    Turjoy | Rutas del día
@endsection


@section('content')
<h3 class = "my-6 font-bold text-center text-3x1 uppercase">rutas del dia</h3>

<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
        <tbody>

            @foreach ($routes as $route)
            <tr class="bg-white border-b  ">
                <th scope="row" class="px-6 py-4 font-medium text-grey-custom-dark whitespace-nowrap">
                {{$route->origin}}
                </th>
                <td class="px-6 py-4">
                {{$route->destination}}
                </td>
                <td class="px-6 py-4">
                {{$route->available_seats}}
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
