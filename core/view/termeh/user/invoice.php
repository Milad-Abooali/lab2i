<?php

use App\Core\M;

$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'Add Request';
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

            <link href="<?= CSS ?>v-menu.css" rel="stylesheet" />

        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">

                <div class="col-md-12">


                    <form id="addProduct" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                        <section class="row">

                            <?php if ($error ?? false) { ?>
                                <div class="alert alert-danger"><?= $this->data['error'] ?></div>
                            <?php } ?>

                            <!-- Main Information -->
                            <div class="col-md-12">
                                <label class="labels">Title</label>
                                <input type="text" class="form-control" placeholder="example" name="title" required>
                            </div>
                            <div class="col-md-4 my-4">
                                <div class=" ">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="doA-update custom-control-input" id="date" name="date" >
                                        <label class="custom-control-label" for="date"> Set Date Range</label>
                                    </div>
                                </div>
                                <div class=" ">
                                    <label class="labels">Start Date:</label>
                                    <input type="date" class="date form-control" name="start" readonly>
                                </div>
                                <div class=" ">
                                    <label class="labels">End Date:</label>
                                    <input type="date" class="date form-control" name="end" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 my-4">
                                <div class=" ">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="doA-update custom-control-input" id="price" name="price" >
                                        <label class="custom-control-label" for="price"> Set Prices</label>
                                    </div>
                                    <label class="labels">Ask Price:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">$</span>
                                        </div>
                                        <input type="number" class="price form-control" min="0.00" max="10000.00" step="0.01" id="transferAmount" name="ask" placeholder="Any" readonly>
                                    </div>
                                    <label class="labels">Max Price:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">$</span>
                                        </div>
                                        <input type="number" class="price form-control" min="0.00" max="10000.00" step="0.01" id="transferAmount" name="max" placeholder="Unlimited" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 my-4">
                                Options
                                <div class="">
                                    <label class="labels">Quantity</label>
                                    <input type="number" min="1" class="expire form-control" name="quantity" value="1" required>
                                </div>
                                <div class=" ">
                                    <label class="labels">Expire Date </label>
                                    <input type="date" class="expire form-control" id="expire" name="expire" min=" " max=" "required>
                                </div>
                            </div>
                            <div class="col-md-12 my-3">
                                <label class="labels">Description</label>
                                <textarea class="form-control" placeholder="enter Description" name="excerpt" required> </textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Tags <sup>(Up to 5)</sup></label>
                                <select class="selectpicker form-control" id="tags" name="tags[]" data-container="body" data-live-search="true" title="Product tags" data-hide-disabled="true" data-actions-box="false" data-virtual-scroll="false" multiple data-max-options="5">
                                    <?php foreach($this->data['tags'] as $item) { ?>
                                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?>(<?= $item['count_c'] ?>)</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Images <sup>Optional</sup></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image[]" accept="image/*">
                                    <label class="custom-file-label" for="image1">Choose file</label>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3 text-center">
                                <button class="btn mt-2 btn-primary px-5" type="submit">Add Request</button>
                            </div>

                        </section>
                    </form>


                </div>
            </div>
        </div>

    </main>

    <script>
        $( document ).ready(function() {
            CKEDITOR.replace( 'excerpt' );


            var date = new Date(); // Now
            var maxdate = new Date(); // Now
            maxdate.setDate(maxdate.getDate() + 30);
            var maxEnddate = new Date(); // Now
            maxEnddate.setDate(maxEnddate.getDate() + 365);
            $('#expire').val(date.toISOString().split("T")[0]);
            $('#expire').prop('min', date.toISOString().split("T")[0]).prop('max', maxdate.toISOString().split("T")[0]);
            $('.date').prop('min', date.toISOString().split("T")[0]).prop('max', maxEnddate.toISOString().split("T")[0]);

            // Date
            $('body').on('click change','#date', function(event){
                let date = ($(this).is(':checked')) ? 1 : 0;
                if (date) {
                    $('.date').prop('readonly', false)
                } else {
                    $('.date').val('')
                    $('.date').prop('readonly', true)
                }
            });

            // Price
            $('body').on('click change','#price', function(event){
                let date = ($(this).is(':checked')) ? 1 : 0;
                if (date) {
                    $('.price').prop('readonly', false)
                } else {
                    $('.price').val('')
                    $('.price').prop('readonly', true)
                }
            });


        });
    </script>

<?php include_once $this->PATH."global/footer.php"; ?>