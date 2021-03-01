<div class="p-3 py-1">
    <div class="d-flex justify-content-between align-items-center experience">
        <span>Active Requests</span>
        <a class="btn btn-sm btn-request"  data-toggle="tooltip" href="add-request" data-placement="top" title="Add New Request"><i class="fa fa-plus"></i> Request</a>
    </div>
    <br>
    <div class="row mb-2">
        <div class="col-lg-12 mx-auto">
            <?php
            /*
             * In loop data

            $requests_card[0] = array(
                    'id' => 314123,
                    'views' => 2763,
                    'title' => 'Title',
                    'category' => 'category',
                    'offer_count' => 27,
                    'offers_best' => 950,
                    'expire_date' => '2020/12/29',
                );
            $requests_card[1] = array(
                'id' => 314123,
                'views' => 2763,
                'title' => 'Title',
                'category' => 'category',
                'offer_count' => 27,
                'offers_best' => 950,
                'expire_date' => '2020/12/29',
            );
             */
            ?>

            <ul class="list-group shadow">
                <?php if ($this->data['requests_card']) foreach ($this->data['requests_card'] as $item) { ?>
                    <li class="list-group-item small">
                        <div class="media align-items-lg-center flex-column flex-lg-row p-1 ">
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
    <a class="btn btn-sm btn-block btn-request" href="my-requests"> Go To My Requests </a>
</div>