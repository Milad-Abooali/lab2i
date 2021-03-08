<?php

use App\Core\M;

$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'New Product';
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

                <?php include_once $this->PATH."global/v-menu.php"; ?>

                <div class="col-md-12 border-top pt-3 mt-3">


                    <div id="stepperForm" class="bs-stepper linear">
                        <div class="bs-stepper-header" role="tablist">
                            <div class="step active" data-target="#test-form-1">
                                <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger1" aria-controls="test-form-1" aria-selected="true">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label">Main Information</span>
                                </button>
                            </div>
                            <div class="bs-stepper-line"></div>
                            <div class="step" data-target="#test-form-2">
                                <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger2" aria-controls="test-form-2" aria-selected="false" disabled="disabled">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label">Media</span>
                                </button>
                            </div>
                            <div class="bs-stepper-line"></div>
                            <div class="step" data-target="#test-form-3">
                                <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger3" aria-controls="test-form-3" aria-selected="false" disabled="disabled">
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label">Detail</span>
                                </button>
                            </div>
                            <div class="bs-stepper-line"></div>
                            <div class="step" data-target="#test-form-3">
                                <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger3" aria-controls="test-form-3" aria-selected="false" disabled="disabled">
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label">Price</span>
                                </button>
                            </div>
                            <div class="bs-stepper-line"></div>
                            <div class="step" data-target="#test-form-3">
                                <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger3" aria-controls="test-form-3" aria-selected="false" disabled="disabled">
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label">Options</span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <form class="needs-validation was-validated" onsubmit="return false" novalidate="">
                                <div id="test-form-1" role="tabpanel" class="bs-stepper-pane fade active dstepper-block" aria-labelledby="stepperFormTrigger1">
                                    <div class="form-group">
                                        <label for="inputMailForm">Email address <span class="text-danger font-weight-bold">*</span></label>
                                        <input id="inputMailForm" type="email" class="form-control" placeholder="Enter email" required="">
                                        <div class="invalid-feedback">Please fill the email field</div>
                                    </div>
                                    <button class="btn btn-primary btn-next-form">Next</button>
                                </div>
                                <div id="test-form-2" role="tabpanel" class="bs-stepper-pane fade dstepper-none" aria-labelledby="stepperFormTrigger2">
                                    <div class="form-group">
                                        <label for="inputPasswordForm">Password <span class="text-danger font-weight-bold">*</span></label>
                                        <input id="inputPasswordForm" type="password" class="form-control" placeholder="Password" required="">
                                        <div class="invalid-feedback">Please fill the password field</div>
                                    </div>
                                    <button class="btn btn-primary btn-next-form">Next</button>
                                </div>
                                <div id="test-form-3" role="tabpanel" class="bs-stepper-pane fade text-center dstepper-none" aria-labelledby="stepperFormTrigger3">
                                    <button type="submit" class="btn btn-primary mt-5">Submit</button>
                                </div>
                            </form>
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