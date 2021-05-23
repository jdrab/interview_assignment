<?php
$this->layout('template', ['title' => 'Reakcia na komenár']); //!empty($errors) ? $errors : null, 'messages' => $messages ?? '']);
?>


<div class="border btn-light p-3 mt-5 mb-5">
    <form enctype="multipart/form-data" action="/create-comment" method="post">
        <h5 class="pb-3">Reagovať na komentár</h5>

        <input type="hidden" name="article_id" value="<?= $article_id ?>" />
        <input type="hidden" name="thread_id" value="<?= $thread_id ?>" />
        <input type="hidden" name="ref_to_comment_id" value=<?= $id ?>" />
        <div class="border border-5 border-top-0 border-bottom-0 border-end-0 mb-2 p-3">
            <?= $created_at ?> (cid:<?= $id ?>| tid:<?= $thread_id ?>)
            |
            <?= $this->e($author) ?>
            <br />
            <?= $this->e($body); ?>
        </div>


        <div class="form-floating mb-3">
            <input type="text" name="author" class="form-control" id="commentAuthor" placeholder="Vase meno">
            <label for="commentAuthor">Vaše meno</label>
        </div>

        <div class="form-floating mb-3">
            <textarea maxlength="1024" name="body" id="commentBody" class="form-control" placeholder="Vas komentar" style="height: 100px"></textarea>
            <label for="commentBody">Komenár</label>
        </div>


        <div class="d-flex justify-content-between">
            <a href="/" class="btn btn-secondary justify-content-start "><i class="bi bi-arrow-left"></i> Späť</a>
            <button type="submit" class="btn btn-primary"><i class="bi bi-plus"></i> Odoslať</button>
        </div>


    </form>
</div>
