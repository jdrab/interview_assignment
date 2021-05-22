<?php $this->layout('template', ['title' => 'User Profile']) ?>
<?php
if ($error) { ?>
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
            <use xlink:href="#exclamation-triangle-fill" />
        </svg>
        <div>
            <?= $this->e($error) ?>
        </div>
    </div>

<?php } ?>
<h1>User Profile</h1>
