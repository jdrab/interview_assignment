<?php $this->layout('template', ['title' => 'Sample Article']) ?>

<h1 class="mt-5 mb-2">Why Babylon 5 Is The Greatest Sci-Fi Show Ever Made</h1>
<p>You know that conversation you have with fellow nerds about which is the best sci-fi show, where everyone argues about whether Firefly is better than Battlestar Galactica while someone else insists that Doctor Who is clearly the best? I can't help vehemently disagreeing with all of the above because if you ask me, the finest sci-fi show of all time is unquestionably Babylon 5 (1993 – 1998). Stick with me and I'll try to persuade you of why.</p>
<small><a href="https://www.phantompenpress.com/blog/2017/10/9/why-babylon-5-is-the-greatest-sci-fi-show-ever-made" target="_blank">Read more</a></small>
<hr />

<form enctype="multipart/form-data" action="/create-comment" method="post">

    <div class="form-floating mb-3">
        <input type="text" name="commentAuthor" class="form-control" id="floatingAuthor" placeholder="Vase meno">
        <label for="floatingAuthor">Vase meno</label>
    </div>

    <div class="form-floating mb-3">
        <textarea name="commentBody" id="commentText" class="form-control" placeholder="Vas komentar" style="height: 100px"></textarea>
        <label for="commentText">Vas komentar</label>
    </div>
    <div class="d-flex justify-content-end">
        <button class="btn btn-primary btn-sm justify-content-end" type="submit"><i class="bi bi-plus-lg"></i> Pridať nový komenár</button>
    </div>
</form>
<hr />
<?php
foreach ($comments as $comment) { ?>
    <?= $comment['created_at'] ?>
    |
    <?= $comment['author'] ?>
    <br />
    <?= $comment['body']; ?>

    <div class="d-flex flex-row-reverse bd-highlight">
        <div class=" btn-group" role="group">
            <a class="btn btn-outline-primary btn-sm" href="/add-comment/<?= $comment['id']; ?>"><i class="bi bi-reply"></i> Reagovať</a>
            <?php // if logged in
            ?>
            <a href=" /comment/<?= $comment['id'] ?>" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-pencil" style="color: #fd7e14"></i> Upraviť</a>
            <a href="/comment/<?= $comment['id'] ?>" class="btn btn-outline-secondary btn-sm">
                <i class="bi  bi-trash" style="color: #dc3545"></i> Zmazať</a>
            <?php // if logged in
            ?>
        </div>
    </div>

<?php } ?>
