<div class="write">
    <h2>НАПИСАТЬ СТАТЬЮ</h2>
    <form role="form" action="write.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label> Выберите рубрику:
                <select class="form-control" name="writeCategory">
                    <option value="1">Политика</option>
                    <option value="2">Спорт</option>
                    <option value="3">Экономика</option>
                    <option value="4">Технологии</option>
                </select></label>
        </div>
        <div class="form-group">
            <label for="writeHeader"> Заголовок статьи: </label>
                <input id="writeHeader" class="form-control" name="writeHeader" type="text" minlength="5" value="<?=isset($_POST['writeHeader'])?$_POST['writeHeader']:'';?>" required/></label>
        </div>
        <div class="form-group">
            <label for="writeArticle">
                Статья:
            </label>
            <textarea class="form-control" id="writeArticle" name="writeArticle" minlength="20" rows="10" placeholder="Напишите статью..." required><?=isset($_POST['writeArticle'])?$_POST['writeArticle']:'';?></textarea>
        </div>
        <div class="form-group">
            <label for="writeKeywords">
                Ключевые слова (через запятую):
            </label>
            <input class="form-control" id="writeKeywords" name="writeKeywords" type="text" minlength="4" maxlength="30" value="<?=isset($_POST['writeKeywords'])?$_POST['writeKeywords']:'';?>" required/>
        </div>

        <div class="form-group">
            <label for="fileInput">
                Изображение к статье:
            </label>
            <input class="form-control-file" name="fileInput" id="fileInput" type="file" required />
        </div>

        <button type="submit" class="btn btn-primary form-control">
            <b>Написать</b>
        </button>
    </form>

</div>