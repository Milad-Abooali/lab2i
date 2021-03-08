<?php

use App\Core\M;

$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'Shop';
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

                    <div class="row">
                        <div class="col-md-3  border-right pr-2">
                            <ul id="tabsJustified" class="nav nav-pills">
                                <li class="nav-item w-100"><a href="" data-target="#Products" data-toggle="tab" class="nav-link small active">Products</a></li>
                                <li class="nav-item w-100"><a href="" data-target="#Style" data-toggle="tab" class="nav-link small">Shop Style</a></li>
                                <li class="nav-item w-100"><a href="" data-target="#Settings" data-toggle="tab" class="nav-link small">Shop Settings</a></li>
                            </ul>
                        </div>
                        <div class="tab-content col-md-9 px-5">

                            <div id="Products" class="tab-pane active fade show">

                                <div class="p-3">
                                    <div class="row">
                                        <div class="col-md-6 text-center">
                                            <label class="labels">Category</label>
                                            <select class="selectpicker form-control" id="category" name="category" data-container="body" data-live-search="true" title="Category" data-hide-disabled="true" data-actions-box="true" data-virtual-scroll="false" tabindex="-98" required>
                                                <?php foreach($this->data['categories'] as $category) { ?>
                                                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <button class="doM-newProduct btn mt-4 btn-primary" type="submit">Add New Product <i class="fa fa-chevron-right"></i> </button>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <h5>Products</h5>

                                <table id="categoriesTable" class="table table-sm table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Tags</th>
                                        <th>Manage</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($this->data['products']) foreach ($this->data['products'] as $item) { ?>
                                        <tr>
                                            <td><?= $item['id'] ?></td>
                                            <td>
                                                <?= $item['title'] ?>
                                                <hr>
                                                <img style="width:95px" src="<?= CDN.'upload/products/'.$item['id'].'/0.jpg'; ?>">
                                            </td>
                                            <td><?= $this->data['categories'][$item['category']]['title'] ?></td>
                                            <td>
                                                <?php
                                                if($item['tags']) {
                                                    $tags = explode(',',$item['tags']);
                                                    foreach ($tags as $tag) echo '<span class="small badge-pill badge-info">'.$this->data['tags'][$tag]['name'].'</span><br>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <button class="doA-delete btn btn-sm btn-danger float-right" data-id="<?= $item['id'] ?>">Delete</button>
                                            </td>
                                        </tr>
                                    <?php } ?>
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

            // Product Table
            $('#ProductsTable').DataTable();

            //  Delete Product
            $('body').on('click','#ProductsTable .doA-delete', function(event){
                let clicked = $(this);
                let id = clicked.data('id');
                let data = {
                    t: 'products',
                    id: id
                }
                ajaxCall ('core/delete', data, function(response) {
                    let obj = JSON.parse(response);
                    if (obj.res) {
                        notify('Deleted.', 'success', false);
                        clicked.closest("tr").remove();
                    } else {
                        notify('Error!', 'error', false);
                    }
                });
            });

            // Add New Product Modal
            $('body').on('click','.doM-newProduct', function(event){
                let body;
                let category = $('#category').val();
                if(category) {
                    window.location.replace("new-product&category="+category);
                } else {
                    $('#category').parent().addClass('border border-danger')
                }
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