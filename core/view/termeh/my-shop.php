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
                <div class="col-md-9">
                    <div id="v-menu">
                        <ul>
                            <li>
                                <a href='account'>
                                    <i class='fa fa-user-circle-o'></i>
                                    <div>Profile</div>
                                </a>
                            </li>
                            <li>
                                <a href='dashboard'>
                                    <i class='fa fa-briefcase'></i>
                                    <div>Overview</div>
                                </a>
                            </li>
                            <li class='current'>
                                <a href='my-shop'>
                                    <i class='fa  fa-shopping-bag'></i>
                                    <div>My Shop</div>
                                </a>
                            </li>
                            <li>
                                <a href='my-offers'>
                                    <i class='fa fa-gavel'></i>
                                    <div>Auctions</div>
                                </a>
                            </li>
                            <li>
                                <a href='statistics'>
                                    <i class='fa fa-bank'></i>
                                    <div>Financial</div>
                                </a>
                            </li>
                            <li>
                                <a href='reviews'>
                                    <i class='fa fa-wechat'></i>
                                    <div>Reviews</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 small">
                    <ul class="list-group">
                        <li class="list-group-item">Active Offers <span class="float-right">23</span></li>
                        <li class="list-group-item">Pending Orders <span class="float-right">4</span></li>
                        <li class="list-group-item">Active Products <span class="float-right">15</span></li>
                    </ul>
                </div>
                <div class="col-md-12 border-top pt-3 mt-3">

                    <div class="row">
                        <div class="col-md-3  border-right pr-2">
                            <ul id="tabsJustified" class="nav nav-pills">
                                <li class="nav-item w-100"><a href="" data-target="#Orders" data-toggle="tab" class="nav-link small">Orders</a></li>
                                <li class="nav-item w-100"><a href="" data-target="#Products" data-toggle="tab" class="nav-link small">Products</a></li>
                                <li class="nav-item w-100"><a href="" data-target="#Style" data-toggle="tab" class="nav-link small">Shop Style</a></li>
                                <li class="nav-item w-100"><a href="" data-target="#Settings" data-toggle="tab" class="nav-link small active">Shop Settings</a></li>
                            </ul>
                        </div>
                        <div class="tab-content col-md-9 px-5">
                            <div id="Orders" class="tab-pane fade ">
                                <h5>Orders</h5>

                                <table id="OrdersTable" class="table table-sm table-striped table-bordered" style="width:100%">
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
                            <div id="Products" class="tab-pane active fade show">
                                <h5>Products</h5>
                                <button class="btn btn-sm btn-outline-primary float-right doM-newProduct"><i class="fa fa-plus"></i> New Product</button>
                                <table id="ProductsTable" class="table table-sm table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>title</th>
                                        <th>detail</th>
                                        <th>cat_id</th>
                                        <th>price</th>
                                        <th>quntity</th>
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
                                    </tr>
                                    <tr>
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
                            <div id="Style" class="tab-pane fade">
                                <h5>Shop Style</h5>
                                Coming soon...
                            </div>
                            <div id="Settings" class="tab-pane fade ">

                                <h5>Shop Settings</h5>
                                <form id="shopSettings" class="form-horizontal" method="post" action="vendor/settings">
                                    <div class="col-md-12">
                                        <label class="labels">Title</label>
                                        <input type="text" class="form-control" placeholder="Title" name="title" value="<?= $this->data['myShop']['title'] ?>">
                                        <label class="labels">Slang</label>
                                        <input type="text" class="form-control" placeholder="Slang" name="slang" value="<?= $this->data['myShop']['slang'] ?>">
                                        <label class="labels">Status</label>
                                        <select class="selectpicker form-control" name="status" data-live-search="false" tabindex="-98">
                                            <option value="0" <?= ($this->data['myShop']['status']) ?: 'selected' ?>>Deactive</option>
                                            <option value="1" <?= ($this->data['myShop']['status']) ? 'selected' : null ?>>Active</option>
                                        </select>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <input type="hidden" name="id" value="<?= $this->data['myShop']['id'] ?>">
                                        <button class="btn btn-info creatShop" type="submit">Update Settings</button>
                                    </div>
                                </form>

                            </div>
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



        $( document ).ready(function() {

            $('#OrdersTable').DataTable();
            $('#ProductsTable').DataTable();

            $('body').on('click','.doM-newProduct', function(event){

                // Ajax Get New Product
                body = 'test';
                footer = 'tests';
                makeModal('New Product',body,'lg',footer);

           });


            //  update
            $('body').on('submit','form#shopSettings', function(event){
                event.preventDefault();
                const data = $(this).serialize();
                const classA = $(this).attr('action');
                ajaxCall (classA, data,function(response) {
                    let obj = JSON.parse(response);
                    $('form#shopSettings').append('<p class="alert alert-success noticForm"><i class="text-success fa fa-check"></i> Shop Settings updated</p>');
                    setTimeout(function(){
                        $(".noticForm").fadeOut();
                    }, 1500);
                });
            });

        });
    </script>

<?php include_once $this->PATH."global/footer.php"; ?>