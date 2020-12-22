<?php


    $this->data['PAGE']['demo']=0;

    $this->data['PAGE']['title'] = 'Recover Vendor Password';
    $this->data['PAGE']['keywords'] = 'test';
    $this->data['PAGE']['description'] = 'test';
    $this->data['PAGE']['robots'] = 1; // Null = Follow
    $this->data['PAGE']['image'] = 'test';
    $this->data['PAGE']['canonical'] = APP_URL;
    $this->data['PAGE']['path'] = $this->page_path;
    $this->data['PAGE']['amphtml'] = NULL;
    $this->data['PAGE']['feed'] = NULL;

    $this->data['PAGE']['head'] = ' ';

    if($_SESSION['M']['user'] ?? false)  {
        header('Location: home');
        return 0;
    }

    include_once $this->PATH."global/head.php";
    include_once $this->PATH."global/header.php";
?>

<main role="main" class="container">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Password Recovery</div>
                    <div class="card-body">
                        <?php if($this->data['rec_pass'] ?? false) { ?>
                            <?php if($this->data['reset_pass'] ?? false) { ?>
                            <form id="reset-pass" class="form-horizontal" method="post" action="vendor/restPass">
                                <input type="hidden" name="i" value="<?= $_GET['i']; ?>" required>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
                                    </div>
                                    <input type="password" class="form-control"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="password" id="password" placeholder="Enter your Password" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
                                    </div>
                                    <input type="password" class="form-control" name="confirm" id="confirm" placeholder="Confirm your Password" required>
                                </div>
                                <div class="form-group ">
                                    <button type="submit" class="btn btn-primary btn-block">Change Password</button>
                                </div>
                            </form>
                            <?php } else { ?>
                            <p class="alert alert-danger">This link was expired/wrong.</p>
                            <?php } ?>
                        <?php } else { ?>
                        <form id="recover-pass" class="form-horizontal" method="post" action="vendor/recoverPass">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                </div>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email" required>
                            </div>
                            <div class="form-group ">
                                <button type="submit" class="btn btn-warning btn-block login-button">Recover Password</button>
                            </div>
                        </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<script>

    //  Register
    $('#password, #confirm').on('keyup', function () {
        $('#confirm').removeClass('border-success border-danger');
        if ($('#password').val() == $('#confirm').val()) {
            $('#confirm').addClass('border border-success');
        } else
            $('#confirm').addClass('border border-danger');
    });

$( document ).ready(function() {

    //  Recover Password
    $('body').on('submit','form#recover-pass', function(event){
        event.preventDefault();
        const data = $(this).serialize();
        const classA = $(this).attr('action');
        ajaxCall (classA, data,function(response) {
            let obj = JSON.parse(response);
            if (obj.res) {
                notify('Email Sent ...','success',false);
                $('form#recover-pass').fadeOut();
                $('form#recover-pass').html('<p class="small text-muted"><i class="text-success fa fa-check"></i> Email sent,<br> Now check your mail (also spam box) for a link to rest your password.</p>');
                $('form#recover-pass').fadeIn();
            } else {
                 notify('User  not found!','error',false);
            }
        });
    });


    //  Rest Password
    $('body').on('submit','form#reset-pass', function(event){
        event.preventDefault();
        const data = $(this).serialize();
        const classA = $(this).attr('action');
        ajaxCall (classA, data,function(response) {
            let obj = JSON.parse(response);
            if (obj.res) {
                notify('New password has been set.','success',false);
                $('form#reset-pass').fadeOut();
                $('form#reset-pass').html('<p class="small text-muted"><i class="text-success fa fa-check"></i> Your Password changed,<br> Now you can login with your new password. <a href="login">Try Login</a></p>');
                $('form#reset-pass').fadeIn();
                setTimeout(
                    function()
                    {
                        $(location).attr('href', 'login')
                    }, 10000);
            } else {
                notify('Error on saving new password!','error',false);
            }
        });
    });

});

</script>

<?php include_once $this->PATH."global/footer.php"; ?>