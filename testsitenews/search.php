<?php
require_once "blocks/head.php";
?>

<br><br><br><br><br><br>
<div class="row">
    <div class="col-md-2">
        <?php
        require_once "blocks/block1.php";
        ?>
    </div>

    <div class="col-md-8 search">
        <?php
        if(!empty($_GET['search'])) {
            $page = (((!empty($_GET['page']) && $_GET['page'] >= 1) ? round($_GET['page']) : 1) - 1)*5;
            $countNews = $db ->query("SELECT count(*) as count FROM articles WHERE keywords LIKE '%{$_GET['search']}%'");
            $limit = ceil($countNews[0]['count']/5);

            $searchQuery = $db ->query("SELECT * FROM articles WHERE keywords LIKE '%{$_GET['search']}%' ORDER BY date DESC LIMIT {$page}, 5");
            if (!empty($searchQuery)) {
                echo "<h2><span class='badge badge-primary'>Результаты поиска:</span></h2><br>";

                foreach ($searchQuery as $searchResponse) {
                    echo "<a href='article.php?article={$searchResponse['id']}'>&mdash; {$searchResponse['header']}</a><hr>";
                }

                $pageMinus = (!empty($_GET['page']) && $_GET['page'] > 1) ? ($_GET['page'] - 1) : 1;
                echo "<div class='pages'><a href='?page=".$pageMinus."&&search={$_GET['search']}' class='page badge badge-primary'><b>&lt;</b></a>";
                echo "		&emsp;		&emsp;		&emsp;<div class='wrapper'> ...		&emsp;		&emsp;		&emsp;<div class='pagesHover'>";
                for ($i = 1; $i <= $limit; $i++) {
                    echo "<a href='?page={$i}&&search={$_GET['search']}' class='page badge badge-primary'>{$i}</a>";
                }
                echo "</div></div>";
                $pagePlus = (!empty($_GET['page']) && $_GET['page'] < $limit) ? ($_GET['page'] + 1) : $limit;
                echo "<a href='?page=".$pagePlus."&&search={$_GET['search']}' class='page badge badge-primary'>></a></div>";

            } else {
                echo "<h3 class='badge-warning'>Упс! Некорректный запрос :( Повторите поиск</h3>";
            }
          } else {
            echo "<h3 class='badge-warning'>Вы не ввели никаких данных. Повторите поиск</h3>";
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
