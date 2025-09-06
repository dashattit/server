<br>
<div class="login-container">
    <h2>Вход</h2>
    <form id="loginForm" method="post">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <div class="input-group">
            <input type="text" id="username" name="login" placeholder="введите логин..." required>
        </div>
        <div class="input-group">
            <input type="password" id="password" name="password" placeholder="введите пароль..." required>
        </div>
        <div class="divider"></div>
        <button type="submit">Войти</button>
    </form>
</div>