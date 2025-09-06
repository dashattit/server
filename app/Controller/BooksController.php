<?php

namespace Controller;

use Model\Books;
use Model\Authors;
use Src\View;
use Src\Request;

class BooksController
{
    public function index(): string
    {
        $books = Books::with('author')->get();
        return (new View())->render('site.books', ['books' => $books]);
    }

    public function create(Request $request): string
    {
        if ($request->method === 'POST') {
            $bookData = $request->all();
            $bookData['author'] = (int)$bookData['author'];

            if (Books::create($bookData)) {
                app()->route->redirect('/books');
            }
        }

        $authors = Authors::all();
        return (new View())->render('site.add_book', ['authors' => $authors]);
    }

    public function delete(Request $request): void
    {
        if (Books::where('id', $request->id)->delete()) {
            app()->route->redirect('/books');
        }
    }
}