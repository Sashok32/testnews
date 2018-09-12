<form role="form" action="article.php?article=<?=$art[0]['id']?>" method="post"">
    <div class="form-group">
        <label for="addComment">
            прокомментировать статью:
        <textarea class="form-control" id="addComment" name="addComment" minlength="5" rows="2" cols="50" placeholder="Комментарий..." required></textarea>
        </label>
    </div>
    <button type="submit" class="btn btn-outline-primary">
        Комментировать
    </button>
</form>