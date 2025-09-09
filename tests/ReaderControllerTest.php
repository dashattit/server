<?php

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Model\Readers;

class ReaderControllerTest extends TestCase
{
    #[DataProvider('additionProvider')]
    public function testCreate(string $httpMethod, array $readerData, string $message): void
    {
        // Создаем заглушку для Request
        $request = $this->createMock(\Src\Request::class);
        $request->expects($this->any())
            ->method('all')
            ->willReturn($readerData);
        $request->method = $httpMethod;

        // Сохраняем результат работы метода
        $result = (new \Controller\ReadersController())->create($request);

        if (!empty($result)) {
            // Проверяем ошибки валидации
            $this->expectOutputRegex("/" . preg_quote($message, "/") . "/u");
            return;
        }

        // Проверяем добавился ли читатель в базу
        $this->assertTrue((bool)Readers::where('telephone', $readerData['telephone'])->count());

        // Удаляем тестового читателя
        Readers::where('telephone', $readerData['telephone'])->delete();

        // Проверяем редирект при успешном создании
        $this->assertContains($message, xdebug_get_headers());
    }

    protected function setUp(): void
    {
        $_SERVER['DOCUMENT_ROOT'] = '../server';

        $GLOBALS['app'] = new Src\Application(new Src\Settings([
            'app' => include $_SERVER['DOCUMENT_ROOT'] . '/config/app.php',
            'db' => include $_SERVER['DOCUMENT_ROOT'] . '/config/db.php',
            'path' => include $_SERVER['DOCUMENT_ROOT'] . '/config/path.php',
        ]));

        if (!function_exists('app')) {
            function app()
            {
                return $GLOBALS['app'];
            }
        }
    }

    // Набор тестовых данных
    public static function additionProvider(): array
    {
        return [
            // GET-запрос, форма отображается без ошибок
            ['GET', [
                'first_name' => '', 'last_name' => '', 'patronym' => '',
                'address' => '', 'telephone' => ''
            ], 'Создание читателя'],

            // POST с корректными данными
            ['POST', [
                'first_name' => 'Алексей', 'last_name' => 'Иванов', 'patronym' => 'Сергеевич',
                'address' => 'г. Томск, ул. Иркутский тракт, 102', 'telephone' => '89134450835'
            ], 'Поле first_name пусто'],

            // POST c заполнение только обязательных полей
            ['POST', [
                'first_name' => 'Алексей', 'last_name' => 'Иванов', 'patronym' => '',
                'address' => 'г. Томск, ул. Иркутский тракт, 102', 'telephone' => '89134450835'
            ], 'Создание читателя'],

            // POST без данных
            ['POST', [
                'first_name' => '', 'last_name' => '', 'patronym' => '',
                'address' => '', 'telephone' => ''
            ], 'Поле first_name пусто'],

            // POST с существующими данными
            ['POST', [
                'first_name' => 'Алексей', 'last_name' => 'Иванов', 'patronym' => 'Сергеевич',
                'address' => 'г. Томск, ул. Иркутский тракт, 102', 'telephone' => '89134450835' // уникальный телефон
            ], 'Location: /server/readers'],
        ];
    }
}