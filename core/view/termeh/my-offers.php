<?php

use App\Core\M;

$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'My Requests';
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
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">My Requests</h4>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <p class="text-left">
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
                                                    <div class="float-left small text-muted" data-toggle="tooltip" data-placement="top" title="Views">
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
                                                <div class="btn-group col-md-12 pt-3">
                                                    <a type="button" class="btn btn-success" href="request-<?= $item['id'] ?>">Show</a>
                                                    <a type="button" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Expire Date"><small><?= $item['expire_date'] ?></small></a>
                                                    <button type="button" class="btn btn-danger doA-closeReq" data-id="?= $item['id'] ?>">Close</button>
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

    </main>

    <script>

        $( document ).ready(function() {


        });

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>