<div class="body-container">
    <div class="table-container">
        <table>
            <caption>Список читателей</caption>
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Отчество</th>
                <th>Адрес</th>
                <th>Телефон</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($readers as $reader): ?>
                <tr>
                    <td><?= htmlspecialchars($reader->id); ?></td>
                    <td><?= htmlspecialchars($reader->first_name); ?></td>
                    <td><?= htmlspecialchars($reader->last_name); ?></td>
                    <td><?= htmlspecialchars($reader->patronym ?: "Нет данных"); ?></td>
                    <td><?= htmlspecialchars($reader->address); ?></td>
                    <td><?= htmlspecialchars($reader->telephone); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a href="<?= app()->route->getUrl('/readers/create') ?>">+ Добавить читателя</a>
</div>

