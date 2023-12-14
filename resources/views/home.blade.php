@extends('layouts.app')

@section('title')
    Turjoy | Reserva
@endsection


@section('content')
    @if ($countTravels > 0)
        <div class="flex items-center justify-center px-6 py-8 mx-auto lg:py-0" style="min-height: 85vh">

            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class= "p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
                        Reserva de pasajes en Turjoy
                    </h1>
                    <form id=form action="{{ route('add-reservation') }}" method="POST">
                        @csrf
                        <div class="relative max-w-sm mt-8">
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-grey">
                                Fecha
                            </label>
                            <input id="date" datepicker datepicker-autohide type="date" name="date"
                                onkeydown="return false"
                                class="block w-full p-2 mb-6 text-sm text-grey-custom-dark border border-grey-custom-light rounded-lg bg-grey-custom-neutral focus:ring-blue-custom-100 focus:border-grey-custom-dark  ">
                        </div>

                        <div>
                            <label for="origins" class="block mb-2 text-sm font-medium text-gray-900 dark:text-grey">
                                Origen
                            </label>

                            <select id="origins" name="origins"
                                class="block w-full p-2 mb-6 text-sm text-grey-custom-dark border border-grey-custom-light rounded-lg bg-grey-custom-neutral focus:ring-blue-custom-100 focus:border-grey-custom-dark  ">
                                <option value="" selected>Seleccione un origen </option>

                            </select>
                        </div>
                        <div>
                            <label for="destinations" class="block mb-2 text-sm font-medium text-grey-custom-dark ">
                                Destino
                            </label>

                            <select id="destinations" name="destinations"
                                class="block w-full p-2 mb-6 text-sm text-gray-900 border border-grey-custom-neutral rounded-lg bg-grey-custom-neutral focus:ring-blue-custom-100 focus:border-grey-custom-dark">
                                <option value="" selected>Seleccione un destino </option>
                            </select>
                        </div>
                        <div>
                            <label for="seat" class="block mb-2 text-sm font-medium text-grey-custom-dark dark:text-grey">
                                Cantidad de asientos
                            </label>
                            <select id="seat" name="seat"
                                class="block w-full p-2 text-sm text-grey-custom-dark border border-grey-custom-light rounded-lg bg-grey-custom-neutral focus:ring-blue-custom-100 focus:border-grey-custom-dark ">
                                <option selected>Seleccione la cantidad de asientos </option>
                            </select>
                            <p id="error" class="textError p-2"></p>

                        </div>
                        {{-- Precio reserva --}}
                        <div style="margin-top: 15px">
                            <input id="base-rate" name="total" value="" hidden>
                            <button type="button" id="button"
                                class="p-6 w-full text-white bg-grey-custom-dark hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Reservar
                            </button>
                        </div>
                        <div>
                            <p class="text-lg text-center text-red-custom-invalidate px-4 py-3 " id="error"></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0" style="min-height: 85vh">
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class= "p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-grey-custom-dark md:text-2xl ">
                        por el momento no es posible realizar reservas, intente más tarde
                    </h1>
                </div>
            </div>
        </div>
    @endif
@endsection


@section('js')
    <script src="{{ asset('assets/index.js') }}"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Aqui va nuestro script de sweetalert
        const button = document.getElementById("button");
        const form = document.getElementById("form");

        button.addEventListener('click', (e) => {
            // Informacion Reserva
            const selectedOrigin = document.getElementById('origins').value;
            const selectedDestination = document.getElementById('destinations').value;

            const datePicker = document.getElementById('date').value;
            const selectedSeat = document.getElementById('seat').value;
            const fecha = new Date(datePicker);
            fecha.setTime(fecha.getTime() + fecha.getTimezoneOffset() * 60 * 1000 + 60 * 60 * 1000);
            const dateFormatted = fecha.toLocaleDateString('es-ES', datePicker)

            const baseRate = document.getElementById('base-rate').value;
            let payment = (baseRate * selectedSeat).toLocaleString('de-DE');

            e.preventDefault();
            if (!datePicker) {
                e.preventDefault();
                let error = "debe seleccionar la fecha del viaje antes de realizar la reserva";
                document.getElementById('error').textContent = error;
                return;
            }else{
                if (!selectedSeat || isNaN(selectedSeat)) {
                    e.preventDefault();
                    let error = "debe seleccionar la cantidad de asientos antes de realizar la reserva";
                    document.getElementById('error').textContent = error;
                    return;
                }
            }

            if (selectedOrigin && selectedDestination && datePicker && selectedSeat && baseRate) {
                Swal.fire({

                    //title: "¿Desea continuar?",
                    text: "El total de la reserva entre " + selectedOrigin +
                        " y " + selectedDestination + " para el día " + dateFormatted + " es de " +
                        "$" + payment + " CLP " +
                        `(${selectedSeat} Asientos) ¿Desea continuar?`,
                    //icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#2ECC71",
                    cancelButtonColor: "#FF6B6B",
                    confirmButtonText: "Confirmar",
                    cancelButtonText: "Volver",
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var datepicker = document.getElementById('date');
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1;
            var yyyy = today.getFullYear();

            if (dd < 10) {
                dd = '0' + dd;
            }

            if (mm < 10) {
                mm = '0' + mm;
            }

            today = yyyy + '-' + mm + '-' + dd;
            datepicker.setAttribute('min', today);
        });
    </script>
@endsection