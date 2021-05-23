<?php
$this->layout('template', ['title' => 'Reakcia na komenár']);
?>

<form enctype="multipart/form-data" action="/create-comment" method="post">
    <input type="hidden" name="<?= $nameKey ?>" value="<?= $name ?>">
    <input type="hidden" name="<?= $valueKey ?>" value="<?= $value ?>">

    <div class="border btn-light p-3 mt-5 mb-5">
        <h3 class="mb-2">Reakcia na komentár</h3>
        <input type="hidden" name="article_id" value="<?= $article_id ?>" />
        <input type="hidden" name="thread_id" value="<?= $thread_id ?>" />
        <input type="hidden" name="ref_to_comment_id" value=<?= $id ?>" />
        <div class="border border-5 border-top-0 border-bottom-0 border-end-0 mb-4 p-3">

            <div class="d-flex justify-content-between">
                <div><strong><?= $this->e($author) ?></strong></div>


                <div class="visually-hidden text-black-50 fw-lighter">(#cid<?= $id ?>,
                    #tid<?= $thread_id ?>,
                    #ref<?= $ref_to_comment_id ?>)
                </div>
                <div><?= $created_at ?></div>
            </div>


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
            <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Odoslať</button>
        </div>

</form>
