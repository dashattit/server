<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background: #CDCDCD;
            height: 150px;
            width: 100%;
        }

        header {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
        }

        nav a {
            text-decoration: none;
            color: #000;
            font-size: 32px;
            font-weight: bold;
            margin: 0 30px;
        }

        .login-container {
            background-color: #B1B1B1;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            margin: 0 auto;
        }

        h2 {
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .divider {
            margin: 15px 0;
            border-top: 1px solid #000000;
        }

        .login-container button {
            width: fit-content;
            height: 25px;
            background-color: #FFFFFF;
            border: none;
            border-radius: 3px;
            color: rgb(0, 0, 0);
            font-size: 16px;
        }

        table {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table-container {
            background-color: #CDCDCD;
            width: 80%;
        }

        caption {
            font-weight: bolder;
            font-size: 24px;
            margin-bottom: 32px;
            margin-top: 32px;
        }

        th {
            background-color: #EEEEEE;
        }

        th, td {
            border: 2px solid black;
            text-align: center;
            padding: 10px;
            height: 30px;
        }

        .login-container button {
            width: fit-content;
            padding: 5px;
        }
        .reader-button {
            width: fit-content;
            margin: 20px;
        }

        .body-container {
            padding: 100px;
            font-size: 24px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
        }

        caption {
            font-size: 32px;
        }

        .body-container > a {
            background-color: #CDCDCD;
            text-decoration: none;
            color: black;
            border-radius: 3px;
            font-size: 24px;
            width: fit-content;
            padding: 10px;
            height: 50px;
        }

        .container {
            width: 90%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .errors {
            color: red;
            background-color: white;
            border-radius: 3px;
            margin-top: 20px;
            padding: 5px 0;
        }

        .errors > ul {
            list-style: none;
        }
    </style>
</head>
<body>
<header>
    <div class="container">
        <div class="logo">
            <a href="<?= app()->route->getUrl('/') ?>">
                <img src="img/logo.png" alt="logo">
            </a>
        </div>
        <nav>
            <?php if (!app()->auth::check()): ?>
                <a href="<?= app()->route->getUrl('/login') ?>">Вход</a>
                <a href="<?= app()->route->getUrl('/signup') ?>">Регистрация</a>
            <?php else: ?>
                <a href="<?= app()->route->getUrl('/logout') ?>">Выход <?= app()->auth::user()->name ?></a>
                <a href="<?= app()->route->getUrl('/librarians') ?>">Библиотекари</a>
                <a href="<?= app()->route->getUrl('/readers') ?>">Читатели</a>
                <a href="<?= app()->route->getUrl('/books') ?>">Книги</a>
                <a href="<?= app()->route->getUrl('/authors') ?>">Авторы</a>
                <?php if (app()->auth->user()->isLibrarian()): ?>
                    <a href="<?= app()->route->getUrl('/add-book') ?>">Добавить книгу</a>
                    <a href="<?= app()->route->getUrl('/issue-book') ?>">Выдать книгу</a>
                <?php endif; ?>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main>
    <?= $content ?? '' ?>
</main>
</body>
</html>
