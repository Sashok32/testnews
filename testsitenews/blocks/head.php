<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Новости</title>
    <!-- подключение css-файла -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <!-- подключение нужной версии jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <!-- подключение popper.js, необходимого для корректной работы некоторых плагинов Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <!-- подключение js-файла -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
            integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous">
    </script>
    <!-- свои css-стили -->
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <?php
        session_start();
        require_once "db.class.php";
        $db = new DB('localhost', 'root', '', 'novosti');
    ?>
    <div class="container-fluid">

        <div class="row header">
            <div class="col-md-2 logo">
                <a href="index.php"><img src="img/logo.png" title="На Главную" alt="ua.novosti"></a>
            </div>


            <div class="col-md-4 searchHead">
                    <form class="form-inline" method="get" action="search.php">
                        <p>Поиск по ключевым словам</p>
                        <input list="keywords" class="form-control mr-sm-2" name="search" type="text" />
                        <datalist id="keywords">
                            <?php
                                $keywordsQuery = $db ->query("SELECT * FROM articles WHERE 1");
                                foreach ($keywordsQuery as $keywordQuery) {
                                    $keywords = $keywordQuery['keywords'];
                                    $keywords = explode(',', $keywords);
                                    foreach ($keywords as $key_word) {
                                        $key_word = trim($key_word);
                                        echo "<option value='{$key_word}'></option>";
                                    }
                                }
                            ?>
                        </datalist>
                        <button class="btn btn-primary my-2 my-sm-0" type="submit">
                            <b>&#128269; Поиск</b>
                        </button>
                    </form>
            </div>


            <div class="col-md-4 admin">
                    <?php
                    if(!empty($_SESSION)) {
                        echo "<p>{$_SESSION['nameSes']}</p>";
                    if ($_SESSION['roleSes'] == 'admin') {
                    ?>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown">
                        <b>Меню</b>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item disabled" href="#">Статистика</a> <a class="dropdown-item"
                                                                                     href="write.php">Написать
                            статью</a>
                    </div>
                </div>
                <?php
                }
                    }
                    ?>
            </div>


            <div class="col-md-2 reg">
                <?php
                    if(!empty($_SESSION)) {?>
                        <form action="" method="POST">
		                    <input type="submit" name="logout" value="Выход"class="logout">
		                </form>
                <?php
                        if (isset($_POST['logout'])) {
                            unset($_SESSION['nameSes']);
                            unset($_SESSION['loginSes']);
                            unset($_SESSION['roleSes']);
                            session_destroy();
                            //header('Refresh: 1; url=index.php');
                        }
                    } else {
                        echo "<a href='auth.php'>Авторизация</a>|<a href='reg.php'>Регистрация</a>";
                    }
                ?>
            </div>
        </div>