<?php

namespace Controller;

use Model\Books;
use Model\Authors;
use Model\LibrarianRoles;
use Model\Librarians;
use Src\View;
use Src\Request;

class LibrariansController
{
    public function index(Request $request): string
    {
        $user = app()->auth->user();
        $userRole = $user->role->role_name;
        $librarians = Librarians::all();
        return (new View())->render('site.librarians', ['librarians' => $librarians, 'userRole' => $userRole]);
    }

    public function create(Request $request): string
    {
        if ($request->method === 'POST') {
            if (Librarians::create($request->all())) {
                app()->route->redirect('/librarians');
            }
        }

        $roles = LibrarianRoles::all();
        return (new View())->render('site.create_librarian', ['roles' => $roles]);
    }
}