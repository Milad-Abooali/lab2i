<?php


    $this->data['PAGE']['demo']=0;

    $this->data['PAGE']['title'] = 'SingIn';
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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">SingIn</div>
                    <div class="card-body">
                        <?php if($_GET['error'] ?? false) { ?>
                            <div class="alert alert-danger">Email / Password is not match!</div>
                        <?php } ?>
                        <form id="singin" class="form-horizontal" method="post" action="vendor/signin">
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
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" required>
                            </div>
                            <div class="form-group ">
                                <button type="submit" class="btn btn-info btn-lg col-8 signin-button">SingIn</button>
                                <small class="mx-3 text-muted border border-secondary rounded-circle p-1">OR</small>
                                <a class="btn btn-outline-info my-2 my-sm-0" href="v-signup">SingUp</a>
                            </div>

                            <div class="form-group">
                                <p class="small text-muted">
                                   * If you forgot your password, click <a href="v-recoverPassword" class="">here</a>.
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<script>

$( document ).ready(function() {


    //  SingIn
    $('body').on('submit','form#singin', function(event){
        event.preventDefault();
        const id = $(this).attr('id');
        const reload = $(this).data('reload');
        const data = $(this).serialize();
        const classA = $(this).attr('action');
        ajaxCall (classA, data,function(response) {
            let obj = JSON.parse(response);
            (obj.res) || notify('Email or Password is not true!','error',false);
            (obj.res) && notify('Welcome back ....','success',false);
            (obj.res) && $(location).attr('href', 'home')
        });
    });

});

</script>

<?php include_once $this->PATH."global/footer.php"; ?>