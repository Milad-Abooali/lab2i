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


                    <form id="addProduct" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                        <section class="row">

                            <!-- Main Information -->
                            <div class="col-md-12">
                                <label class="labels">Title</label>
                                <input type="text" class="form-control" placeholder="example" name="title" required>
                            </div>
                            <div class="col-md-12 my-3">
                                <label class="labels">Description</label>
                                <textarea class="form-control" placeholder="enter Description" name="excerpt" required> </textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Tags</label>
                                <select class="selectpicker form-control" id="tags" name="tags[]" data-container="body" data-live-search="true" title="Product tags" data-hide-disabled="true" data-actions-box="false" data-virtual-scroll="false" multiple data-max-options="5">
                                    <?php foreach($this->data['tags'] as $item) { ?>
                                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?>(<?= $item['count_c'] ?>)</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Category</label>
                                <input type="text" class="form-control" placeholder="example" name="category" value="<?= $this->data['categories']['title'] ?>" readonly>
                            </div>

                        </section>
                    </form>


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


    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>

        CKEDITOR.replace( 'excerpt' );

    </script>

<?php include_once $this->PATH."global/footer.php"; ?>