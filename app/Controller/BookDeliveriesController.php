<?php

namespace Controller;

use Model\BookDeliveries;
use Model\Books;
use Model\Readers;
use Src\View;
use Src\Request;
use Src\Auth\Auth;

class BookDeliveriesController
{
    public function create(Request $request): string
    {
        if ($request->method === 'POST') {
            $data = $request->all();
            $data['id_library'] = Auth::user()->id;
            $data['id_book'] = (int)$data['id_book'];
            $data['ticket_number'] = (int)$data['ticket_number'];

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

    public function index(): string
    {
        $deliveries = BookDeliveries::with(['book', 'reader', 'librarian'])->get();
        return (new View())->render('site.deliveries', ['deliveries' => $deliveries]);
    }

    public function returnBook(Request $request): void
    {
        $delivery = BookDeliveries::find($request->id);
        if ($delivery) {
            $delivery->update(['data_return' => date('Y-m-d')]);
            app()->route->redirect('/deliveries');
        }
    }
}