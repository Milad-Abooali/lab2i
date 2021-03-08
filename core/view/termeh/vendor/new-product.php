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

                        <section class="container steps">
                            <ol class="list-steps">
                                <li data-step="step-1" class="done active">
                                    Main Information
                                </li>
                                <li data-step="step-2">
                                    Media
                                </li>
                                <li data-step="step-3">
                                    Detail
                                </li>
                                <li data-step="step-4">
                                    Price
                                </li>
                                <li data-step="step-5">
                                    Options
                                </li>
                            </ol>
                        </section>

                        <form id="addProduct" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                            <section class=" ">

                                    <div id="step-1" class="step row">
                                        <!-- Main Information -->
                                        <div class="col-md-6">
                                            <label class="labels">Title</label>
                                            <input type="text" class="form-control" placeholder="example" name="title" required="">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="labels">Category</label>
                                            <input type="text" class="form-control" placeholder="example" name="title" value="<?= $this->data['categories']['title'] ?>" readonly>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label class="labels">Description</label>
                                            <textarea class="form-control" placeholder="enter address" name="excerpt" required=""> </textarea>
                                        </div>

                                    </div>

                                    <div id="step-2" class="step">
                                        <!-- Media -->


                                    </div>

                                    <div id="step-3" class="step">
                                        <!-- Detail -->


                                    </div>

                                    <div id="step-4" class="step">
                                        <!-- Price -->

                                    </div>

                                    <div id="step-5" class="step">
                                        <!-- Options -->


                                    </div>

                            </section>
                        </form>

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

        // Initial steps
        $('.step').hide();
        $('#step-1').fadeIn();

        $('body').on('click','.list-steps li', function(event){
            if($(this).hasClass('done')) {
                $('.step').hide();
                $('.list-steps li').removeClass('active')
                $(this).addClass('active');
                $('#'+$(this).data('step')).fadeIn();
            } else {
                setTimeout(function(){
                    $(this).prev().fadeOut();
                }, 500);
                $(this).prev().fadeIn();
            }
        });


    </script>

<?php include_once $this->PATH."global/footer.php"; ?>