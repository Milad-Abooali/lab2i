<?php


$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'Dashboard';
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
                    <a class="btn btn-link" href="dashboard"> My Profile </a> <br>
                    <a class="btn btn-link" href="#"> Requests </a> <br>
                    <a class="btn btn-link" href="#"> Transactions </a> <br>
                    <a class="btn btn-link" href="#"> System Emails </a> <br>
                    <a class="btn btn-link" href="#"> Privacy & Security </a>
                    <a class="btn btn-link" href="#"> Change Password </a>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">My Profile</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Name</label><input type="text" class="form-control" placeholder="first name" value="<?= $_SESSION['M']['user']['f_name'] ?>"></div>
                            <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control" placeholder="surname" value="<?= $_SESSION['M']['user']['l_name'] ?>" ></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Email <small>(Username)</small></label><input type="text" class="form-control" placeholder="email" value="<?= $_SESSION['M']['user']['email'] ?>" readonly></div>
                            <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="enter country" value=" "></div>
                            <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state"></div>
                            <div class="col-md-12"><label class="labels">Address</label><input type="text" class="form-control" placeholder="enter address" value=""></div>
                            <div class="col-md-6"><label class="labels">Postcode</label><input type="text" class="form-control" placeholder="enter postcode" value=""></div>
                            <div class="col-md-6"><label class="labels">Phone Number</label><input type="text" class="form-control" placeholder="enter phone number" value="<?= $_SESSION['M']['user']['phone'] ?>"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Job Title</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                            <div class="col-md-12"><label class="labels">Income (Yearly)</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                            <div class="col-md-12"><label class="labels">Interested</label><input type="text" class="form-control" placeholder="enter email id" value=""></div>
                        </div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Update Profile</button></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 py-1">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Active Requests</span>
                            <span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Request</span>
                        </div>
                        <br>
                        <?php include $this->PATH.'profile/request.php' ?>
                    </div>
                    <hr>
                    <div class="p-3 py-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Recommended to you</span>
                        </div>
                        <br>
                        [ Ads + Shop Feeds ]
                    </div>
                </div>
            </div>
        </div>
        <?php elseif (is_vendor): ?>
        Vendor
        <?php else: ?>
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3">
                    Please Login ...
                </div>
        </div>
        <?php endif; ?>

    </main>

    <script>

        $( document ).ready(function() {


        });

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>