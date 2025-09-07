<?php

namespace Controller;

use Model\Books;
use Model\Authors;
use Model\LibrarianRoles;
use Model\Librarians;
use Src\Validator\Validator;
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
        $roles = LibrarianRoles::all();
        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'first_name' => ['required'],
                'last_name' => ['required'],
                'login' => ['required', 'unique:librarians,login'],
                'password' => ['required'],
                'role_id' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if($validator->fails()){
                return new View('site.create_librarian',
                    ['errors' => $validator->errors(), 'roles' => $roles]);
            }

            $requestData = $request->all();

            if ($request->avatar) {
                $user = new Librarians();
                $avatarPath = $user->uploadAvatar($request->file('avatar'));

                if ($avatarPath) {
                    $requestData['avatar'] = $avatarPath;
                }
            }

            if (Librarians::create($requestData)) {
                app()->route->redirect('/librarians');
            }
        }
        return (new View())->render('site.create_librarian', ['roles' => $roles]);
    }
}