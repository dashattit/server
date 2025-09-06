<?php

namespace Controller;

use Model\Authors;
use Model\BookDeliveries;
use Model\Books;
use Model\LibrarianRoles;
use Model\Librarians;
use Model\Readers;
use Src\View;
use Src\Request;
use Src\Auth\Auth;

class Site
{
    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }

    public function readers(): string {
        // получаем всех читателей из базы данных
        $readers = Readers::all();
        return (new View())->render('site.readers', ['readers' => $readers]);
    }

    public function books(): string {
        // получаем все книги из базы данных
        $books = Books::all();
        return (new View())->render('site.books', ['books' => $books]);
    }

    public function hello(): string
    {
        return new View('site.hello', ['message' => 'hello working']);
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST' && User::create($request->all())) {
            app()->route->redirect('/go');
        }
        return new View('site.signup');
    }
    public function login(Request $request): string
    {
        // Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        // Если удалось аутентифицировать пользователя, то редирект на страницу читателей
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/readers');
        }
        // Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }
    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }

    public function addBook(Request $request): string
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

    public function deleteBook(Request $request): void
    {
        if (Books::where('id', $request->id)->delete()) {
            app()->route->redirect('/books');
        }
    }

    public function addReader(Request $request): string
    {
        if ($request->method === 'POST' && Readers::create($request->all())) {
            app()->route->redirect('/readers');
        }
        return (new View())->render('site.add_reader');
    }

    public function issueBook(Request $request): string
    {
        if ($request->method === 'POST') {
            $data = $request->all();
            $data['library'] = Auth::user()->id;
            $data['id_book'] = (int)$data['id_book'];
            $data['ticket_number'] = (int)$data['ticket_number'];
            $data['user_id'] = Auth::user()->id;

            if (BookDeliveries::create($data)) {
                app()->route->redirect('/books');
            }
        }

        $books = Books::all();
        $readers = Readers::all();

        return (new View())->render('site.issue_book', [
            'books' => $books,
            'readers' => $readers
        ]);
    }
}