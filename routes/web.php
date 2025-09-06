<?php

use Src\Route;

// Общие маршруты
Route::add('GET', '/', [Controller\SiteController::class, 'index']);
Route::add(['GET', 'POST'], '/signup', [Controller\AuthController::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\AuthController::class, 'login']);
Route::add('GET', '/logout', [Controller\AuthController::class, 'logout']);

// Маршруты для авторизованных пользователей
Route::add('GET', '/readers', [Controller\ReadersController::class, 'readers'])->middleware('auth');
Route::add('GET', '/books', [Controller\BooksController::class, 'books'])->middleware('auth');

// Маршруты для администраторов
Route::add('GET', '/librarians', [Controller\LibrariansController::class, 'index'])->middleware('auth');
Route::add(['GET', 'POST'], '/librarians/create', [Controller\LibrariansController::class, 'create'])->middleware('auth', 'isAdmin');