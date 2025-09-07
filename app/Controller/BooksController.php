<?php

namespace Controller;

use Model\Books;
use Model\Authors;
use Src\Validator\Validator;
use Src\View;
use Src\Request;

class BooksController
{
    public function index(Request $request): string
    {
        $user = app()->auth->user();

        $query = Books::with('author');

        // Получаем поисковое значение
        $search = $request->get('search_field');
        $sortByPopularity = $request->get('search_checkbox');

        if ($search) {
            $query->whereHas('deliveries.reader', function ($q) use ($search) {
                $q->where('last_name', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('patronym', 'like', "%{$search}%");
            });
            $query->whereHas('deliveries', function ($q) {
                $q->whereNull('date_return');
            });
        }
        $query->withCount('deliveries');
        if ($sortByPopularity) {
            $query->orderBy('deliveries_count', 'desc');
        }

        $books = $query->get();

        return (new View())->render('site.books', [
            'books' => $books,
            'user' => $user,
            'request' => $request,
            'search_checkbox' => $sortByPopularity,
        ]);
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