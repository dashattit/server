<br>
<h3><?= $message ?? ''; ?></h3>

<h3><?= app()->auth->user()->name ?? ''; ?></h3>
<div class="login-container">
    <h2>Вход</h2>
    <?php if (!app()->auth::check()): ?>
        <form id="loginForm" method="post">
            <div class="input-group">
                <input type="text" id="username" name="login" placeholder="введите логин..." required>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="введите пароль..." required>
            </div>
            <div class="divider"></div>
            <button type="submit">Войти</button>
        </form>
    <?php else: ?>
        <p>Добро пожаловать, <?= app()->auth->user()->name; ?>!</p>
    <?php endif; ?>
</div>


