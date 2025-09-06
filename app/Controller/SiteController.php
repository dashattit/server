<?php

namespace Controller;

use Src\View;
use Src\Request;
use Src\Auth\Auth;

class SiteController
{
    public function index(Request $request): string
    {
        return new View('site.index');
    }

    public function hello(): string
    {
        return new View('site.hello', ['message' => 'hello working']);
    }
}