<?php

namespace Controller;

use Model\Readers;
use Src\Validator\Validator;
use Src\View;
use Src\Request;

class ReadersController
{
    public function index(Request $request): string
    {
        $search = $request->get('search_field');
        $user = app()->auth->user();
        $userRole = $user->role->role_name;

        if ($search) {
            $readers = Readers::whereHas('deliveries.book', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            })->get();
        } else {
            $readers = Readers::all();
        }


        return (new View())->render('site.readers', ['readers' => $readers, 'request' => $request, 'userRole' => $userRole]);
    }

    public function create(Request $request): string
    {
        $errors = [];

        if ($request->method === 'POST') {
            $request->set('full_name', implode(' ', [
                $request->get('last_name'),
                $request->get('first_name'),
                $request->get('patronym')
            ]));

            $validator = new Validator($request->all(), [
                'first_name' => ['required'],
                'last_name' => ['required'],
                'full_name' => ['fullname:readers,full_name'],
                'address' => ['required'],
                'telephone' => ['required', 'telephone', 'unique:readers,telephone'],
            ], [
                'required' => 'Поле :field пусто',
                'fullname' => 'Читатель с таким ФИО уже существует',
                'telephone' => 'Некорректный номер телефона',
                'unique' => 'Поле :field должно быть уникально',
            ]);

            if($validator->fails()){
                $errors = $validator->errors();
                return new View('site.create_reader',
                    ['errors' => $errors, 'old' => $request->all()]);
            }

            if (Readers::create($request->all())) {
                app()->route->redirect('/readers');
            }
        }
        return (new View())->render('site.create_reader');
    }

    public function delete(Request $request): void
    {
        if (Readers::where('id', $request->id)->delete()) {
            app()->route->redirect('/readers');
        }
    }
}