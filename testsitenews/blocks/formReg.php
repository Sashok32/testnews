<div class="registration">
    <h2>РЕГИСТРАЦИЯ</h2>
    <form role="form" action="reg.php" method="post">
        <div class="form-group">
            <label for="nameReg">
                Ваше имя:
            </label>
            <input class="form-control" id="nameReg" name="nameReg" type="text" minlength="3" value="<?=isset($_POST['nameReg'])?$_POST['nameReg']:'';?>" required/>
        </div>
        <div class="form-group">
            <label for="userReg">
                Логин:
            </label>
            <input class="form-control" id="userReg" name="userReg" type="text" minlength="3" value="<?=isset($_POST['userReg'])?$_POST['userReg']:'';?>" required/>
        </div>
        <div class="form-group">
            <label for="passwordReg">
                Пароль:
            </label>
            <input class="form-control" id="passwordReg" name="passwordReg" type="password" minlength="4" required/>
        </div>
        <div class="form-group">
            <label for="passwordRegConf">
                Подтвердите пароль:
            </label>
            <input class="form-control" id="passwordRegConf" name="passwordRegConf" type="password" minlength="4" required/>
        </div>
        <button type="submit" class="btn btn-primary form-control">
            <b>Зарегистрироваться</b>
        </button>
    </form>
    <p>Уже зарегистрированы? <a href="../auth.php" class="btn btn-outline-primary">Вход ></a></p>
</div>