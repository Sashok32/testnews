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
        if (!empty($_POST) && isset($_POST)) {
            $userAuth = $_POST['userAuth'];
            $passwordAuth = $_POST['passwordAuth'];
            $salt = 'generator';
            $passwordAuthSalted = md5($passwordAuth.$salt);
            $authRes = $db ->query("SELECT * FROM users WHERE login = '{$userAuth}' AND password = '{$passwordAuthSalted}'");
            if (!empty($authRes)){
                echo "<p class='badge badge-success'>Вход выполнен!</p>";

                $_SESSION['nameSes'] = $authRes[0]['name'];
                $_SESSION['loginSes'] = $authRes[0]['login'];
                $_SESSION['roleSes'] = $authRes[0]['role'];
                $_SESSION['idUserSes'] = $authRes[0]['id'];

                //header('Refresh: 4; url=index.php');
            } else {
                echo "<p class='badge badge-warning'>Неверный логин или пароль</p>
                  <p>Повторить авторизацию: <a href='auth.php' class='btn btn-outline-primary'>Вход ></a></p>
                  <p>Нет аккаунта <a href='reg.php' class='btn btn-outline-primary'>Регистрация ></a></p>";
                //header('Refresh: 5; url=auth.php');
            }
        } else {
            if(!empty($_POST) && (empty($_POST['userAuth']) || empty($_POST['passwordAuth']))) {
                echo "<p class='badge badge-warning'>Заполните форму входа</p>";
            }
            require_once 'blocks/formAuth.php';
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
