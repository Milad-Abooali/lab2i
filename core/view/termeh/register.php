<?php


    $this->data['PAGE']['demo']=0;

    $this->data['PAGE']['title'] = 'Login';
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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="#">

                            <div class="form-group">
                                <label for="fname" class="cols-sm-2 control-label">First Name</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter your First Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lname" class="cols-sm-2 control-label">Last Name</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter your Last Name" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="cols-sm-2 control-label">Phone</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter your phone number" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">Your Email</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter your Email" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="cols-sm-2 control-label">Password</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control" name="confirm" id="confirm" placeholder="Confirm your Password" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <button type="button" class="btn btn-primary btn-lg btn-block login-button">Register</button>
                            </div>
                            <div class="login-register">
                                <a href="login.php">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<?php include_once $this->PATH."global/footer.php"; ?>