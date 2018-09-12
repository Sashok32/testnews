<div class="authorization">
    <h2>ВХОД</h2>
    <form role="form" action="auth.php" method="post">
        <div class="form-group">
            <label for="userAuth">
                Логин:
            </label>
            <input class="form-control" id="userAuth" name="userAuth" type="text" minlength="3" value="<?=isset($_POST['userAuth'])?$_POST['userAuth']:'';?>" required/>
        </div>
        <div class="form-group">
            <label for="passwordAuth">
                Пароль:
            </label>
            <input class="form-control" id="passwordAuth" name="passwordAuth" type="password" minlength="4" required/>
        </div>
        <button type="submit" class="btn btn-primary form-control">
            <b>Вход</b>
        </button>
    </form>
    <p>Нет аккаунта? <a href="reg.php" class="btn btn-outline-primary">Регистрация ></a></p>
</div>