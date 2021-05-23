<?php
$this->layout('template', ['title' => 'Sample Article']); //!empty($errors) ? $errors : null, 'messages' => $messages ?? '']);
?>
<!-- article !-->
<h1 class="mt-5 mb-2">Why Babylon 5 Is The Greatest Sci-Fi Show Ever Made</h1>
<p>You know that conversation you have with fellow nerds about which is the best sci-fi show, where
    everyone argues about whether Firefly is better than Battlestar Galactica while someone else insists
    that Doctor Who is clearly the best? I can't help vehemently disagreeing with all of the above because
    if you ask me, the finest sci-fi show of all time is unquestionably Babylon 5 (1993 – 1998).
    Stick with me and I'll try to persuade you of why.</p>
<small><a href="https://www.phantompenpress.com/blog/2017/10/9/why-babylon-5-is-the-greatest-sci-fi-show-ever-made" target="_blank">Read more</a></small>
<div class="border btn-light p-3 mt-5 mb-5">
    <h5 class="pb-3">Zapojiť sa do diskusie</h5>
    <form enctype="multipart/form-data" action="/create-comment" method="post">

        <input type="hidden" name="article_id" value="1" />
        <input type="hidden" value="thread_id" value="" />

        <div class="form-floating mb-3">
            <input type="text" name="author" class="form-control" id="commentAuthor" placeholder="Vase meno">
            <label for="commentAuthor">Autor</label>
        </div>

        <div class="form-floating mb-3">
            <textarea maxlength="1024" name="body" id="commentBody" class="form-control" placeholder="Vas komentar" style="height: 100px"></textarea>
            <label for="commentBody">Tvoj komenár</label>
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary justify-content-end" type="submit"><i class="bi bi-plus"></i> Pridať</button>
        </div>
    </form>
</div>

<?php
if (empty($comments)) {
?>
    <div class="d-flex justify-content-center alert alert-light p-4 border bg-light" role="alert">
        <h4><i class="bi bi-emoji-frown"></i> Zaťiaľ žiadne komentáre</h4>
    </div>

<?php
} else {

?>
    <h4 class="pb-3"><i class="bi bi-chat-right-text"></i> Diskusia</h4>
    <?php
    $prevThread = null;
    foreach ($comments as $comment) { ?>
        <div id="cid<?= $comment->id; ?>" class="border border-5 border-top-0 border-bottom-0 border-end-0 mb-2 p-3
        <?= $prevThread === $comment->thread_id ? ' ms-5 ' : '' ?>">
            <div class="d-flex justify-content-between">
                <div><strong><?= $this->e($comment->author) ?></strong></div>
                <div class="visually-hidden text-black-50 fw-lighter">(#cid<?= $comment->id ?>,
                    #tid<?= $comment->thread_id ?>,
                    #ref<?= $comment->ref_to_comment_id ?>)
                </div>
                <div><?= $comment->created_at ?></div>
            </div>

            <?= $this->e($comment->body); ?>

            <div class="d-flex flex-row-reverse bd-highlight">
                <div class=" btn-group" role="group">
                    <a class="btn btn-outline-primary btn-sm" href="/add-comment/<?= $comment->id; ?>"><i class="bi bi-reply"></i> Reagovať</a>
                    <?php // if logged in - begin
                    ?>
                    <a href="/admin/edit-comment/<?= $comment->id ?>" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-pencil" style="color: #fd7e14"></i> Upraviť</a>
                    <a href="/admin/delete-comment/<?= $comment->id ?>" class="btn btn-outline-secondary btn-sm">
                        <i class="bi  bi-trash" style="color: #dc3545"></i> Zmazať</a>
                    <?php // if logged in - end
                    ?>
                </div>
            </div>

        </div>
<?php
        $prevThread = $comment->thread_id;
    }
} ?>
