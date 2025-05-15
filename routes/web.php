<?php

use Src\Route;

use ControllerBookController;
use ControllerReadersController;

// Общие маршруты
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);

// Маршруты для авторизованных пользователей
Route::add('GET', '/hello', [Controller\Site::class, 'hello'])->middleware('auth');
Route::add('GET', '/readers', [Controller\Site::class, 'readers'])->middleware('auth');
Route::add('GET', '/books', [Controller\Site::class, 'books'])->middleware('auth');

// Маршруты для библиотекаря
Route::add(['GET', 'POST'], '/add-book', [Controller\LibrarianController::class, 'addBook'])
    ->middleware('auth:librarian');
Route::add('GET', '/delete-book/{id}', [Controller\LibrarianController::class, 'deleteBook'])
    ->middleware('auth:librarian');
Route::add(['GET', 'POST'], '/add-reader', [Controller\LibrarianController::class, 'addReader'])
    ->middleware('auth:librarian');
Route::add(['GET', 'POST'], '/issue-book', [Controller\LibrarianController::class, 'issueBook'])
    ->middleware('auth:librarian');

