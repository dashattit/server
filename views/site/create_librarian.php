<br>
<div class="login-container">
    <h2>Создание библиотекаря</h2>
    <form id="loginForm" method="post">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <div class="input-group">
            <input type="text" name="first_name" placeholder="введите имя..." required>
        </div>
        <div class="input-group">
            <input type="text" name="last_name" placeholder="введите фамилию..." required>
        </div>
        <div class="input-group">
            <input type="text" name="patronym" placeholder="введите отчество...">
        </div>
        <div class="input-group">
            <input type="text" name="login" placeholder="введите логин..." required>
        </div>
        <div class="input-group">
            <input type="password" name="password" placeholder="введите пароль..." required>
        </div>
        <div class="input-group">
            <select name="role_id">
                <?php
                foreach ($roles as $role) {
                    echo '<option value="' . $role->id . '">' . $role->role_name . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="divider"></div>
        <button type="submit">Зарегистрироваться</button>
    </form>
</div>