<?php


$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'Admin Settings';
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

<?php if (is_vendor && $_SESSION['M']['vendor']['admin']) { ?>
    <main role="main" class="container">
        <h6><?= $this->data['PAGE']['title'] ?>
        <small class="float-right">
            <button class="btn btn-sm btn-primary"><i class="fa "></i>Save</button>
        </small>
        </h6>
        <hr>
        <div class="row">
            <div class="col-md-3 border-right">
                <?php include_once $this->PATH."admin/sidebar.php"; ?>
            </div>
            <div class="col-md-9">


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

            </div>
        </div>


    </main>

    <?php } ?>
    <script>

        $( document ).ready(function() {


        });

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>