<br>
<div class="login-container">
    <h2>Выдача книги</h2>
    <form id="loginForm" method="post">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <div class="input-group">
            <label for="book_id">Книга:</label>
            <?php if (empty($freeBooks)): ?>
                <p>Свободных книг нет</p>
            <?php else: ?>
                <select id="book_id" name="book_id">
                    <?php
                    foreach ($books as $book) {
                        echo '<option value="' . $book->id . '">' . $book->title . '</option>';
                    }
                    ?>
                </select>
            <?php endif; ?>
        </div>
        <div class="input-group">
            <label for="ticket_number">Читатель:</label>
            <?php if (empty($readers)): ?>
                <p>Читателей нет</p>
            <?php else: ?>
                <select id="ticket_number" name="ticket_number">
                    <?php
                    foreach ($readers as $reader) {
                        echo '<option value="' . $reader->id . '">' . $reader->last_name . ' ' . $reader->first_name . ' ' . $reader->patronym ?: ' ' . '</option>';
                    }
                    ?>
                </select>
            <?php endif; ?>
        </div>
        <div class="divider"></div>
        <button type="submit">Выдать</button>
    </form>
    <?php if (!empty($errors)): ?>
        <div class="errors">
            <ul>
                <?php foreach ($errors as $field => $fieldErrors): ?>
                    <?php foreach ($fieldErrors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>