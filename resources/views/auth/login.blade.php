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
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex flex-col items-center mb-6 text-2xl font-semibold text-gray-900">
          <img class="mr-2" src="{{asset('images/Turjoy2_sinEslogan.png')}}" alt="turjoy-logo" width="200" height="200">
          <p>Turjoy</p>
      </a>
      <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
                  Bienvenido a Turjoy
              </h1>
              <form class="space-y-4 md:space-y-6" action="{{route('loadRoute')}}" novalidate>
                @csrf
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Correo electrónico</label>
                      <input type="email" name="email" id="email" class="bg-grey-custom-neutral border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Correo@dirección.com" >

                    @error('email')

                    <p class="textError">{{$message}}</p>

                    @enderror

                    </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-grey-custom-dark">Contraseña</label>
                      <input type="password" name="password" id="password" placeholder="••••••••" class="bg-grey-custom-neutral border border-grey-custom-neutral text-grey-custom-dark sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ">

                    @error('password')

                      <p class="textError">{{$message}}</p>

                    @enderror


                    </div>

                  <button type="submit" class="w-full text-white bg-grey-custom-dark hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Ingresar</button>
              </form>
          </div>
      </div>
  </div>
</section>
</body>
</html>
