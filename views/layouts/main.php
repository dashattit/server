<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <link rel="stylesheet" href="css/style.css">
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
                <a href="<?= app()->route->getUrl('/logout') ?>">Выход (<?= app()->auth::user()->name ?>)</a>
                <a href="<?= app()->route->getUrl('/readers') ?>">Читатели</a>
                <a href="<?= app()->route->getUrl('/books') ?>">Книги</a>
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
