<?php
$this->layout('template', ['title' => 'Zmazanie komentára']);
?>

<form enctype="multipart/form-data" action="/admin/destroy-comment/<?= $id ?>" method="post">
    <input type="hidden" name="<?= $nameKey ?>" value="<?= $name ?>">
    <input type="hidden" name="<?= $valueKey ?>" value="<?= $value ?>">

    <div class="border btn-light p-3 mt-5 mb-5">
        <h3 class="mb-2">Zmazanie komentára</h3>
        <input type="hidden" name="article_id" value="1" />
        <input type="hidden" value="thread_id" value="<?= $thread_id ?>" />
        <p class="alert alert-warning p-3"><strong><i class="bi bi-exclamation-circle-fill"></i> Upozornenie:</strong> zmazane budu aj komentare,ktore priamo reagovali na mazany komentar.</p>
        <div class="form-floating mb-3">
            <input readonly type="text" name="author" class="form-control" id="commentAuthor" value="<?= $this->e($author) ?> " placeholder="Vase meno">
            <label for="commentAuthor">Autor</label>
        </div>

        <div class="form-floating mb-3">
            <textarea readonly maxlength="1024" name="body" id="commentBody" class="form-control" placeholder="Vas komentar" style="height: 100px"><?= $this->e($body) ?>
                </textarea>
            <label for="commentBody">Komentár</label>
        </div>
        <div class="d-flex justify-content-between">
            <a href="/" class="btn btn-secondary justify-content-start "><i class="bi bi-arrow-left"></i> Späť</a>
            <button tabindex="1" type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Zmazať komenár</button>
        </div>

    </div>

    <input type="hidden" name="article_id" value="<?= $article_id ?>" />

</form>
