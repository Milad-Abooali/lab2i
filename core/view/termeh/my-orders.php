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
                <?php include_once $this->PATH."global/v-menu.php"; ?>
                <div class="col-md-12 border-top pt-3 mt-3">

                    <div id="AuctionOrders">
                        <h5>Auction Orders</h5>

                        <table id="AuctionOrdersTable" class="table table-sm table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>user_id</th>
                                <th>vendor_id</th>
                                <th>product_id</th>
                                <th>quantity</th>
                                <th>price</th>
                                <th>detail</th>
                                <th>date</th>
                                <th>status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>123123</td>
                                <td>123123</td>
                                <td>123123</td>
                                <td>123123</td>
                                <td>123123</td>
                                <td>123123</td>
                                <td>123123</td>
                                <td>123123</td>
                                <td>123123</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                    <hr>
                    <div id="ShopOrders">
                        <h5>Shop Orders</h5>

                        <table id="ShopOrdersTable" class="table table-sm table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>user_id</th>
                                <th>vendor_id</th>
                                <th>product_id</th>
                                <th>quantity</th>
                                <th>price</th>
                                <th>detail</th>
                                <th>date</th>
                                <th>status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>123123</td>
                                <td>123123</td>
                                <td>123123</td>
                                <td>123123</td>
                                <td>123123</td>
                                <td>123123</td>
                                <td>123123</td>
                                <td>123123</td>
                                <td>123123</td>
                            </tr>
                            </tbody>
                        </table>

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

            $('#AuctionOrdersTable').DataTable();
            $('#ShopOrdersTable').DataTable();

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

        });
    </script>

<?php include_once $this->PATH."global/footer.php"; ?>