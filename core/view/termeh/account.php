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
                                    <i class='fa fa-gears'></i>
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
                                <a href='statistics'>
                                    <i class='fa fa-bar-chart'></i>
                                    <div>Statistics</div>
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
                            <form id="signup" class="form-horizontal" method="post" action="vendor/signup">
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
                                    <textarea class="form-control" name="address2" id="address2" placeholder="Address 2"><?= $_SESSION['M']['vendor']['address'] ?></textarea>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-info col-4">Save</button>
                                </div>
                            </form>

                        </div>
                        <div class="col-md-6">
                            <h5>Verify your account</h5>
                            upload documents & ....
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
                    let alertType,alertText;
                    if (obj.e) {
                        alertType = 'alert-danger';
                        alertText = 'Error on saving..!';
                    } else {
                        alertType = 'alert-success';
                        alertText = 'Profile updated.';
                    }
                    $('form#profile .form-alert').addClass(alertType).html(alertText).fadeIn();
                    setTimeout(function() {
                        $('form#profile .form-alert').fadeOut().removeClass(alertType);
                    }, 5000);

                });

            });

        });

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>