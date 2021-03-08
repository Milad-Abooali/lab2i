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
                            <li class="done">
                                <span class="doS-1">Main Information</span>
                            </li>
                            <li class="active">
                                <span class="doS-2">Media</span>
                            </li>
                            <li>
                                <span class="doS-3">Detail</span>
                            </li>
                            <li>
                                <span class="doS-4">Price</span>
                            </li>
                            <li>
                                <span class="doS-5">Options</span>
                            </li>
                        </ol>
                    </section>
                    <section class="row">
                        <div class="col-md-12">

                            <div id="doS-1" class="step">
                                Main Information
                            </div>

                            <div id="doS-2" class="step">
                                Media
                            </div>

                            <div id="doS-3" class="step">
                                Detail
                            </div>

                            <div id="doS-4" class="step">
                                Price
                            </div>

                            <div id="doS-5" class="step">
                                Options
                            </div>
                        </div>

                    </section>



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
        $('#doS-1').fadeIn();


    </script>

<?php include_once $this->PATH."global/footer.php"; ?>