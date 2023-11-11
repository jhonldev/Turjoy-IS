@extends('layouts.app')

@section('title')
    Turjoy | Reserva
@endsection


@section('content')
    @if ($countTravels > 0)
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class= "p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
                        Reserva de pasajes en Turjoy
                    </h1>
                    <form action="#" method="POST">
                        @csrf
                        <div class="relative max-w-sm mt-8">

                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-grey">
                                Fecha
                            </label>
                            <input type="date" id="date" name="date"
                                class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-grey-custom-neutral focus:ring-blue-500 focus:border-grey-custom-dark dark:bg-grey-custom-neutral dark:border-gray-600 dark:placeholder-gray-400 dark:text-grey-custom-dark dark:focus:border-grey-custom-dark dark:focus:border-blue-500">
                        </div>

                        <div>
                            <label for="origins" class="block mb-2 text-sm font-medium text-gray-900 dark:text-grey">
                                Origen
                            </label>

                            <select id="origins" name="origins"
                                class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-grey-custom-neutral focus:ring-blue-500 focus:border-grey-custom-dark dark:bg-grey-custom-neutral dark:border-gray-600 dark:placeholder-gray-400 dark:text-grey-custom-dark dark:focus:border-grey-custom-dark dark:focus:border-blue-500">
                                <option selected>Seleccione un origen </option>
                            </select>
                        </div>
                        <div>
                            <label for="destinations" class="block mb-2 text-sm font-medium text-gray-900 dark:text-grey">
                                Destino
                            </label>

                            <select id="destinations" name="destinations"
                                class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-grey-custom-neutral focus:ring-blue-500 focus:border-grey-custom-dark dark:bg-grey-custom-neutral dark:border-gray-600 dark:placeholder-gray-400 dark:text-grey-custom-dark dark:focus:border-grey-custom-dark dark:focus:border-blue-500">
                                <option selected>Seleccione un destino </option>
                            </select>
                        </div>
                        <div>
                            <label for="seat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-grey">
                                Cantidad de asientos
                            </label>
                            <select id="seat" name="seat"
                                class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-grey-custom-neutral focus:ring-blue-500 focus:border-grey-custom-dark dark:bg-grey-custom-neutral dark:border-gray-600 dark:placeholder-gray-400 dark:text-grey-custom-dark dark:focus:border-grey-custom-dark dark:focus:border-blue-500">
                                <option selected>Seleccione la cantidad de asientos </option>
                            </select>
                        </div>
                        <button type="submit"
                        class="w-full text-white bg-grey-custom-dark hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Reservar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @else
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class= "p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
                        por el momento no es posible realizar reservas, intente más tarde
                    </h1>
                </div>
            </div>
        </div>
    @endif
@endsection


@section('js')
    <script src="{{asset('assets/index.js')}}"></script>
@endsection
