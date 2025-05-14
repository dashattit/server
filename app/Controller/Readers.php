<?php

namespace Controller;

use Src\View;
use Model\Readers;

class Readers{
    public function readers(): string
    {
        // Получаем всех читателей из базы данных
        $readers = Readers::all();

        return new View('site.readers', ['readers' => $readers]);
    }
}
