<?php

use App\Core\M;

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

            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <?php include_once $this->PATH."widgets/profile-menu.php"; ?>
                    </div>
                    <div class="col-md-5 border-right">
                        <form id="profile" class="form-horizontal" method="post" action="user/update">
                                <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">My Profile</h4>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6"><label class="labels">Name</label><input type="text" class="form-control" placeholder="first name" name="f_name" value="<?= $_SESSION['M']['user']['f_name'] ?? null ?>"></div>
                                    <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control" placeholder="surname" name="l_name" value="<?= $_SESSION['M']['user']['l_name'] ?? null ?>" ></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12"><label class="labels">Email <small>(Username)</small></label><input type="email" class="form-control" placeholder="email" name="email" value="<?= $_SESSION['M']['user']['email'] ?? null ?>" readonly></div>
                                    <div class="col-md-6">
                                        <label class="labels">Country</label>
                                        <select class="selectpicker form-control" placeholder="select country" name="country" data-live-search="true">
                                            <option value="" <?= ($_SESSION['M']['user']['country'] ?? false) ?: 'selected'?> disabled>select country</option>
                                            <?php foreach (M::countries() as $iso => $country) { ?>
                                                <option value="<?= $iso ?>" <?= ($iso!= ($_SESSION['M']['user']['country'] ?? false)) ?: 'selected' ?>><?= $country ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" name="region"  value="<?= $_SESSION['M']['user']['region'] ?? null ?>" placeholder="state"></div>
                                    <div class="col-md-12"><label class="labels">Address</label>
                                        <textarea class="form-control" placeholder="enter address" name="address"><?= $_SESSION['M']['user']['address'] ?? null ?></textarea>
                                    </div>
                                    <div class="col-md-6"><label class="labels">Postcode</label><input type="text" class="form-control" placeholder="enter postcode"  name="postcode" value="<?= $_SESSION['M']['user']['postcode'] ?? null ?>"></div>
                                    <div class="col-md-6"><label class="labels">Phone Number</label><input type="text" class="form-control" placeholder="enter phone number" name="phone"  value="<?= $_SESSION['M']['user']['phone'] ?? null ?>"></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="labels">Gender</label>
                                        <select class="selectpicker form-control" placeholder="select gender" name="gender" data-live-search="false">
                                            <option value="" <?= ($_SESSION['M']['user']['gender'] ?? false) ?: 'selected' ?> disabled>select gender</option>
                                            <option value="M" <?= ("M" != ($_SESSION['M']['user']['gender'] ?? false)) ?: 'selected' ?> >Male</option>
                                            <option value="F" <?= ("F" != ($_SESSION['M']['user']['gender'] ?? false)) ?: 'selected' ?> >Female</option>
                                            <option value="O" <?= ("O" != ($_SESSION['M']['user']['gender'] ?? false)) ?: 'selected' ?> >Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Birthday</label><input type="date" class="form-control" placeholder="Birthday" name="birthday" value="<?= $_SESSION['M']['user']['birthday'] ?? null ?>" >
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="labels">Job Title</label><input type="text" class="form-control" placeholder="enter job title" name="job" value="<?= $_SESSION['M']['user']['job'] ?? null ?>">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Annual Income</label>
                                        <select class="selectpicker form-control" placeholder="select annual income" name="income" data-live-search="false">
                                            <option value="0" <?= ($_SESSION['M']['user']['income'] ?? false) ?: 'selected' ?> disabled>select annual income</option>
                                            <option value="1" <?= ("M" != ($_SESSION['M']['user']['income'] ?? false)) ?: 'selected' ?> >Less than $ 10,000</option>
                                            <option value="2" <?= ("F" != ($_SESSION['M']['user']['income'] ?? false)) ?: 'selected' ?> >$ 10,000 ~ $ 15,000</option>
                                            <option value="3" <?= ("O" != ($_SESSION['M']['user']['income'] ?? false)) ?: 'selected' ?> >$ 15,000 ~ $ 25,000</option>
                                            <option value="4" <?= ("O" != ($_SESSION['M']['user']['income'] ?? false)) ?: 'selected' ?> >$ 25,000 ~ $ 40,000</option>
                                            <option value="5" <?= ("O" != ($_SESSION['M']['user']['income'] ?? false)) ?: 'selected' ?> >$ 40,000 ~ $ 65,000</option>
                                            <option value="6" <?= ("O" != ($_SESSION['M']['user']['income'] ?? false)) ?: 'selected' ?> >+ $ 65,000</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="labels">Interested <small>(Select multi as you like)</small></label>
                                        <select multiple class="selectpicker form-control" id="Interested" name="interests[]" data-container="body" data-live-search="true" title="Select your Interested" data-hide-disabled="true" data-actions-box="true" data-virtual-scroll="false">
                                            <optgroup label="Sport">
                                                <option <?= (!in_array('Football',$this->data['interests'])) ?: 'selected' ?>>Football</option>
                                                <option <?= (!in_array('Basketball',$this->data['interests'])) ?: 'selected' ?>>Basketball</option>
                                                <option <?= (!in_array('Baseball',$this->data['interests'])) ?: 'selected' ?>>Baseball</option>
                                                <option <?= (!in_array('volleyball',$this->data['interests'])) ?: 'selected' ?>>volleyball</option>
                                            </optgroup>
                                            <optgroup label="Movie">
                                                <option <?= (!in_array('Hollywood',$this->data['interests'])) ?: 'selected' ?>>Hollywood</option>
                                                <option <?= (!in_array('Bollywood',$this->data['interests'])) ?: 'selected' ?>>Bollywood</option>
                                                <option <?= (!in_array('Festivals',$this->data['interests'])) ?: 'selected' ?>>Festivals</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?= $_SESSION['M']['user']['id'] ?? null ?>">

                                <div class="my-4 alert form-alert">

                                </div>
                                <div class="mt-4 text-center"><button class="btn btn-primary profile-button" type="submit">Update Profile</button></div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <?php include_once $this->PATH.'widgets/request.php' ?>
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