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
    public function index(): string
    {
        $librarians = Librarians::all();
        return (new View())->render('site.librarians', ['librarians' => $librarians]);
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