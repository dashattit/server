<br>
<div class="login-container">
    <h2>Создание читателя</h2>
    <form id="loginForm" method="post">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <div class="input-group">
            <input type="text" name="first_name" placeholder="введите имя..." >
        </div>
        <div class="input-group">
            <input type="text" name="last_name" placeholder="введите фамилию..." >
        </div>
        <div class="input-group">
            <input type="text" name="patronym" placeholder="введите отчество...">
        </div>
        <div class="input-group">
            <input type="text" name="address" placeholder="введите адрес...">
        </div>
        <div class="input-group">
            <input type="text" name="telephone" placeholder="введите номер телефона...">
        </div>
        <div class="divider"></div>
        <button type="submit">Создать</button>
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