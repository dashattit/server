<div class="body-container">
    <div class="table-container">
        <table>
            <caption>Список книг</caption>
            <thead>
            <tr>
                <th>ID</th>
                <th>Автор</th>
                <th>Заголовок</th>
                <th>Год публикации</th>
                <th>Цена (р.)</th>
                <th>Новое издание</th>
                <th>Аннотация</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= $book->id; ?></td>
                    <td>
                    <?=
                    $book->author->last_name . ' ' .
                    ($book->author->first_name) . ' ' .
                    ($book->author->patronym ?: '');
                    ?>
                    </td>
                    <td><?= $book->title; ?></td>
                    <td><?= $book->year_publication; ?></td>
                    <td><?= $book->price; ?></td>
                    <td><?= $book->new_edition ? 'Да' : 'Нет'; ?></td>
                    <td><?= $book->annotation ?: 'Нет данных'; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="right-panel">
        <?php if ($user): ?>
            <div class="book-actions">
                <a href="<?= app()->route->getUrl('/books/create') ?>">+ Добавить книгу</a>
                <a href="<?= app()->route->getUrl('/books/issue') ?>">Выдать книгу</a>
                <a href="<?= app()->route->getUrl('/books/accept') ?>">Принять книгу</a>
            </div>
        <?php endif; ?>
        <form action="<?= app()->route->getUrl('/books') ?>" class="search-form">
            <h4>Поиск по читателям</h4>
            <label><input name="search_field" class="search-field" type="text" placeholder="введите ФИО читателей..." value="<?= $request->get('search_field') ?>"></label>
            <button class="search-button">Найти</button>
        </form>
    </div>
</div>