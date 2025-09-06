<?php

use Src\Route;

// Общие маршруты
Route::add('GET', '/', [Controller\SiteController::class, 'index']);
Route::add(['GET', 'POST'], '/signup', [Controller\AuthController::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\AuthController::class, 'login']);
Route::add('GET', '/logout', [Controller\AuthController::class, 'logout']);

// Маршруты для авторизованных пользователей
Route::add('GET', '/hello', [Controller\SiteController::class, 'hello'])->middleware('auth');
Route::add('GET', '/readers', [Controller\ReadersController::class, 'readers'])->middleware('auth');
Route::add('GET', '/books', [Controller\BooksController::class, 'books'])->middleware('auth');

// Маршруты для библиотекаря
Route::add(['GET', 'POST'], '/add-book', [Controller\BooksController::class, 'addBook'])
    ->middleware('auth:librarian');
Route::add('GET', '/delete-book/{id}', [Controller\BooksController::class, 'deleteBook'])
    ->middleware('auth:librarian');
Route::add(['GET', 'POST'], '/add-reader', [Controller\ReadersController::class, 'addReader'])
    ->middleware('auth:librarian');
Route::add(['GET', 'POST'], '/issue-book', [Controller\BooksController::class, 'issueBook'])
    ->middleware('auth:librarian');