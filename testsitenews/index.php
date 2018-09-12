<?php
    require_once "blocks/head.php";
?>



    <div class="row main">
        <div class="col-md-2">
            <?php
                require_once "blocks/block1.php";
            ?>
        </div>

        <?php
            require_once "main.php";
        ?>
        <hr/>

        <div class="col-md-2">
            <?php
                require_once "blocks/block2.php";
            ?>
        </div>
    </div>

<?php
    require_once "blocks/footer.php";
?>