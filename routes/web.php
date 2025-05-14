<?php

use Src\Route;
use ControllerBookController;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add('GET', '/readers', [Controller\Site::class, 'readers'])
    ->middleware('auth');
Route::add('GET', '/books', [Controller\Site::class, 'books'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);