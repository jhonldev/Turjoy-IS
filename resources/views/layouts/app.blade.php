<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title')</title>
</head>

<body class="bg-grey-custom-neutral">

   <nav class=" bg-grey-custom-dark">
      <div class="flex flex-wrap items-center justify-between mx-auto p-4">


              @yield('openButton')
              <a href="{{route('register')}}" class="flex items-center">
                  <img src="{{asset('images/Turjoy2_sinEslogan.png')}}" class="h-14 mr-4" alt="Turjoy Logo" />
                  <span class="self-center text-4xl font-semibold whitespace-nowrap text-white ">Turjoy</span>
              </a>

        <!-- drawer init and show -->
         <div class="text-center">
            <button
               class="text-white font-medium rounded-lg text-sm px-5 py-2.5 mr-2  focus:outline-none"
               type="button" data-drawer-target="drawer_navigation" data-drawer-show="drawer_navigation" data-drawer-placement="right"
               aria-controls="drawer_navigation">
               <img class="w-12" src="{{ asset('http://127.0.0.1:8000/images/icono-nueve-puntos.png') }}" alt="Icono Nueve Puntos" class="w-6 h-6 text-white">
            </button>
         </div>
      </div>

    </nav>


<!---------------------------------------------------------------------------->


 <!-- drawer component -->
 <div id="drawer_navigation" class="fixed rounded-tl-lg top-[110px] right-0 z-40 h-[calc(100vh-60px)] p-4 overflow-y-auto transition-transform translate-y-full  w-80 bg-grey-custom-dark tabindex="-1" aria-labelledby="drawer-right-label" style="border-top-left-radius: 1.1rem;">
       <div class="py-4 overflow-y-auto">
           <ul class="space-y-2 font-medium">
            @guest
            <li>
                <a href="{{route('login')}}"
                class="flex items-center p-2 rounded-lg text-white hover:bg-blue-custom-blueSmoke">
                    <img src="{{ asset('http://127.0.0.1:8000/images/icono-user.png') }}" alt="Icono iniciar sesion" class="w-14 h-12 mr-1">
                    <span class="ml-3">Iniciar Sesión</span>
            </a>
           </li>
            @endguest
            @auth
               <li>
                    <a
                    class="flex items-center p-2 rounded-lg text-white">
                        <img src="{{ asset('http://127.0.0.1:8000/images/icono-user.png') }}" alt="Icono usuario" class="w-14 h-12 mr-1">
                        <span class="ml-3">{{auth()->user()->name}}</span>
                </a>
               </li>
               <li>
                    <a href="{{route('routes.index')}}"
                    class="flex items-center p-2 rounded-lg text-white hover:bg-blue-custom-blueSmoke">
                        <img src="{{ asset('http://127.0.0.1:8000/images/icono-pagina.png') }}" alt="Cargar rutas de viaje" class="w-10 h-12 ml-2 mr-3">
                        <span class="ml-3">Cargar rutas de viaje</span>
                </a>
               </li>
               @endauth
               @guest
               <li>
                    <a href="{{route('register')}}"
                    class="flex items-center p-2 rounded-lg text-white hover:bg-blue-custom-blueSmoke">
                    <img src="{{ asset('http://127.0.0.1:8000/images/icono-reservar-pasaje.png') }}" alt="Reservar pasajes" class="w-14 h-12 mr-1">
                    <span class="ml-3">Reservar pasajes</span>
                </a>
               </li>
               @endguest
               <li>
                <a href="{{route('register')}}"
                class="flex items-center p-2 rounded-lg text-white  hover:bg-blue-custom-blueSmoke">
                    <img src="{{ asset('http://127.0.0.1:8000/images/icono-consultar-reserva.png') }}" alt="Buscar reservas" class="w-12 h-12 mr-2 ml-1">
                    <span class="ml-3">Buscar reservas</span>
            </a>
               </li>
               @auth
               <li>
                    <a href="{{route('register.index')}}"
                    class="flex items-center p-2 rounded-lg text-white hover:bg-blue-custom-blueSmoke">
                        <img src="{{ asset('http://127.0.0.1:8000/images/icono-reporte-reserva.png') }}" alt="Reporte de reservas" class="w-12 h-12 mr-2 ml-1">
                        <span class="ml-3">Reporte de reservas</span>
                </a>
               </li>
               <li>
                   <a method="GET" href="{{route('logout')}}"
                       class="flex items-center p-2 rounded-lg text-white hover:bg-blue-custom-blueSmoke">
                       <img src="{{ asset('http://127.0.0.1:8000/images/icono-salida.png') }}" alt="Reporte de reservas" class="w-12 h-12 mr-2 ml-1">
                       <span class="flex-1 ml-3 whitespace-nowrap">Cerrar Sesión</span>
                   </a>
               </li>
               @endauth
           </ul>
       </div>
 </div>










<!---------------------------------------------------------------------------->




    <!-- CONTENT SECTION -->
    <main class="container mx-auto">
        @yield('content')
    </main>
    <!-- FOOTER SECTION -->

</body>
@yield('js')
</html>
