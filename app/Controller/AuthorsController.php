<?php

namespace Controller;

use Model\Authors;
use Src\View;
use Src\Request;

class AuthorsController
{
    public function index(): string
    {
        $authors = Authors::all();
        return (new View())->render('site.authors', ['authors' => $authors]);
    }

    public function create(Request $request): string
    {
        if ($request->method === 'POST' && Authors::create($request->all())) {
            app()->route->redirect('/authors');
        }
        return (new View())->render('site.add_author');
    }

    public function delete(Request $request): void
    {
        if (Authors::where('id', $request->id)->delete()) {
            app()->route->redirect('/authors');
        }
    }
}