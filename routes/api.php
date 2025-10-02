<?php

use Src\Route;

Route::add('GET', '/', [Controller\Api::class, 'index']);
Route::add('POST', '/login', [Controller\Api::class, 'login']);
Route::add('POST', '/signup', [Controller\Api::class, 'signup']);
Route::add('POST', '/readers/create', [Controller\Api::class, 'reader_create'])->middleware('auth');