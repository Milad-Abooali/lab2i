<?php


$this->data['PAGE']['demo']=0;

$this->data['PAGE']['title'] = 'Admin Categories';
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

<?php if (is_vendor && $_SESSION['M']['vendor']['admin']) { ?>
    <main role="main" class="container">
        <h6><?= $this->data['PAGE']['title'] ?>
        <small class="float-right">

        </small>
        </h6>
        <hr>
        <div class="row">
            <div class="col-md-3 border-right">
                <?php include_once $this->PATH."admin/sidebar.php"; ?>
            </div>
            <div class="col-md-9">

                <form id="addCategory" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="labels">Title</label>
                                <input type="text" class="form-control" placeholder="example" name="title" required>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Excerpt</label>
                                <textarea class="form-control" placeholder="enter address" name="excerpt" required> </textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Tags</label>
                                <select multiple="" class="selectpicker form-control" id="tags" name="tags[]" data-container="body" data-live-search="true" title="Select category tag" data-hide-disabled="true" data-actions-box="true" data-virtual-scroll="false" tabindex="-98">
                                    <?php foreach($this->data['tags'] as $item) { ?>
                                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?>(<?= $item['count_c'] ?>)</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Form</label>
                                <select class="selectpicker form-control" id="tags" name="form" data-container="body" data-live-search="true" title="Select Form" data-hide-disabled="true" data-actions-box="true" data-virtual-scroll="false" tabindex="-98">
                                    <?php foreach($this->data['forms'] as $item) { ?>
                                        <option><?= $item ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="labels">Commission Type</label>
                                <select class="selectpicker form-control" id="tags" name="commission_type" data-container="body" data-live-search="true" title="Commission type" data-hide-disabled="true" data-actions-box="true" data-virtual-scroll="false" tabindex="-98" required>
                                    <option value="1">$ - Flat</option>
                                    <option value="2">% - Percentage</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="labels">Commission Fee</label>
                                <input type="number" class="form-control" min="0.00" max="10000.00" step="0.01" id="fee" name="commission_fee" placeholder="0,00" required>
                            </div>

                            <div class="col-md-6">
                                <label class="labels">Featured Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="featuredImage" accept="image/png, image/jpeg, image/jpg">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="pl-4 pt-3">
                                    <input type="checkbox" class="form-check-input" id="image" name="image">
                                    <label class="form-check-label" for="image">Products have images</label>
                                    <br>
                                    <input type="checkbox" class="form-check-input" id="video" name="video">
                                    <label class="form-check-label" for="video">Products have videos</label>
                                    <br>
                                    <input type="checkbox" class="form-check-input" id="date_range" name="date_range">
                                    <label class="form-check-label" for="date_range">Products have date range</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="pl-4 pt-3">
                                    <input type="checkbox" class="form-check-input" id="highlight" name="highlight">
                                    <label class="form-check-label" for="highlight">Highlight Category</label>
                                    <br>
                                    <input type="checkbox" class="form-check-input" id="discount" name="discount">
                                    <label class="form-check-label" for="discount">Products have discount</label>
                                    <br>
                                    <input type="checkbox" class="form-check-input" id="auto_offer" name="auto_offer">
                                    <label class="form-check-label" for="auto_offer">Auto offer option</label>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button class="btn mt-2 col-md-6 btn-primary" type="submit">Add Category</button>
                            </div>
                        </div>
                    </div>
                </form>

                <hr>

                <table id="categoriesTable" class="table table-sm table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Excerpt</th>
                            <th>Tags</th>
                            <th>Form</th>
                            <th>Commission</th>
                            <th>Options</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($this->data['categories']) foreach ($this->data['categories'] as $item) { ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td>
                                <?= $item['title'] ?>
                                <hr>
                                <img style="width:95px" src="<?= CDN.'/upload/categories/'.$item['id'] ?>">
                            </td>
                            <td class="small"><?= $item['excerpt'] ?></td>
                            <td>
                            <?php
                                if($item['tags']) {
                                    $tags = explode(',',$item['tags']);
                                    foreach ($tags as $tag) echo '<span class="small badge-pill badge-info">'.$this->data['tags'][$tag]['name'].'</span><br>';
                                }
                            ?>
                            </td>
                            <td><?= $item['form'] ?></td>
                            <td><?= ($item['commission_type']==1) ? '$' : '%'; ?> <?= $item['commission_fee'] ?></td>
                            <td class="small">
                                <?php \App\Core\F::status($item['highlight'],'oo') ?> Highlight
                                <br>
                                <?php \App\Core\F::status($item['image'],'oo') ?> Image
                                <br>
                                <?php \App\Core\F::status($item['video'],'oo') ?> Video
                                <br>
                                <?php \App\Core\F::status($item['date_range'],'oo') ?> Date Range
                                <br>
                                <?php \App\Core\F::status($item['discount'],'oo') ?> Discount
                                <br>
                                <?php \App\Core\F::status($item['auto_offer'],'oo') ?> Auto Offer
                            </td>
                            <td> <button class="doA-delete btn btn-sm btn-danger" data-id="<?= $item['id'] ?>">Delete</button> </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>


    </main>

    <?php } ?>
    <script>

        $( document ).ready(function() {

            //  Data Table - Transaction
            $('#categoriesTable').DataTable();


            //  Delete Category
            $('body').on('click','.doA-delete', function(event){
                var r = confirm("Delete a category!");
                if (r == true) {
                    let clicked = $(this);
                    let id = clicked.data('id');
                    let data = {
                        t: 'categories',
                        id: id
                    }
                    ajaxCall('core/delete', data, function (response) {
                        let obj = JSON.parse(response);
                        if (obj.res) {
                            notify('Deleted.', 'success', false);
                            clicked.closest("tr").remove();
                        } else {
                            notify('Error!', 'error', false);
                        }
                    });
                }
            });

        });

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>