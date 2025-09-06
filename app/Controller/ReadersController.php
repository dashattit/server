<?php

namespace Controller;

use Model\Readers;
use Src\View;
use Src\Request;

class ReadersController
{
    public function index(): string
    {
        $readers = Readers::all();
        return (new View())->render('site.readers', ['readers' => $readers]);
    }

    public function create(Request $request): string
    {
        if ($request->method === 'POST' && Readers::create($request->all())) {
            app()->route->redirect('/readers');
        }
        return (new View())->render('site.add_reader');
    }

    public function delete(Request $request): void
    {
        if (Readers::where('id', $request->id)->delete()) {
            app()->route->redirect('/readers');
        }
    }
}