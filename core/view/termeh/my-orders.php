<?php

use App\Core\M;

$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'Profile';
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

        <?php if (is_vendor){ ?>
            <link href="<?= CSS ?>v-menu.css" rel="stylesheet" />

        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-9">
                    <div id="v-menu">
                        <ul>
                            <li class='current'>
                                <a href='account'>
                                    <i class='fa fa-user-circle-o'></i>
                                    <div>Profile</div>
                                </a>
                            </li>
                            <li>
                                <a href='dashboard'>
                                    <i class='fa fa-briefcase'></i>
                                    <div>Overview</div>
                                </a>
                            </li>
                            <li>
                                <a href='my-shop'>
                                    <i class='fa  fa-shopping-bag'></i>
                                    <div>My Shop</div>
                                </a>
                            </li>
                            <li>
                                <a href='my-offers'>
                                    <i class='fa fa-gavel'></i>
                                    <div>Auctions</div>
                                </a>
                            </li>
                            <li>
                                <a href='my-orders'>
                                    <i class='fa fa-flash'></i>
                                    <div>Orders</div>
                                </a>
                            </li>
                            <li>
                                <a href='reviews'>
                                    <i class='fa fa-wechat'></i>
                                    <div>Reviews</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 small">
                    <ul class="list-group">
                        <li class="list-group-item">Active Offers <span class="float-right">23</span></li>
                        <li class="list-group-item">Pending Orders <span class="float-right">4</span></li>
                        <li class="list-group-item">Active Products <span class="float-right">15</span></li>
                    </ul>
                </div>
                <div class="col-md-12 border-top pt-3 mt-3">

                    <div class="row">
                        <div class="col-md-6 border-right">
                            <h5>Basic Information</h5>
                            <form id="update" class="form-horizontal" method="post" action="vendor/update">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                                    </div>
                                    <input type="text" class="form-control" minlength="3" name="fname" id="fname" placeholder="Enter your First Name" value="<?= $_SESSION['M']['vendor']['f_name'] ?>" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                                    </div>
                                    <input type="text" class="form-control" minlength="3" name="lname" id="lname" placeholder="Enter your Last Name" value="<?= $_SESSION['M']['vendor']['l_name'] ?>"  required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone-square" aria-hidden="true"></i></span>
                                    </div>
                                    <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter your phone number" value="<?= $_SESSION['M']['vendor']['phone'] ?>"  required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                    </div>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email" value="<?= $_SESSION['M']['vendor']['email'] ?>"  required>
                                </div>
                                <h6 class="">Location</h6>
                                <div class="form-group">
                                    <textarea class="form-control" name="address" id="address" placeholder="Address"><?= $_SESSION['M']['vendor']['address'] ?></textarea>
                                </div>
                                <div class="form-group text-center">
                                    <input type="hidden"  name="id" value="<?= $_SESSION['M']['vendor']['id'] ?>"  required>

                                    <button type="submit" class="btn btn-info col-4">Save</button>
                                </div>
                            </form>

                        </div>
                        <div class="col-md-6">
                        <?php if($_SESSION['M']['vendor']['status']==2){ ?>
                            <p class="text-center">
                                <i class="fa text-success fa-certificate fa-3x"></i>
                                <br>
                                Your Account is verified.
                            </p>
                        <?php } else { ?>
                            <p class="text-center">
                                <i class="fa text-muted fa-certificate fa-3x"></i>
                                <br>
                                Your Account need to verify!
                            </p>
                        <?php } ?>
                            <hr>
                            <h5>Verify your account</h5>
                            <p>
                            Please Send these documentation to <kbd class="text-light">verify@bid2enjoy.com</kbd :
                            </p>
                            <ul>
                                <li>Passport</li>
                                <li>Anything </li>
                                <li>else </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } else { ?>
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3">
                    Please Login ...
                </div>
        </div>
        <?php } ?>

    </main>


    <script>

        //  update
        $('body').on('submit','form#update', function(event){
            event.preventDefault();
            const data = $(this).serialize();
            const classA = $(this).attr('action');
            ajaxCall (classA, data,function(response) {
                let obj = JSON.parse(response);
                $('form#update').append('<p class="alert alert-success noticForm"><i class="text-success fa fa-check"></i> Account updated</p>');
                setTimeout(function(){
                    $(".noticForm").fadeOut();
                }, 1500);
            });
        });
    </script>

<?php include_once $this->PATH."global/footer.php"; ?>