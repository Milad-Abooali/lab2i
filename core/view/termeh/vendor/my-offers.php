<?php

use App\Core\M;

$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'Auction Offers';
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


                        <div class="text-left">
                            You have <strong><?= $this->data['requests_count'] ?></strong> orders.
                        </div>
                        <div class="container">
                            <ul class="list-inline row">
                                <?php if ($this->data['requests']) foreach ($this->data['requests'] as $item) { ?>
                                    <li class="col-md-6 small mb-3 px-2">
                                        <div class="media align-items-lg-center border py-3 px-4">
                                            <div class="media-body order-2 order-lg-1">
                                                <div class="mb-4">
                                                    <div class="float-right small text-muted" data-toggle="tooltip" data-placement="top" title="Request ID">
                                                        #<?= $item['id'] ?>
                                                    </div>
                                                    <div class="float-left small text-muted" data-toggle="tooltip" data-placement="top" title="views">
                                                        <i class="fa fa-eye"></i> <?= $item['views'] ?>
                                                    </div>
                                                </div>
                                                <h6 class="font-weight-bold my-2"><?= $item['title'] ?> <br>
                                                    <small class="text-secondary"><?= $item['category'] ?></small>
                                                </h6>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h6 class="col-md-6 font-weight-bold my-2 border-right text-center">
                                                        <small class="text-muted">Offers</small><br> <?= $item['offer_count'] ?>
                                                    </h6>
                                                    <h6 class="col-md-6 font-weight-bold my-2 text-center">
                                                        <small class="text-muted">Best Price</small><br> $ <?= $item['offers_best'] ?>
                                                    </h6>
                                                </div>

                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h6 class="col-md-6 font-weight-bold my-2 border-right text-center">
                                                        <small class="text-muted">Your Position</small><br><span class="text-primary"><?= $item['offer_count'] ?></span>
                                                    </h6>
                                                    <h6 class="col-md-6 font-weight-bold my-2 text-center">
                                                        <small class="text-muted">Your Price</small><br><span class="text-primary">$ <?= $item['offers_best'] ?></span>
                                                    </h6>
                                                </div>

                                                <div class="btn-group col-md-12 pt-3">
                                                    <button type="button" class="btn btn-danger" data-id="?= $item['id'] ?>">Offer</button>
                                                    <a type="button" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Expire Date"><small><?= $item['expire_date'] ?></small></a>
                                                    <a type="button" class="btn btn-success" href="request-<?= $item['id'] ?>">Show</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
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



        });
    </script>

<?php include_once $this->PATH."global/footer.php"; ?>