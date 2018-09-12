<?php
require_once "blocks/head.php";
?>
    <div class="row">
        <div class="col-md-2">
            <?php
            require_once "blocks/block1.php";
            ?>
        </div>
        <div class="col-md-8 article">
            <?php
                $art = $db ->query("SELECT * FROM articles WHERE id ='{$_GET['article']}'");
                foreach ($art as $value1) {
                    $artCatQuery = $db ->query("SELECT * FROM categories WHERE id ='{$value1['id_category']}'");
                    echo "<h2>{$value1['header']}</h2>
                        <i>Категория:&emsp;</i><a href='category.php?category={$artCatQuery[0]['id']}' class='badge badge-success'>{$artCatQuery[0]['category']}</a>
                        <hr><img src='img/{$value1['image']}' width='500' align='left' hspace='20'><p>{$value1['article']}</p><span class='articleDate'>{$value1['date']}</span><hr>";

                    echo "<i>Ключевые слова:&emsp;</i>";
                    $keywords = $value1['keywords'];
                    $keywords = explode(',', $keywords);
                    foreach ($keywords as $key_word) {
                        $key_word = trim($key_word);
                        echo "<a href='search.php?search={$key_word}'><span class='badge badge-primary'>#{$key_word}</span></a> ";
                    }
                    echo "<hr />";
                }
            ?>
            <div class="comments">
                <?php
                    $comments = $db ->query("SELECT * FROM comments WHERE id_article = '{$art[0]['id']}'"); // Выборка с параметром id таблицы article
                    if (!empty($comments)) {
                        echo "<h3><u><i>КОММЕНТАРИИ:</i></u></h3>";
                        foreach ($comments as $comment) {
                            $commentName = $db ->query("SELECT * FROM users WHERE id = '{$comment['id_user']}'");
                            echo "<i class='badge'>{$commentName[0]['name']}</i><br>";
                            echo  "<div class='comment'>
                                <p><span>&ldquo;</span>{$comment['comment']}<span>&rdquo;</span></p>
                                <i class='date'>{$comment['date']}</i></div><br>";
                        }

                        echo "<hr />";
                    } else {
                        echo "<i class='badge' style='background-color: #ffc916'>К этой статье ещё нет комментариев. Вы можете стать первым</i><hr />";
                    }
                    if (!empty($_SESSION) && ($_SESSION['roleSes'] == 'admin' || $_SESSION['roleSes'] == 'user'))  {
                        require_once 'blocks/formComment.php';
                    } else {
                        echo "<h3><i>Вы неавторизованный пользователь</i></h3>
                  <p>Авторизуйтесь: <a href='auth.php' class='btn btn-outline-primary'>Вход ></a></p>
                  <p>Зарегестрируйтесь: <a href='reg.php' class='btn btn-outline-primary'>Регистрация ></a></p>";
                    }
                ?>

            </div>
        </div>
        <div class="col-md-2">
            <?php
            require_once "blocks/block2.php";
            ?>
        </div>
    </div>

<?php
//incoming information from comment form
if (!empty($_POST['addComment']) && isset($_POST['addComment'])) {
    $addComment = $db ->escape($_POST['addComment']);
    $db ->query("INSERT INTO comments (comment, id_user, id_article) VALUES ('{$addComment}', '{$_SESSION['idUserSes']}', '{$art[0]['id']}')");
    header('Location: index.php');
}
require_once "blocks/footer.php";
?>