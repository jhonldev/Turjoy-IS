@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite('resources/css/app.css')
        <title>Document</title>
        <style>
            .textError {
              color: #FF8A80;
            }
          </style>
    </head>
    <body>
        <section class="bg-grey-custom-light">
            <div class="flex flex-col items-center px-6 py-6 mx-auto md:h-screen lg:py-0">
                <div class="w-full bg-white rounded-lg shadow  sm:max-w-md xl:p-0">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-2xl text-grey-custom-dark" style="font-weight: bold">Buscar Reserva</h1>

                        <form class="novalidate" method="GET" action="{{ route('search') }}">
                            @csrf
                            <div>
                                <input type="text" name="code" id="code" class="mb-5 bg-grey-custom-neutral border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Buscar reserva por código">
                            </div>
                            @if (session('message'))

                            <p class="textError">{{session('message')}}</p>

                            @endif
                            <button type="submit" class="w-full text-white bg-grey-custom-dark hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Buscar</button>

                        </form>

                    </div>
                </div>


            </div>
          </section>
    </body>
    </html>
@endsection