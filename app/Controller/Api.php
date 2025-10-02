<?php

namespace Controller;

use Model\Books;
use Model\LibrarianRoles;
use Model\Librarians;
use Model\Readers;
use Src\Auth\Auth;
use Src\Request;
use Src\Validator\Validator;
use Src\View;

class Api
{
    public function index(): void
    {
        $message = "Добро пожаловать!";

        (new View())->toJSON(['message' => $message]);
    }

    public function login(Request $request): void
    {
        $request = json_decode(file_get_contents("php://input"), true) ?? [];
        if (Auth::attempt($request)) {
            $message = "Вы успешно вошли!";
            (new View())->toJSON(['message' => $message]);
        }
        $error = "Неверный логин или пароль!";
        (new View())->toJSON(['message' => $error]);
    }

    public function signup(Request $request): void
    {
        $errors = [];
        $query = LibrarianRoles::query();
        $roleLibrarian = $query->where('role_name', 'Библиотекарь')->first();
        $request = json_decode(file_get_contents("php://input"), true) ?? [];
        $request['role_id'] = $roleLibrarian->id;
        $validator = new Validator($request, [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'login' => ['required', 'unique:librarians,login'],
            'password' => ['required', 'password'],
            'role_id' => ['required']
        ], [
            'required' => 'Поле :field пусто',
            'unique' => 'Поле :field должно быть уникально',
            'password' => 'Пароль должен быть длиной не менее 8 символов и содержать как минимум одну цифру, одну заглавную и одну строчную букву'
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            (new View())->toJSON(['errors' => $errors]);
        }

        if (Librarians::create($request)) {
            $message = "Вы успешно зарегистрировались!";
            (new View())->toJSON(['message' => $message]);
        }
    }

    public function reader_create(Request $request): void
    {
        $errors = [];
        $request = json_decode(file_get_contents("php://input"), true) ?? [];
        $request['full_name'] = $request['last_name'] . ' ' . $request['first_name'] . ' ' . $request['patronym'];
        $validator = new Validator($request, [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'full_name' => ['fullname:readers,full_name'],
            'address' => ['required'],
            'telephone' => ['required', 'telephone'],
        ], [
            'required' => 'Поле :field пусто',
            'fullname' => 'Читатель с таким ФИО уже существует',
            'telephone' => 'Некорректный номер телефона'
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            (new View())->toJSON(['errors' => $errors]);
        }

        if (Readers::create($request)) {
            $message = "Читатель успешно создан!";
            (new View())->toJSON(['message' => $message]);
        } else {
            $error = "Не удалось создать читателя";
            (new View())->toJSON(['error' => $error]);
        }
    }
}