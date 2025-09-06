<?php
return [
    //Класс аутентификации
    'auth' => \Src\Auth\Auth::class,
    //Клас пользователя
    'identity' => \Model\Librarians::class,
    //Классы для middleware
    'routeMiddleware' => [
        'auth' => \Middlewares\AuthMiddleware::class,
    ],
    'roles' => [
    'admin' => 'admin',
    'librarian' => 'librarian',
    'user' => 'user'
]
];