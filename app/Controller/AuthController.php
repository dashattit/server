<?php

namespace Controller;

use Model\LibrarianRoles;
use Model\Librarians;
use Src\View;
use Src\Request;
use Src\Auth\Auth;

class AuthController
{
    public function signup(Request $request): string
    {
        $query = LibrarianRoles::query();
        $roleLibrarian = $query->where('role_name', 'Библиотекарь')->first();
        $request->role_id = $roleLibrarian->id;
        if ($request->method === 'POST' && Librarians::create($request->all())) {
            app()->route->redirect('/go');
        }
        return new View('site.signup');
    }

    public function login(Request $request): string
    {
        if ($request->method === 'GET') {
            return new View('site.login');
        }

        if (Auth::attempt($request->all())) {
            app()->route->redirect('/readers');
        }

        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }
}