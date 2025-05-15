<h3>Добавить новую книгу</h3>
<div class="container">
    <form method="post">
        <div class="form-group">
            <label>Автор:</label>
            <select name="author" required>
                <?php foreach ($authors as $author): ?>
                    <option value="<?= $author->id ?>">
                        <?= htmlspecialchars("$author->last_name $author->first_name $author->patronym") ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Название:</label>
            <input type="text" name="title" required>
        </div>
        <div class="form-group">
            <label>Год публикации:</label>
            <input type="date" name="year_publication" required>
        </div>
        <div class="form-group">
            <label>Цена:</label>
            <input type="number" name="price" required>
        </div>
        <div class="form-group">
            <label>Новое издание:</label>
            <select name="new_edition">
                <option value="Да">Да</option>
                <option value="Нет">Нет</option>
            </select>
        </div>
        <div class="form-group">
            <label>Аннотация:</label>
            <textarea name="annotation"></textarea>
        </div>
        <button type="submit">Добавить книгу</button>
    </form>
</div>