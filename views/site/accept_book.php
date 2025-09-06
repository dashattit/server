<br>
<div class="login-container">
    <h2>Принятие книги</h2>
    <form id="loginForm" method="post">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <div class="input-group">
            <label for="book_id">Книга:</label>
            <select id="book_id" name="book_id">
                <?php
                foreach ($books as $book) {
                    echo '<option value="' . $book->id . '">' . $book->title . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="input-group">
            <label for="ticket_number">Читатель:</label>
            <select id="ticket_number" name="ticket_number">
                <?php
                foreach ($readers as $reader) {
                    echo '<option value="' . $reader->id . '">' . $reader->last_name . ' ' . $reader->first_name . ' ' . $reader->patronym ?: ' ' . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="divider"></div>
        <button type="submit">Принять</button>
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