<?php $this->layout('template-clean', ['title' => 'Login']) ?>
<main class="mx-auto" style="width:480px;">

    <form class="form-signin" method="post" action="/auth">
        <input type="hidden" name="<?= $nameKey ?>" value="<?= $name ?>">
        <input type="hidden" name="<?= $valueKey ?>" value="<?= $value ?>">

        <h1 class="h3 mb-4 mt-4">Admin section</h1>

        <div class="mt-2 form-floating">
            <input tabindex="1" type="text" class="form-control" name="login" id="floatingInput" placeholder="admin">
            <label for="floatingInput">Login</label>
        </div>
        <div class="mt-2 form-floating">
            <input tabindex="2" name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>
        <div class="d-flex justify-content-between">
            <a tabindex="4" href="/" class="mt-4 col-4 btn btn-secondary justify-content-start "><i class="bi bi-arrow-left"></i> Späť</a>
            <button tabindex="3" class="mt-4 col-7 btn btn-primary" type="submit">Login</button>
        </div>
    </form>
</main>