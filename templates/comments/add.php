<?php $this->layout('template', ['title' => 'Add comment']) ?>

<main class="mx-auto" style="width:480px;">

    <form class="form-signin">

        <h1 class="h3 mb-4 mt-4">Admin section</h1>

        <div class="mt-2 form-floating">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="mt-2 form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>

        <button class="mt-4 w-100 btn btn-lg btn-primary" type="submit">Login</button>
    </form>
</main>
