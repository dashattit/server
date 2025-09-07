<?php

namespace Controller;

use Model\Books;
use Model\Authors;
use Src\Validator\Validator;
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
        $errors = [];
        $authors = Authors::all();
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'author_id' => ['required'],
                'title' => ['required'],
                'year_publication' => ['required'],
                'price' => ['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if($validator->fails()){
                $errors = $validator->errors();
                return new View('site.create_book',
                    ['errors' => $errors, 'authors' => $authors, 'old' => $request->all()]);
            }

            if (Books::create($request->all())) {
                app()->route->redirect('/books');
            }
        }
        return (new View())->render('site.create_book', ['authors' => $authors]);
    }

    public function delete(Request $request): void
    {
        if (Books::where('id', $request->id)->delete()) {
            app()->route->redirect('/books');
        }
    }
}