<h3>Выдать книгу</h3>
<div class="container">
    <form method="post">
        <div class="form-group">
            <label>Книга:</label>
            <select name="id_book" required>
                <?php foreach ($books as $book): ?>
                    <option value="<?= $book->id ?>">
                        <?= htmlspecialchars($book->title) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Читатель:</label>
            <select name="ticket_number" required>
                <?php foreach ($readers as $reader): ?>
                    <option value="<?= $reader->id ?>">
                        <?= htmlspecialchars("$reader->last_name $reader->first_name (№$reader->id)") ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Дата выдачи:</label>
            <input type="date" name="data_extraction" required>
        </div>
        <div class="form-group">
            <label>Дата возврата:</label>
            <input type="date" name="data_return" required>
        </div>
        <button type="submit">Выдать книгу</button>
    </form>
</div>