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
                        <form id="recover-pass" class="form-horizontal" method="post" action="user/recoverPass">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                </div>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email" required>
                            </div>
                            <div class="form-group ">
                                <button type="submit" class="btn btn-warning btn-block login-button">Recover Password</button>
                            </div>
                            <div class="form-group">

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
                $('form#recover-pass').html('<p class="small text-muted">Email sent,<br> Now check your mail (also spam box) for a link to rest your password.</p>');
                $('form#recover-pass').fadeIn();
            } else {
                 notify('User  not found!','error',false);
            }
        });
    });

});

</script>

<?php include_once $this->PATH."global/footer.php"; ?>