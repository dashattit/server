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
                <th>Логин</th>
                <th>Роль</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($librarians as $librarian): ?>
                <tr>
                    <td><?= htmlspecialchars($librarian->id); ?></td>
                    <td><?= htmlspecialchars($librarian->first_name); ?></td>
                    <td><?= htmlspecialchars($librarian->last_name); ?></td>
                    <td><?= htmlspecialchars($librarian->patronym ?: "Нет данных"); ?></td>
                    <td><?= htmlspecialchars($librarian->login); ?></td>
                    <td><?= htmlspecialchars($librarian->role->role_name); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a href="<?= app()->route->getUrl('/librarians/create') ?>">+ Добавить библиотекаря</a>
</div>

