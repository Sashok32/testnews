<!--  main page-->

<div class="col-md-8">

    <h2>Последние новости:</h2>
    <!--            Carousel News-->
    <div id="carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php $last = $db ->query("SELECT * FROM articles ORDER BY date DESC LIMIT 4");
            $active = 'active';
            foreach ($last as $value2) {?>

                <div class="carousel-item <?=$active;?>">
                    <a href="article.php?article=<?=$value2['id'];?>"><img class="d-block w-100" src="img/<?php echo $value2['image'];$active++;?>" alt="Slide"></a>
                    <p><?=$value2['header'];?></p>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <div class="mainArticles">

        <?php
        $categories = $db ->query('SELECT * FROM categories WHERE 1');
        foreach ($categories as $value) {?>
            <div class="artCat">
                <h3><a href="category.php?category=<?=$value['id'];?>"><?=$value['category'];?></a></h3>
                        <?php
                        $articles = $db ->query("SELECT * FROM articles WHERE id_category={$value['id']} ORDER BY date DESC LIMIT 5");
                        foreach ($articles as $val) {
                            echo "<p><a href='article.php?article={$val['id']}'>&mdash; {$val['header']}</a></p>";
                        }
                        ?>

            </div>

        <?php } ?>
    </div>

</div>