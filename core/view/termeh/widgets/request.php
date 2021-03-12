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
                    <?php \App\Core\m::print($item); ?>
                    </li>
                <?php } ?>
            </ul>

        </div>
    </div>
    <a class="btn btn-sm btn-block btn-request" href="my-requests"> Go To My Requests </a>
</div>