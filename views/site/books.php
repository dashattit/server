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
                    <td><?= htmlspecialchars($book->id); ?></td>
                    <td>
                    <?=
                    htmlspecialchars($book->author->last_name) . ' ' .
                    htmlspecialchars($book->author->first_name) . ' ' .
                    htmlspecialchars($book->author->patronym ?: '');
                    ?>
                    </td>
                    <td><?= htmlspecialchars($book->title); ?></td>
                    <td><?= htmlspecialchars($book->year_publication); ?></td>
                    <td><?= htmlspecialchars($book->price); ?>р</td>
                    <td><?= htmlspecialchars(($book->new_edition) ? 'Да' : 'Нет'); ?></td>
                    <td><?= htmlspecialchars($book->annotation ?: 'Нет данных'); ?></td>
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

