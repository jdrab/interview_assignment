<?php
$this->layout('template', ['title' => 'Sample Article']); //!empty($errors) ? $errors : null, 'messages' => $messages ?? '']);
?>
<form enctype="multipart/form-data" action="/admin/destroy-comment/<?= $id ?>" method="post" class="row">
    <h1 class="mt-5 mb-2">Zmazanie komentara</h1>
    <p class="alert alert-warning"><strong><i class="bi bi-exclamation-circle-fill"></i> Upozornenie:</strong> zmazane budu aj komentare,ktore priamo reagovali na mazany komentar.</p>
    <div class=" mb-3 row">
        <label for="author" class="col-sm-2 col-form-label">Autor</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="author" value="<?= $this->e($author) ?>asdf adf">
        </div>
        <label for="createdAt" class="col-sm-2 col-form-label">Datum</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="createdAt" value="<?= $createdAt ?>2021-05-23 12:22:49">
        </div>
        <label for="body" class="col-sm-2 col-form-label">Komentar</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="body" value="<?= $this->e($body) ?>asdf adf">
        </div>
    </div>

    <input type="hidden" name="article_id" value="<?= $article_id ?>" />
    <input type="hidden" value="thread_id" value="<?= $thread_id ?>" />

    <div class="d-flex justify-content-between">
        <a href="/" class="btn btn-light justify-content-start "><i class="bi bi-arrow-left"></i> Späť</a>
        <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash"></i> Zmazať komenár</button>
    </div>
</form>
