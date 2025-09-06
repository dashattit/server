<div class="body-container">
    <div class="table-container">
        <table>
            <caption>Список библиотекарей</caption>
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Отчество</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($authors as $author): ?>
                <tr>
                    <td><?= htmlspecialchars($author->id); ?></td>
                    <td><?= htmlspecialchars($author->first_name); ?></td>
                    <td><?= htmlspecialchars($author->last_name); ?></td>
                    <td><?= htmlspecialchars($author->patronym ?: "Нет данных"); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a href="<?= app()->route->getUrl('/authors/create') ?>">+ Добавить автора</a>
</div>

