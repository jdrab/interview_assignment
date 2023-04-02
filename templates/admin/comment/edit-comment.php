<?php
$this->layout('template', ['title' => 'Edit Comment']);
?>
<form enctype="multipart/form-data" action="/admin/update-comment/<?= $id ?>" method="post">
    <div class="border btn-light p-3 mt-5 mb-5">
        <h3 class="mb-2">Úprava komentára</h3>
        <input type="hidden" name="<?= $nameKey ?>" value="<?= $name ?>">
        <input type="hidden" name="<?= $valueKey ?>" value="<?= $value ?>">

        <input type="hidden" name="id" value="<?= $id ?>" />
        <input type="hidden" name="article_id" value="1" />
        <input type="hidden" name="thread_id" value="<?= $thread_id ?>" />
        <input type="hidden" name="ref_to_comment_id" value="<?= $ref_to_comment_id ?>" />
        <div class="form-floating mb-3">
            <input type="text" name="author" class="form-control" id="commentAuthor" value="<?= $author ?>" placeholder="Vase meno">
            <label for="commentAuthor">Autor</label>
        </div>

        <div class="form-floating mb-3">
            <textarea maxlength="1024" name="body" id="commentBody" class="form-control" placeholder="Vas komentar" style="height: 100px"><?= $body ?></textarea>
            <label for="commentBody">Komentár</label>
        </div>
        <div class="d-flex justify-content-between">
            <a href="/" class="btn btn-secondary justify-content-start "><i class="bi bi-arrow-left"></i> Späť</a>
            <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Upraviť komentár</button>
        </div>

    </div>

    <input type="hidden" name="article_id" value="<?= $article_id ?>" />

</form>