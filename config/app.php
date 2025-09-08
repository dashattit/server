<?php
return [
    //Класс аутентификации
    'auth' => \Src\Auth\Auth::class,
    //Клас пользователя
    'identity' => \Model\Librarians::class,
    //Классы для middleware
    'routeMiddleware' => [
        'auth' => \Middlewares\AuthMiddleware::class,
        'isAdmin' => \Middlewares\AdminMiddleware::class
    ],
    'routeAppMiddleware' => [
        'csrf' => \Middlewares\CSRFMiddleware::class,
        'trim' => \Middlewares\TrimMiddleware::class,
        'specialChars' => \Middlewares\SpecialCharsMiddleware::class,
    ],
    'validators' => [
        'required' => \dashattit\Validators\RequireValidator::class,
        'unique' => \dashattit\Validators\UniqueValidator::class,
        'fullname' => \Validators\AuthorFullNameValidator::class,
        'avatar' => \dashattit\Validators\AvatarValidator::class,
        'password' => \dashattit\Validators\NumericValidator::class,
        'telephone' => \Validators\TelephoneValidator::class,
        'numeric' => \dashattit\Validators\NumericValidator::class,
    ]
];