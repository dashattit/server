<h3><?= $message ?? ''; ?></h3>
<div class="container">
    <table>
        <caption>Список читателей</caption>
        <thead>
        <tr>
            <th>Номер билета</th>
            <th>Фамилия</th>
            <th>Имя</th>
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
                <td><?= htmlspecialchars($reader->patronym); ?></td>
                <td><?= htmlspecialchars($reader->address); ?></td>
                <td><?= htmlspecialchars($reader->telephone); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <button class="reader-button">Добавить читателя</button>
</div>

