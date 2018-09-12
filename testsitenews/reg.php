<?php
require_once "blocks/head.php";
?>

<div class="row">
    <div class="col-md-2">
        <?php
        require_once "blocks/block1.php";
        ?>
    </div>

    <div class="col-md-8">
    <?php
    if(!empty($_SESSION)) {
        echo "<p class='badge badge-success'>Вы уже авторизованы!</p>";
        //header('Refresh: 5; url=index.php');
    } else {
        if (!empty($_POST) && isset($_POST) && $_POST['passwordReg'] == $_POST['passwordRegConf']) {
            $nameReg = $db ->escape($_POST['nameReg']);
            $userReg = $db ->escape($_POST['userReg']);
            $passwordReg = $_POST['passwordReg'];
            $salt = 'generator';
            $passwordRegSalted = md5($passwordReg.$salt);
            $regRes = $db ->query("SELECT * FROM users WHERE login = '{$userReg}'");
            if (!empty($regRes)){
                echo "<p class='badge badge-warning'>В базе уже есть пользователь с таким логином</p>
                  <p>Авторизуйтесь: <a href='auth.php' class='btn btn-outline-primary'>Вход ></a></p>
                  <p>или повторите регистрацию <a href='reg.php' class='btn btn-outline-primary'>Регистрация ></a></p>";
                //header('Refresh: 5; url=reg.php');
            } else {
                $db ->query("INSERT INTO users (login, password, name) VALUES ('{$userReg}', '{$passwordRegSalted}', '{$nameReg}')");
                echo "<p class='badge badge-success'>Вы зарегестрированы!</p>";
                $regResSes = $db ->query("SELECT * FROM users WHERE login = '{$userReg}' AND password = '{$passwordRegSalted}'");
                $_SESSION['nameSes'] = $regResSes[0]['name'];
                $_SESSION['loginSes'] = $regResSes[0]['login'];
                $_SESSION['roleSes'] = $regResSes[0]['role'];
                $_SESSION['idUserSes'] = $regResSes[0]['id'];
                //header('Refresh: 4; url=index.php');
            }
        } else {
            if(!empty($_POST) && isset($_POST) && $_POST['passwordReg'] != $_POST['passwordRegConf']) {
                echo "<p class='badge badge-warning'>Пароли не совпадают</p>";
            }
            require_once 'blocks/formReg.php';
        }
    }
    ?>
    </div>

    <div class="col-md-2">
        <?php
        require_once "blocks/block2.php";
        ?>
    </div>
</div>

<?php
require_once "blocks/footer.php";
?>
