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
        if(!empty($_SESSION)  && $_SESSION['roleSes'] == 'admin') {


            if (isset($_POST) && !empty($_POST['writeCategory']) && !empty($_POST['writeHeader']) && !empty($_POST['writeArticle']) && !empty($_POST['writeKeywords'])) {
                $writeCategory = $db ->escape($_POST['writeCategory']);
                $writeHeader = $db ->escape($_POST['writeHeader']);
                $writeArticle = $db ->escape($_POST['writeArticle']);
                $writeKeywords = $db ->escape($_POST['writeKeywords']);
                $fileInput = $_POST['fileInput'];


                $filePut = 'img';
                //if (!is_dir($filePut)) mkdir($filePut);
                move_uploaded_file ($_FILES['fileInput']['tmp_name'], $filePut.'/'.$_FILES["fileInput"]["name"]);


                $writeRes = $db ->query("SELECT * FROM articles WHERE header = '{$writeHeader}' OR article = '{$writeArticle}'");
                if (!empty($regRes)){
                    echo "<p class='badge badge-warning'>В базе уже есть статья с таким заголовком или содержанием</p>";
                } else {
                    $db ->query("INSERT INTO articles (header, article, keywords, image, id_category) VALUES ('{$writeHeader}', '{$writeArticle}', '{$writeKeywords}', '{$_FILES["fileInput"]["name"]}', '{$writeCategory}')");
                    echo "<p class='badge badge-success'>Статья успешно добавлена!</p>";
                }
            } else {
                require_once 'blocks/formWrite.php';
            }
        } else {
            echo "<p class='badge badge-warning'>У Вас нет прав доступа</p>
                  <p>Авторизуйтесь: <a href='auth.php' class='btn btn-outline-primary'>Вход ></a></p>
                  <p>или зарегистрируйтесь <a href='reg.php' class='btn btn-outline-primary'>Регистрация ></a></p>";
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
