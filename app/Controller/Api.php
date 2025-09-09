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
}