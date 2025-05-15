<h3><?= $message ?? ''; ?></h3>
<div class="container">
    <?php if (app()->auth->user()->isLibrarian()): ?>
        <div class="actions">
            <a href="<?= app()->route->getUrl('/add-book') ?>" class="button">Добавить книгу</a>
            <a href="<?= app()->route->getUrl('/issue-book') ?>" class="button">Выдать книгу</a>
        </div>
    <?php endif; ?>

    <table>
        <caption>Список книг</caption>
        <thead>
        <tr>
            <th>Автор</th>
            <th>Название</th>
            <th>Год публикации</th>
            <th>Цена</th>
            <th>Новое издание</th>
            <th>Аннотация</th>
            <?php if (app()->auth->user()->isLibrarian()): ?>
                <th>Действия</th>
            <?php endif; ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($books as $book): ?>
            <tr>
                <td><?= htmlspecialchars($book->author()->first()->last_name ?? 'Неизвестен'); ?></td>
                <td><?= htmlspecialchars($book->title); ?></td>
                <td><?= htmlspecialchars($book->year_publication); ?></td>
                <td><?= htmlspecialchars($book->price); ?></td>
                <td><?= htmlspecialchars($book->new_edition); ?></td>
                <td><?= htmlspecialchars($book->annotation); ?></td>
                <?php if (app()->auth->user()->isLibrarian()): ?>
                    <td>
                        <a href="<?= app()->route->getUrl('/delete-book/'.$book->id) ?>"
                           onclick="return confirm('Вы уверены?')">Удалить</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

