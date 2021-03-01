<div class="d-flex flex-column align-items-center text-center px-3">
    <img class="rounded-circle mt-5" width="150px" src="https://www.gravatar.com/avatar/<?= md5($_SESSION['M']['user']['email']) ?>?s=160">
    <span class="font-weight-bold"><?= $_SESSION['M']['user']['f_name'] ?> <?= $_SESSION['M']['user']['l_name'] ?></span>
    <span class="text-black-50"><?= $_SESSION['M']['user']['email'] ?></span>
    <span> <?= $this->data['account_type'] ?> </span>
</div>
<hr>
<section class="links">
    <nav class="profile-menu">
        <a class="btn btn-link" href="dashboard"> My Profile </a>
        <a class="btn btn-link" href="my-requests"> My Requests </a>
        <a class="btn btn-link" href="my-transactions"> My Transactions </a>
        <a class="btn btn-link" href="my-invoices"> My Invoices </a>
        <a class="btn btn-link" href="email-history"> System Emails </a>
        <a class="btn btn-link" href="privacy"> Privacy & Security </a>
        <a class="btn btn-link" href="reset-password"> Change Account Password </a>
    </nav>
</section>