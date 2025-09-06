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
                <th>Цена</th>
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
                    <td><?= $book->price; ?>р</td>
                    <td><?= $book->new_edition ? 'Да' : 'Нет'; ?></td>
                    <td><?= $book->annotation ?: 'Нет данных'; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="book-actions">
        <a href="<?= app()->route->getUrl('/books/create') ?>">+ Добавить книгу</a>
        <a href="<?= app()->route->getUrl('/issue_book') ?>">Выдать книгу</a>
        <a href="<?= app()->route->getUrl('/accept_book') ?>">Принять книгу</a>
    </div>
</div>

