<h2>Добавление книги</h2>
<?php if (app()->auth::check() && app()->auth::user()->role === 'user'): ?>
    <form id="addBookForm" method="POST" action="<?= app()->route->getUrl('/add-book') ?>">
        <div class="input-group">
            <input type="text" name="author" placeholder="введите автора..." required>
        </div>
        <div class="input-group">
            <input type="text" name="title" placeholder="введите название..." required>
        </div>
        <div class="input-group">
            <input type="number" name="year" placeholder="введите год..." required>
        </div>
        <div class="input-group">
            <input type="number" name="price" placeholder="введите цену..." required>
        </div>
        <div class="checkbox-group">
            <label>
                <input type="checkbox" name="newEdition"> Новое издание
            </label>
        </div>
        <div class="input-group">
            <textarea id="annotation" name="annotation" placeholder="Введите аннотацию..." required></textarea>
        </div>
        <button type="submit">Добавить книгу</button>
    </form>
<?php else: ?>
    <p>У вас нет прав для добавления книги.</p>
<?php endif; ?>
