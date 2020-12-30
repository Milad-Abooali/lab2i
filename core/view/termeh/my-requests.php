<?php

use App\Core\M;

$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'My Requests';
$this->data['PAGE']['keywords'] = 'test';
$this->data['PAGE']['description'] = 'test';
$this->data['PAGE']['robots'] = 1; // Null = Follow
$this->data['PAGE']['image'] = 'test';
$this->data['PAGE']['canonical'] = APP_URL;
$this->data['PAGE']['path'] = $this->page_path;
$this->data['PAGE']['amphtml'] = NULL;
$this->data['PAGE']['feed'] = NULL;

$this->data['PAGE']['head'] = ' ';

include_once $this->PATH."global/head.php";
include_once $this->PATH."global/header.php";
?>

    <main role="main" class="container">
        <?php if (is_user): ?>

            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3 border-right">
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
                                <a class="btn btn-link" href="email-history"> System Emails </a>
                                <a class="btn btn-link" href="privacy"> Privacy & Security </a>
                                <a class="btn btn-link" href="reset-password"> Change Account Password </a>
                            </nav>
                        </section>
                    </div>
                    <div class="col-md-9">



                    </div>
                </div>
            </div>
        <?php endif; ?>

    </main>

    <script>

        $( document ).ready(function() {

            //  Update Profile
            $('body').on('submit','form#profile', function(event){
                event.preventDefault();
                const id = $(this).attr('id');
                const reload = $(this).data('reload');
                const data = $(this).serialize();
                const classA = $(this).attr('action');
                ajaxCall (classA, data,function(response) {
                    let obj = JSON.parse(response);

                    // $('form#register').fadeOut();
                    // $('form#register').html('<p class="small text-muted"><i class="text-success fa fa-check"></i> Account created,<br> Now check your mail (also spam box) for a link to activate your password.</p>');
                    // $('form#register').fadeIn();

                });

            });

        });

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>