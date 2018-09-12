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
        <div class="category">
            <?php
            $categoriesQuery = $db ->query("SELECT * FROM categories WHERE id = '{$_GET['category']}'");
            foreach ($categoriesQuery as $category) {?>
                <div>
                    <h3><?=$category['category'];?></h3>
                    <?php
                    $page = (((!empty($_GET['page']) && $_GET['page'] >= 1) ? round($_GET['page']) : 1) - 1)*5;
                    $countNews = $db ->query("SELECT count(*) as count FROM articles WHERE id_category = '{$_GET['category']}'");
                    $limit = ceil($countNews[0]['count']/5);
                    $articlesCat = $db ->query("SELECT * FROM articles WHERE id_category={$_GET['category']} ORDER BY date DESC LIMIT {$page}, 5");
                    foreach ($articlesCat as $artCategory) {
                        echo "<p><a href='article.php?article={$artCategory['id']}'>&mdash; {$artCategory['header']}</a></p>";
                    }
                    $pageMinus = (!empty($_GET['page']) && $_GET['page'] > 1) ? ($_GET['page'] - 1) : 1;
                    echo "<div class='pages'><a href='?page=".$pageMinus."&&category={$_GET['category']}' class='page badge badge-primary'><b>&lt;</b></a>";
                    echo "		&emsp;		&emsp;		&emsp;<div class='wrapper'> ...		&emsp;		&emsp;		&emsp;<div class='pagesHover'>";
                    for ($i = 1; $i <= $limit; $i++) {
                        echo "<a href='?page={$i}&&category={$_GET['category']}' class='page badge badge-primary'>{$i}</a>";
                    }
                    echo "</div></div>";
                    $pagePlus = (!empty($_GET['page']) && $_GET['page'] < $limit) ? ($_GET['page'] + 1) : $limit;
                    echo "<a href='?page=".$pagePlus."&&category={$_GET['category']}' class='page badge badge-primary'>></a></div>";
                    ?>

                </div>
            <?php } ?>
        </div>
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
