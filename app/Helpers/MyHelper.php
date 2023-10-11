<?php


function makeMessages(){

    $messages = [
        'email.required' => 'debe ingresar su correo electrónico para iniciar sesión',
        'email.email' => 'usuario no registrado o contraseña incorrecta',
        'password.required' => 'debe ingresar su contraseña para iniciar sesión',
        'file.required' => 'El campo documento es requerido.',
        'file.mimes' => 'El archivo seleccionado no es Excel con extensión .xlsx.',
        'file.max' => 'El tamaño máximo del archivo a cargar no puede superar los 5 megabytes'
    ];

    return $messages;

}
