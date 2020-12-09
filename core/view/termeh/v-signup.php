<?php

    $this->data['PAGE']['demo']=0;

    $this->data['PAGE']['title'] = 'Register';
    $this->data['PAGE']['keywords'] = 'test';
    $this->data['PAGE']['description'] = 'test';
    $this->data['PAGE']['robots'] = 1; // Null = Follow
    $this->data['PAGE']['image'] = 'test';
    $this->data['PAGE']['canonical'] = APP_URL;
    $this->data['PAGE']['path'] = $this->page_path;
    $this->data['PAGE']['amphtml'] = NULL;
    $this->data['PAGE']['feed'] = NULL;

    $this->data['PAGE']['head'] = ' ';

    if ($_SESSION['M']['user'] ?? false) {
        header('Location: home');
        return 0;
    }

    include_once $this->PATH."global/head.php";
    include_once $this->PATH."global/header.php";
?>

<main role="main" class="container">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <?php if ($this->data['activate']) { ?>
                            <?php if($this->data['active']) { ?>
                                <div class="alert alert-success">Your Account has been active, Now you can enjoy it...
                                <br>
                                <a href="login">Try Login</a>
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-danger">Your Account has been not active, this link is expired/wrong!</div>
                            <?php } ?>
                        <?php } else { ?>
                        <form id="register" class="form-horizontal" method="post" action="user/register">

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                                </div>
                                <input type="text" class="form-control" minlength="3" name="fname" id="fname" placeholder="Enter your First Name" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                                </div>
                                <input type="text" class="form-control" minlength="3" name="lname" id="lname" placeholder="Enter your Last Name" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone-square" aria-hidden="true"></i></span>
                                </div>
                                <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter your phone number" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                </div>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email" required>
                            </div>
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
                                <button type="submit" class="btn btn-primary btn-lg col-8 login-button">Register</button>
                                <small class="mx-3 text-muted border border-secondary rounded-circle p-1">OR</small>
                                <a class="btn btn-success my-2 my-sm-0" href="login">Login</a>
                            </div>
                            <hr>
                            <div class="form-group small text-center">
                                <p>
                                  You can signup as <span class="text-danger">vendor</span> to provide service and products, also create your own shop:
                                </p>
                                <a class="btn btn-sm btn-outline-info mx-auto" href="v-signup">SignUp As Vendor</a>
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
    //  Confirm password check
    $('#password, #confirm').on('keyup', function () {
        $('#confirm').removeClass('border-success border-danger');
        if ($('#password').val() == $('#confirm').val()) {
            $('#confirm').addClass('border border-success');
        } else
            $('#confirm').addClass('border border-danger');
    });

    //  Register
    $('body').on('submit','form#register', function(event){
        event.preventDefault();
        if (($('#password').val() == $('#confirm').val()) && ($('#password').val().length > 5) ) {
            const id = $(this).attr('id');
            const reload = $(this).data('reload');
            const data = $(this).serialize();
            const classA = $(this).attr('action');
            ajaxCall (classA, data,function(response) {
                let obj = JSON.parse(response);
                $('form#register').fadeOut();
                $('form#register').html('<p class="small text-muted"><i class="text-success fa fa-check"></i> Account created,<br> Now check your mail (also spam box) for a link to activate your password.</p>');
                $('form#register').fadeIn();
            });
        } else {
            notify('Confirm password is not same as password','error',false);
        }
    });
</script>

<?php include_once $this->PATH."global/footer.php"; ?>