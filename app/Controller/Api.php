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
}