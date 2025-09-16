<?php

namespace App\Http\Controllers;

abstract class Controller
{
    // Mensajes personalizados para esta validación
    public $messages = [
        'username.unique' => 'Este nombre de usuario (email) ya está en uso. Por favor, elige otro.',
        'username.required' => 'El usuario es obligatorio.',
        'username.min' => 'El correo electrónico debe ser mínimo de 8 caracteres.',
        'username.max' => 'El correo electrónico debe ser máximo de 50 caracteres.',
        'username.email' => 'El correo electrónico debe ser un email.',
        // Puedes añadir más mensajes específicos si lo necesitas, por ejemplo:
        // 'name.required' => 'El campo Nombre es obligatorio.',
        'password.required' => 'La contraseña es requerida.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
        'pass_actual.required' => 'La contraseña actual es requerida.',
        'roles_nombre.required' => 'El <strong>Nombre</strong> es requerido.',
        'roles_icono.required' => 'El <strong>Icono</strong> es requerido.',
    ];

    public $urlLogo = 'https://www.sonkei.cl/imgs/logo_v2.webp';
}
